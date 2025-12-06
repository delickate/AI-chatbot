<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat');
    }

    public function send(Request $request)
    {
        $userMessage = $request->json('message');

        if (!$userMessage) {
            return response()->json(['error' => 'No message received'], 400);
        }

        // CALL OLLAMA (NON-STREAM RESPONSE)
        $response = Http::post('http://localhost:11434/api/generate', [
            'model' => 'llama3:8b',
            'prompt' => $userMessage,
            'stream' => false
        ]);

        $reply = $response->json('response') ?? 'No response returned';

        return response()->json([
            'reply' => $reply
        ]);
    }
}
