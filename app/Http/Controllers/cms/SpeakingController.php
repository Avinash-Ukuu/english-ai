<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class SpeakingController extends Controller
{
    public function index(Request $request)
    {

        $level          =   session('speaking_level', 'beginner');
        $previous       =   DB::table('user_sessions')->where('type', 'speaking')->pluck('sentence')->toArray();
        $avoid          =   implode(", ", $previous);
        $sentenceRule   =   match($level) {
                                'beginner' => 'Generate ONLY one short and very simple English sentence (4-6 words).',
                                'intermediate' => 'Generate ONLY one clear English sentence (8-12 words).',
                                'advanced' => 'Generate ONLY one longer and more complex English sentence (15-20 words).',
                                default => 'Generate ONLY one short English sentence.'
                            };
        $prompt = "Act as Professional English Professor. $sentenceRule
                    Rules:
                    - Return only the sentence.
                    - Do NOT explain anything.
                    - Do NOT repeat these sentences: {$avoid}
                    Example format:
                    I like coffee.";

        $response = Http::timeout(120)->post('http://localhost:11434/api/generate', [
            "model" => "llama3",
            "prompt" => $prompt,
            "stream" => false
        ]);

        $sentence = trim($response->json()['response']);
        $sentence = preg_split('/[.!?]/', $sentence)[0] . '.';

        return view('cms.speaking', compact('sentence', 'level'));
    }

    public function evaluate(Request $request)
    {
        $sentence = strtolower($request->sentence);
        $spoken = strtolower($request->spoken);

        $sentence = preg_replace('/[^\w\s]/', '', $sentence);
        $spoken = preg_replace('/[^\w\s]/', '', $spoken);

        similar_text($sentence, $spoken, $percent);

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

        $feedback = $score >= 90
            ? "Excellent pronunciation!"
            : "Try again and speak clearly.";

        DB::table('user_sessions')->insert([
            'type' => 'speaking',
            'level' => $level,
            'sentence' => $sentence,
            'user_text' => $spoken,
            'score' => $score,
            'feedback' => $feedback,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        session(['speaking_level' => $level]);

        return response()->json([
            'score' => $score,
            'feedback' => $feedback
        ]);
    }
}
