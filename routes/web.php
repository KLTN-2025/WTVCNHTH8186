<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    MajorController,
    UniversityController,
    SurveyController,
    ChatbotController,
    AdminController,
    UserController,
    SurveyQuestionController,
    SurveyAnswerController,
    CareerPathController,
    MajorUniversityController
};

/*
|--------------------------------------------------------------------------
| Trang chính
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('welcome'))->name('home');

/*
|--------------------------------------------------------------------------
| Xác thực người dùng (Auth)
|--------------------------------------------------------------------------
*/
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Khu vực người dùng (USER)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'is_user'])->group(function () {
    // Khảo sát định hướng
    Route::get('/survey', [SurveyController::class, 'index'])->name('survey.index');
    Route::post('/survey', [SurveyController::class, 'store'])->name('survey.store');

    // Chatbot AI tư vấn
    Route::get('/chatbot', [ChatbotController::class, 'index'])->name('chatbot.index');
    Route::post('/chatbot/send', [ChatbotController::class, 'send'])->name('chatbot.send');

    // Danh sách ngành & trường (xem)
    Route::get('/majors', [MajorController::class, 'index'])->name('user.majors.index');
    Route::get('/universities', [UniversityController::class, 'index'])->name('user.universities.index');
});

/*
|--------------------------------------------------------------------------
| Khu vực quản trị (ADMIN)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    /*
    |--------------------------
    | Quản lý thông tin
    |--------------------------
    */
    Route::resource('/majors', MajorController::class)->except(['show']);
    Route::resource('/universities', UniversityController::class)->except(['show']);

    /*
    |--------------------------
    | Định hướng nghề nghiệp
    |--------------------------
    */
    // Câu hỏi khảo sát
    Route::resource('/survey-questions', SurveyQuestionController::class)->except(['show']);

    // Câu trả lời khảo sát
    Route::get('/survey-answers', [SurveyAnswerController::class, 'index'])->name('survey-answers.index');
    Route::delete('/survey-answers/{id}', [SurveyAnswerController::class, 'destroy'])->name('survey-answers.destroy');

    // Lộ trình nghề nghiệp
    Route::resource('/career-paths', CareerPathController::class)->except(['show']);

    // Liên kết ngành – trường
    Route::resource('/major-university', MajorUniversityController::class)->except(['show']);

    /*
    |--------------------------
    | Người dùng & Tài khoản
    |--------------------------
    */
    Route::resource('users', UserController::class)->except(['show']);
    Route::get('users/{id}/block', [UserController::class, 'toggleBlock'])->name('users.block');
    Route::get('profile', [UserController::class, 'profile'])->name('profile.edit');
    Route::put('profile', [UserController::class, 'updateProfile'])->name('profile.update');

    /*
    |--------------------------
    | Nhật ký hoạt động admin
    |--------------------------
    */
    Route::get('/logs', [AdminController::class, 'logs'])->name('admin.logs');
});

/*
|--------------------------------------------------------------------------
| Fallback - Trang 404
|--------------------------------------------------------------------------
*/
Route::fallback(fn() => response()->view('errors.404', [], 404));
