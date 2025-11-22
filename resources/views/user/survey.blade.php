@extends('layouts.user')
@section('title', 'Khảo sát định hướng')
@section('page_title', 'Khảo sát')
@section('heading', 'Khảo sát định hướng ngành học')

@section('content')
    <div class="mx-auto">

        <div class="mb-6 text-center">
            <h2 class="text-2xl font-semibold text-primary mb-1">Khảo sát định hướng ngành học</h2>
            <p class="text-gray-600 dark:text-gray-400 text-sm">
                Hãy trả lời trung thực các câu hỏi dưới đây.
            </p>
        </div>

        <div class="mb-8">
            <div class="flex justify-between text-xs text-gray-600 dark:text-gray-400 mb-1">
                <span>Tiến trình</span>
                <span><span id="page-number">1</span> / {{ ceil(count($questions) / 5) }} trang</span>
            </div>
            <div class="w-full bg-gray-200 dark:bg-gray-800 rounded-full h-2 overflow-hidden">
                <div id="progress-bar" class="bg-primary h-2 w-1/6 transition-all"></div>
            </div>
        </div>

        <form method="POST" action="{{ route('survey.store') }}">
            @csrf

            @php
                $pageSize = 5;
                $totalPages = ceil(count($questions) / $pageSize);
            @endphp

            @for($page = 1; $page <= $totalPages; $page++)
                <div class="survey-page {{ $page == 1 ? '' : 'hidden' }}" data-page="{{ $page }}">
                    @foreach($questions->forPage($page, $pageSize) as $q)
                        <div
                            class="mb-6 bg-white dark:bg-gray-800 rounded-xl shadow-sm p-5 border border-gray-100 dark:border-gray-700">
                            <h3 class="font-medium text-gray-800 dark:text-gray-200 mb-3">
                                {{ ($loop->iteration + ($page - 1) * $pageSize) }}. {{ $q->question_text }}
                            </h3>

                            <input type="text" name="answers[{{ $q->id }}]"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200"
                                placeholder="Nhập câu trả lời...">
                        </div>
                    @endforeach
                </div>
            @endfor

            <div class="flex justify-between items-center mt-8">
                <button type="button" id="prevBtn"
                    class="px-5 py-2 rounded-lg border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition disabled:opacity-50"
                    disabled>
                    Trước
                </button>

                <button type="button" id="nextBtn"
                    class="px-5 py-2 rounded-lg bg-primary text-white hover:bg-blue-700 transition">
                    Tiếp theo
                </button>

                <button type="submit" id="submitBtn"
                    class="hidden px-6 py-2 bg-primary hover:bg-primary-700 text-white rounded-lg transition">
                    Gửi kết quả
                </button>
            </div>
        </form>
    </div>

    <script>
        const pages = document.querySelectorAll('.survey-page');
        const progressBar = document.getElementById('progress-bar');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const submitBtn = document.getElementById('submitBtn');
        const pageNum = document.getElementById('page-number');

        let currentPage = 1;
        const totalPages = {{ $totalPages }};

        function updateUI() {
            pages.forEach((p, i) => p.classList.toggle('hidden', i + 1 !== currentPage));
            prevBtn.disabled = currentPage === 1;
            nextBtn.classList.toggle('hidden', currentPage === totalPages);
            submitBtn.classList.toggle('hidden', currentPage !== totalPages);
            pageNum.textContent = currentPage;
            progressBar.style.width = `${(currentPage / totalPages) * 100}%`;
        }

        nextBtn.addEventListener('click', () => {
            if (currentPage < totalPages) currentPage++;
            updateUI();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        prevBtn.addEventListener('click', () => {
            if (currentPage > 1) currentPage--;
            updateUI();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>
@endsection