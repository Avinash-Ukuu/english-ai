<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ReadingController extends Controller
{
    public function index(Request $request)
    {
        $level          =   session('reading_level', 'beginner');
        $previous       =   DB::table('user_sessions')->where('type', 'reading')->pluck('sentence')->toArray();
        $avoid          =   implode(", ", $previous);

        $paragraphRule  =   match ($level) {
                                'beginner' => 'Generate ONLY one very short English paragraph (2-3 simple sentences). Use easy daily vocabulary.',
                                'intermediate' => 'Generate ONLY one English paragraph (4-5 sentences) with natural daily conversation.',
                                'advanced' => 'Generate ONLY one longer English paragraph (6-8 sentences) with fluent natural English.',
                                default => 'Generate ONLY one short English paragraph.'
                            };

        $prompt         =   "Act as a Professional English Teacher.
                            {$paragraphRule}
                            Rules:
                            - The paragraph will be used for reading comprehension practice.
                            - After the paragraph add ONLY one simple question.
                            - Return the paragraph, one question, and the correct answer.
                            - Do NOT explain anything.
                            - Do NOT repeat these paragraphs: {$avoid}
                            Return in this EXACT format:
                            Paragraph: ...
                            Question: ...
                            Answer: ...";

        $response       =   Http::timeout(120)->post('http://localhost:11434/api/generate', [
                                "model" => "llama3",
                                "prompt" => $prompt,
                                "stream" => false
                            ]);

        $content        =   trim($response->json()['response']);
        preg_match('/Paragraph:(.*?)Question:/s', $content, $paragraph);
        preg_match('/Question:(.*?)Answer:/s', $content, $question);
        preg_match('/Answer:(.*)/s', $content, $answer);

        $paragraph = trim($paragraph[1] ?? '');
        $question  = trim($question[1] ?? '');
        $answer    = trim($answer[1] ?? '');

        return view('cms.reading', compact('paragraph','question','answer','level'));
    }

    public function evaluate(Request $request)
    {
        $paragraph      = $request->paragraph;
        $correctAnswer  = strtolower($request->correct_answer);
        $userAnswer     = strtolower($request->answer);

        // remove punctuation
        $correctAnswer  = preg_replace('/[^\w\s]/', '', $correctAnswer);
        $userAnswer     = preg_replace('/[^\w\s]/', '', $userAnswer);

        similar_text($correctAnswer, $userAnswer, $percent);
        $score = round($percent);
        $level = $request->level;

        if ($score == 100) {
            if ($level == 'beginner') {
                $level = 'intermediate';
            } elseif ($level == 'intermediate') {
                $level = 'advanced';
            }
        } elseif ($score < 70) {
            if ($level == 'advanced') {
                $level = 'intermediate';
            } elseif ($level == 'intermediate') {
                $level = 'beginner';
            }
        }

        if ($score >= 90) {
            $feedback = "Excellent reading comprehension!";
        } elseif ($score >= 70) {
            $feedback = "Good understanding.";
        } elseif ($score >= 50) {
            $feedback = "You understood some parts.";
        } else {
            $feedback = "Read the paragraph carefully and try again.";
        }

        DB::table('user_sessions')->insert([
            'type' => 'reading',
            'level' => $level,
            'sentence' => $paragraph,
            'user_text' => $userAnswer,
            'score' => $score,
            'feedback' => $feedback,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        session(['reading_level' => $level]);

        return response()->json([
            'score' => $score,
            'feedback' => $feedback
        ]);
    }
}
