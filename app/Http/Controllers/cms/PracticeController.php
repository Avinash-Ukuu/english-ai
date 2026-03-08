<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PracticeController extends Controller
{
    public function dashboard()
    {
        $sessions = DB::table('user_sessions')->count();
        return view('cms.dashboard', compact('sessions'));
    }

    public function chat()
    {
        $conversations = DB::table('conversations')->latest()->limit(10)->get();
        return view('cms.chat', compact('conversations'));
    }

    public function askAI(Request $request)
    {

        $message = $request->message;

        $response = Http::post('http://localhost:11434/api/generate', [
            "model" => "llama3",
            "prompt" => "You are an English teacher. Correct grammar and respond simply: " . $message,
            "stream" => false
        ]);

        $ai = $response->json()['response'];

        DB::table('conversations')->insert([
            'user_message' => $message,
            'ai_message' => $ai,
            'created_at' => now()
        ]);

        return back();
    }

    public function reading()
    {

        $response = Http::post('http://localhost:11434/api/generate', [
            "model" => "llama3",
            "prompt" => "Create a short English reading paragraph for beginners with one question.",
            "stream" => false
        ]);

        $content = $response->json()['response'];

        return view('cms.reading', compact('content'));
    }

    // public function listening()
    // {

    //     $sentence = "Practice English every day to improve your communication skills.";

    //     return view('cms.listening', compact('sentence'));
    // }

    // public function speaking()
    // {

    //     $sentence = "Consistency is the key to success.";

    //     return view('cms.speaking', compact('sentence'));
    // }

    public function saveSession(Request $request)
    {

        DB::table('sessions')->insert([
            'type' => $request->type,
            'score' => $request->score,
            'text' => $request->text,
            'created_at' => now()
        ]);

        return response()->json([
            "status" => "saved"
        ]);
    }

    public function progress()
    {

        $sessions = DB::table('user_sessions')->get();

        return view('cms.progress', compact('sessions'));
    }
}
