@extends('layouts.user')
@section('title', 'Chat với AI tư vấn')
@section('page_title', 'Tư vấn')
@section('heading', 'Trò chuyện cùng AI định hướng ngành học')

@section('content')
    <div
        class="mx-auto flex flex-col h-[75vh] bg-white dark:bg-gray-900 rounded-xl shadow border border-gray-200 dark:border-gray-800 overflow-hidden">

        <!-- Header Chat -->
        <div
            class="flex items-center justify-between px-5 py-3 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
            <div class="flex items-center gap-3">
                <div
                    class="h-10 w-10 rounded-full bg-gradient-to-br from-primary to-blue-400 flex items-center justify-center text-white shadow">
                    <i class="fa-solid fa-robot text-lg"></i>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-gray-800 dark:text-gray-100">AI Tư vấn nghề nghiệp</h2>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Trò chuyện và nhận gợi ý ngành học phù hợp</p>
                </div>
            </div>
            <button id="clearChat"
                class="text-xs px-3 py-1 border border-gray-300 dark:border-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                <i class="fa-solid fa-trash-can mr-1"></i> Xóa đoạn chat
            </button>
        </div>

        <!-- Khung hội thoại -->
        <div id="chatContainer" class="flex-1 overflow-y-auto p-5 space-y-4 bg-gray-50 dark:bg-gray-900">
            @if(isset($messages) && count($messages))
                @foreach($messages as $msg)
                    @if($msg->sender === 'user')
                        <div class="flex justify-end">
                            <div class="max-w-[70%] bg-primary text-white px-4 py-2 rounded-xl rounded-br-none shadow">
                                {{ $msg->message }}
                            </div>
                        </div>
                    @else
                        <div class="flex justify-start">
                            <div
                                class="max-w-[70%] bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-200 px-4 py-2 rounded-xl rounded-bl-none shadow">
                                {!! nl2br(e($msg->reply)) !!}
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="text-center text-sm text-gray-500 dark:text-gray-400 mt-10">
                    👋 Xin chào! Tôi là AI tư vấn nghề nghiệp. Bạn có thể hỏi tôi bất cứ điều gì, ví dụ:<br>
                    <span class="italic">“Em giỏi Toán và thích máy tính thì nên chọn ngành nào?”</span>
                </div>
            @endif
        </div>

        <!-- Ô nhập -->
        <form id="chatForm" method="POST" action="{{ route('user.chat.send') }}"
            class="border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-3 flex items-center gap-2">
            @csrf
            <input type="text" name="message" id="chatInput" placeholder="Nhập câu hỏi của bạn..."
                class="flex-1 px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 transition"
                required>
            <button type="submit"
                class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-700 transition flex items-center gap-2">
                <i class="fa-solid fa-paper-plane"></i><span>Gửi</span>
            </button>
        </form>
    </div>

    <!-- Hiệu ứng gửi -->
    <script>
        const form = document.getElementById('chatForm');
        const input = document.getElementById('chatInput');
        const chatContainer = document.getElementById('chatContainer');

        form.addEventListener('submit', (e) => {
            e.preventDefault();

            const message = input.value.trim();
            if (!message) return;

            // Thêm tin nhắn người dùng vào giao diện ngay lập tức
            const userMsg = document.createElement('div');
            userMsg.className = 'flex justify-end';
            userMsg.innerHTML = `
          <div class="max-w-[70%] bg-primary text-white px-4 py-2 rounded-xl rounded-br-none shadow">${message}</div>
        `;
            chatContainer.appendChild(userMsg);
            chatContainer.scrollTop = chatContainer.scrollHeight;
            input.value = '';

            // Gửi AJAX tới server (dùng route Laravel)
            fetch("{{ route('user.chat.send') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify({ message })
            })
                .then(res => res.json())
                .then(data => {
                    const botMsg = document.createElement('div');
                    botMsg.className = 'flex justify-start animate-fade-in';
                    botMsg.innerHTML = `
              <div class="max-w-[70%] bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-200 px-4 py-2 rounded-xl rounded-bl-none shadow">
                ${data.reply.replace(/\n/g, '<br>')}
              </div>`;
                    chatContainer.appendChild(botMsg);
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                })
                .catch(() => {
                    const errMsg = document.createElement('div');
                    errMsg.className = 'flex justify-start';
                    errMsg.innerHTML = `
              <div class="max-w-[70%] bg-red-100 text-red-700 px-4 py-2 rounded-xl shadow">
                Lỗi kết nối đến máy chủ. Vui lòng thử lại.
              </div>`;
                    chatContainer.appendChild(errMsg);
                });
        });

        // Xóa đoạn chat
        document.getElementById('clearChat').addEventListener('click', () => {
            chatContainer.innerHTML = `
          <div class="text-center text-sm text-gray-500 dark:text-gray-400 mt-10">
            👋 Xin chào! Tôi là AI tư vấn nghề nghiệp. Hãy bắt đầu cuộc trò chuyện nhé!
          </div>`;
        });
    </script>

    <style>
        .animate-fade-in {
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }
    </style>
@endsection