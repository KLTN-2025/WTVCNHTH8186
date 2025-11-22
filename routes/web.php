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

use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\UserSurveyController;
use App\Http\Controllers\User\ChatController;
use App\Http\Controllers\User\UserUniversityController;
use App\Http\Controllers\User\UserAuthController;

/*
|--------------------------------------------------------------------------
| Trang chính
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
/*
|--------------------------------------------------------------------------
| Xác thực người dùng (Auth)
|--------------------------------------------------------------------------
*/
// Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
// Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/admin/login', [AuthController::class, 'login'])->name('login');
Route::get('/admin/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Khu vực người dùng (USER)
|--------------------------------------------------------------------------
*/

Route::get('/survey', [UserSurveyController::class, 'index'])->name('survey.index');
Route::post('/survey', [UserSurveyController::class, 'store'])->name('survey.store');
Route::get('/survey/result', [UserSurveyController::class, 'result'])->name('survey.result');
Route::get('/chat', [ChatController::class, 'index'])->name('user.chat');
Route::post('/chat/send', [ChatController::class, 'send'])->name('user.chat.send');

Route::get('/universities', [UserUniversityController::class, 'index'])->name('user.universities');


Route::get('/guide', function () {
    return view('user.guide');
})->name('user.guide');

Route::get('/support', function () {
    return view('user.support');
})->name('user.support');


Route::get('/login', [UserAuthController::class, 'showLogin'])->name('user.login');
Route::post('/login', [UserAuthController::class, 'login'])->name('user.submitLogin');

Route::get('/register', [UserAuthController::class, 'showRegister'])->name('user.register');
Route::post('/register', [UserAuthController::class, 'register']);

Route::post('/logout', [UserAuthController::class, 'logout'])->name('user.logout');

Route::middleware(['auth', 'is_user'])->group(function () {
    // Khảo sát định hướng


    // Chatbot AI tư vấn
    Route::get('/chatbot', [ChatbotController::class, 'index'])->name('chatbot.index');
    Route::post('/chatbot/send', [ChatbotController::class, 'send'])->name('chatbot.send');

    // Danh sách ngành & trường (xem)
    Route::get('/majors', [MajorController::class, 'index'])->name('user.majors.index');
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
