<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OptionInputController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Alumni\AlumniController;
use App\Http\Controllers\Auth\LoginController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('pages.index');
})->name('home');

// Route::get('/dash', function () {
//     return view('pages.admin.index');
// });

// Route::get('/profile', function () {
//     return view('pages.alumni.index');
// });

// Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['guest'])->group(function () {
    Route::get('/login/alumni', [LoginController::class, 'index'])->name('login');
    Route::get('/login/admin', [LoginController::class, 'admin'])->name('admin.login');
    Route::post('/auth/login/', [LoginController::class, 'authenticate'])->name('auth.login');
});

Route::middleware(['auth'])->group(function () {
    // Admin Panel
    Route::middleware(['isAdmin'])->prefix('/dashboard')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin');
        Route::post('file-import', [AdminController::class, 'fileImport'])->name('file-import');
        Route::get('file-export', [AdminController::class, 'fileExport'])->name('file-export');
        Route::get('/detail/{id}', [AdminController::class, 'show'])->name('admin.show');

        // Question Management
        Route::get('/questions', [QuestionController::class, 'index'])->name('admin.question');
        Route::post('/questions/save', [QuestionController::class, 'save'])->name('question.save');
        Route::post('/questions/delete', [QuestionController::class, 'destroy'])->name('question.delete');
        Route::post('/questions/options-input/save', [OptionInputController::class, 'save'])->name('optionInput.save');
        Route::post('/questions/options-input/delete', [OptionInputController::class, 'destroy'])->name('optionInput.delete');
        // User Management
        Route::resource('users', UserController::class);

        // Profile
        Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile');
    });
    // Alumni Panel
    Route::middleware(['isAlumni'])->prefix('/alumni')->group(function () {
        Route::get('/', [AlumniController::class, 'index'])->name('alumni');
        // Route::get('/profile', [AlumniController::class, 'profile'])->name('profile');
        // Route::post('/profile/personal', [AlumniController::class, 'updateAlumniProfile'])->name('profile.updatePersonal');
        Route::post('/survey', [AlumniController::class, 'updateAlumniSurveyAnswers'])->name('profile.updateSurvey');
    });
    // DUDI Panel
    Route::middleware(['isDudi'])->prefix('/dudi')->group(function () {
        //
    });
});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/auth/logout', [LoginController::class, 'logout'])->name('auth.logout');
