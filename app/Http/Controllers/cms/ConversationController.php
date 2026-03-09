<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Services\OllamaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConversationController extends Controller
{
    protected $ai;

    public function __construct(OllamaService $ai)
    {
        $this->ai = $ai;
    }

    public function index()
    {
        $messages = DB::table('conversations')->orderBy('created_at', 'desc')->limit(20)->get()->reverse();

        return view('cms.conversation', compact('messages'));
    }

    public function send(Request $request)
    {

        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        $message = trim($request->message);

        $aiResponse = $this->ai->generateResponse($message);

        DB::table('conversations')->insert([
            'user_message' => $message,
            'ai_message' => $aiResponse,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return response()->json([
            'success' => true,
            'user' => $message,
            'ai' => $aiResponse
        ]);
    }
}
