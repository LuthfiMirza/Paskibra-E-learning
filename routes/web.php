<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\QuizController as AdminQuizController;
use App\Http\Controllers\Admin\QuizQuestionController as AdminQuizQuestionController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Auth\Admin\LoginController as AdminLoginController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// Dashboard Redesign Routes
Route::get('/dashboard-redesign', function () {
    return view('dashboard-redesign');
})->name('dashboard.redesign');

Route::get('/dashboard-modern', function () {
    return view('dashboard-modern');
})->middleware(['auth'])->name('dashboard.modern');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Announcements routes
    Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('/announcements/{announcement}', [AnnouncementController::class, 'show'])->name('announcements.show');
    Route::get('/announcements/type/{type}', [AnnouncementController::class, 'byType'])->name('announcements.type');
    
    // Quiz routes
    Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');
    Route::get('/quizzes/{quiz}', [QuizController::class, 'show'])->name('quizzes.show');
    Route::post('/quizzes/{quiz}/submit', [QuizController::class, 'submit'])->name('quizzes.submit');
    Route::get('/quiz-attempts/{attempt}/result', [QuizController::class, 'result'])->name('quizzes.result');
    Route::get('/quizzes-history', [QuizController::class, 'history'])->name('quizzes.history');
    
    // Course routes
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
    Route::get('/courses/{course}/lesson/{module}', [CourseController::class, 'lesson'])->name('courses.lesson');
    
    // Grade routes
    Route::get('/grades', [GradeController::class, 'index'])->name('grades.index');
    Route::get('/grades/{grade}', [GradeController::class, 'show'])->name('grades.show');
    
    // Ranking routes
    Route::get('/rankings', [RankingController::class, 'index'])->name('rankings.index');
    
    // Achievement routes
    Route::get('/achievements', [AchievementController::class, 'index'])->name('achievements.index');
    
    // Notification routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/recent', [NotificationController::class, 'getRecent'])->name('notifications.recent');
    Route::post('/notifications/{id}/mark-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
});

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AdminLoginController::class, 'create'])->name('login');
        Route::post('login', [AdminLoginController::class, 'store']);
    });

    Route::middleware([AdminMiddleware::class])->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        // Users CRUD
        Route::resource('users', AdminUserController::class);
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
        Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');
        // Analitik (baca saja)
        Route::get('/analytics', [AdminController::class, 'reports'])->name('analytics');

        Route::resource('courses', AdminCourseController::class);
        Route::resource('quizzes', AdminQuizController::class);
        Route::resource('quizzes.questions', AdminQuizQuestionController::class);
        // CRUD Reports tersimpan
        Route::resource('reports', AdminReportController::class);
    });
});

require __DIR__.'/auth.php';
