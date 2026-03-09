<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class OllamaService
{
    protected $url;
    protected $model;

    public function __construct()
    {
        $this->url = config('ai.ollama_url');
        $this->model = config('ai.model');
    }

    public function generateResponse($message)
    {
        try {

            $prompt = $this->buildPrompt($message);

            $response = Http::timeout(120)
                ->post($this->url, [
                    "model" => $this->model,
                    "prompt" => $prompt,
                    "stream" => false
                ]);

            if (!$response->successful()) {
                throw new Exception("AI server error");
            }

            return trim($response->json()['response']);
        } catch (Exception $e) {

            return "Sorry, I am having trouble responding right now.";
        }
    }

    protected function buildPrompt($message)
    {
        return "You are a friendly English teacher helping a student practice English.

                Rules:
                - Correct grammar mistakes
                - Respond naturally
                - Keep responses short
                - Encourage the student

                Student message: {$message}

                Teacher reply:
                ";
    }
}
