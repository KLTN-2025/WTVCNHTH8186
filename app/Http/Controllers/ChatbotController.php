<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ChatLog;
use App\Models\Major;

class ChatbotController extends Controller
{
    public function index()
    {
        return view('chatbot.index');
    }

    public function send(Request $request)
    {
        $messages = [
            'message.required' => 'Vui lòng nhập nội dung câu hỏi.',
            'message.max'      => 'Câu hỏi quá dài (tối đa 1000 ký tự).',
        ];

        $data = $request->validate([
            'message' => 'required|string|max:1000',
        ], $messages);

        // Trả lời rule-based tạm thời. Có thể thay bằng OpenAI sau.
        $msg = mb_strtolower($data['message']);
        $reply = 'Mình đã ghi nhận câu hỏi của bạn. Hệ thống sẽ gợi ý dựa trên khảo sát và dữ liệu ngành/trường.';

        if (str_contains($msg, 'toán') || str_contains($msg, 'lập trình') || str_contains($msg, 'máy tính')) {
            $major = Major::where('name', 'like', '%Công nghệ thông tin%')->first();
            if ($major) $reply = 'Bạn có thể phù hợp với ngành: ' . $major->name . '. Hãy xem chi tiết ngành và các trường đào tạo trong hệ thống.';
        } elseif (str_contains($msg, 'kinh doanh') || str_contains($msg, 'marketing')) {
            $major = Major::where('name', 'like', '%Quản trị kinh doanh%')->first();
            if ($major) $reply = 'Bạn có thể phù hợp với ngành: ' . $major->name . '. Tham khảo danh sách trường liên quan.';
        }

        ChatLog::create([
            'user_id' => Auth::id(),
            'message' => $data['message'],
            'reply'   => $reply,
        ]);

        return back()->with('bot_reply', $reply)->with('success', 'Đã gửi câu hỏi.');
    }
}
