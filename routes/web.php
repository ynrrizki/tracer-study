<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MajorController;
use App\Http\Controllers\Admin\OptionInputController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Alumni\AlumniController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.index');
});

// Route::get('/redis-test', function () {
//     $redis  = Redis::incr('p');
//     return $redis;
// });

// Auth
Route::middleware(['guest'])->group(function () {
    Route::get('/login/alumni', [LoginController::class, 'index'])->name('login');
    Route::get('/login/admin', [LoginController::class, 'admin'])->name('admin.login');
    Route::get('/login/dudi', [LoginController::class, 'dudi'])->name('dudi.login');
    Route::post('/auth/login/', [LoginController::class, 'authenticate'])->name('auth.login');
});

Route::middleware('auth')->group(function () {
    // Admin Panel
    Route::middleware('isAdmin')->group(function () {
        Route::prefix('/dashboard')->group(function () {
            Route::get('/', [AdminController::class, 'index'])->name('admin');
            Route::get('/admin/profile', [ProfileController::class, 'index'])->name('profile.admin');
            Route::post('/admin/profile', [ProfileController::class, 'store'])->name('profile.store');
            Route::get('/detail/{id}', [AdminController::class, 'show'])->name('admin.show');

            // Question Management
            Route::get('/questions', [QuestionController::class, 'index'])->name('admin.question');
            Route::post('/questions/save', [QuestionController::class, 'save'])->name('question.save');
            Route::post('/questions/delete', [QuestionController::class, 'destroy'])->name('question.delete');
            Route::post('/questions/options-input/save', [OptionInputController::class, 'save'])->name('optionInput.save');
            Route::post('/questions/options-input/delete', [OptionInputController::class, 'destroy'])->name('optionInput.delete');
            Route::post('/questions/order', [QuestionController::class, 'order'])->name('question.order');

            // User Management
            Route::resource('user', UserController::class);
            Route::post('/user/send-email', [UserController::class, 'sendMail'])->name('sendMail');
            Route::post('file-import/alumni', [AdminController::class, 'fileImport'])->name('alumni.file-import');
            Route::get('file-export/alumni', [AdminController::class, 'fileExport'])->name('alumni.file-export');

            // Major Management
            Route::resource('major', MajorController::class);
            Route::post('file-import/major', [MajorController::class, 'fileImport'])->name('major.file-import');
            Route::get('file-export/major', [MajorController::class, 'fileExport'])->name('major.file-export');

            // Profile
            Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile');
        });
    });

    Route::middleware('isAlumni')->group(function () {
        Route::prefix('/alumni')->group(function () {
            Route::get('/', [AlumniController::class, 'index'])->name('alumni');
        });
    });
});

Route::get('logout', [LoginController::class, 'logout'])->name('logout');
