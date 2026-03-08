<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ListeningController extends Controller
{
    public function index(Request $request)
    {
        $level          =   session('listening_level', 'beginner');
        $previous       =   DB::table('user_sessions')->where('type', 'listening')->pluck('sentence')->toArray();
        $avoid          =   implode(", ", $previous);

        $sentenceRule   =   match($level) {
                                'beginner' => 'Generate ONLY one very simple English sentence for listening practice (4-6 words). Use common daily words.',
                                'intermediate' => 'Generate ONLY one clear English sentence for listening practice (8-12 words). Use natural daily conversation.',
                                'advanced' => 'Generate ONLY one longer and more complex English sentence for listening practice (15-20 words). Use natural fluent English.',
                                default => 'Generate ONLY one short English sentence.'
                            };

        $prompt         =   "Act as a Professional English Professor. $sentenceRule
                            Rules:
                            - The sentence will be used for listening practice.
                            - Return ONLY the sentence.
                            - Do NOT explain anything.
                            - Do NOT repeat these sentences: {$avoid}
                            Example format:
                            She is going to the market.";

        $response       =   Http::timeout(120)->post('http://localhost:11434/api/generate', [
            "model" => "llama3",
            "prompt" => $prompt,
            "stream" => false
        ]);
        $sentence = trim($response->json()['response']);

        return view('cms.listening',compact('sentence','level'));
    }

    public function evaluate(Request $request)
    {

        $correct = strtolower($request->sentence);
        $user = strtolower($request->user_text);

         // remove punctuation
        $correct = preg_replace('/[^\w\s]/', '', $correct);
        $user = preg_replace('/[^\w\s]/', '', $user);

        similar_text($correct, $user, $percent);

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
            $feedback = "Excellent listening!";
        } elseif ($score >= 70) {
            $feedback = "Good job.";
        } elseif ($score >= 50) {
            $feedback = "You heard some parts correctly.";
        } else {
            $feedback = "Listen carefully and try again.";
        }

        DB::table('user_sessions')->insert([
            'type' => 'listening',
            'level' => $level,
            'sentence' => $correct,
            'user_text' => $user,
            'score' => $score,
            'feedback' => $feedback,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        session(['listening_level' => $level]);

        return response()->json([
            'score' => $score,
            'feedback' => $feedback
        ]);
    }
}
