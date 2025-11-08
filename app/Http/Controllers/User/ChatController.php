<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatLog;
use Illuminate\Support\Facades\Auth;
use OpenAI\Laravel\Facades\OpenAI;

class ChatController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $messages = ChatLog::where('user_id', $userId)->orderBy('created_at')->get();
        return view('user.chat', compact('messages'));
    }

    public function send(Request $request)
    {
        $user = Auth::user();
        $text = trim($request->input('message'));
        if (!$text)
            return response()->json(['reply' => 'Tin nhắn trống.'], 400);

        // Lưu câu hỏi người dùng
        $msg = ChatLog::create([
            'user_id' => $user->id,
            'message' => $text,
        ]);

        // Gọi API GPT (nếu có cài openai-php/laravel)
        try {
            $response = OpenAI::chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => 'Bạn là cố vấn định hướng nghề nghiệp cho học sinh Việt Nam.'],
                    ['role' => 'user', 'content' => $text],
                ],
            ]);
            $reply = trim($response['choices'][0]['message']['content']);
        } catch (\Exception $e) {
            $reply = "Xin lỗi, hệ thống đang bận. Vui lòng thử lại sau.";
        }

        // Lưu phản hồi AI
        $msg->update(['reply' => $reply]);

        return response()->json(['reply' => nl2br(e($reply))]);
    }
}
