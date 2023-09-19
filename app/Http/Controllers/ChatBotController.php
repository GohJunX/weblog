<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;



class ChatBotController extends Controller
{
    public function sendChat(Request $request)
    {
   
        // Send the chat message to the OpenAI API
        $result = OpenAI::completions()->create([
            'max_tokens' => 100,
            'model' => 'text-davinci-003',
            'prompt' => $request->input // 'input' is the name attribute of the input field in the JavaScript code
        ]);
      
        
        // Process the API response to extract the chatbot's response
        $response = array_reduce(
            $result->toArray()['choices'],
            fn(string $result, array $choice) => $result . $choice['text'], ""
        );
       
        // Output the chatbot's response (for debugging purposes)
      return $response;
    }
}
