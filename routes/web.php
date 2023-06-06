<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
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

Route::match(['get', 'post'], '/', function () {
    return view('index');
})->name('index');


Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/tripsearch', function () {
    return view('tripsearch');
})->name('tripsearch');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['namespace' => 'App\Http\Controllers', 'prefix' => 'profile'], function() {
    Route::get('/', [ProfileController::class, 'index'])->name('profile');
    Route::put('/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::delete('/deleteImage' ,[ProfileController::class , 'updateProfile'])->name('profile.update');
    Route::delete('/delete', [ProfileController::class, 'deleteAccount'])->name('profile.delete');
    Route::get('/about', [ProfileController::class, 'viewAbout'])->name('profile.about');
    Route::get('/comments', [ProfileController::class, 'viewComments'])->name('profile.comments');
    Route::post('/upload', [ProfileController::class, 'uploadProfileImage'])->name('profile.uploadImage');
    Route::delete('/deleteImage', [ProfileController::class, 'deleteProfileImage'])->name('profile.deleteImage');
    Route::put('/update-password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');

});




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




Route::middleware(['guest'])->group(function () {
    // Oturum açma rotası
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);


    // Kayıt olma rotası

    Route::get('/register/create', [RegisterController::class, 'create'])->name('register.create');
    Route::post('/register/store', [RegisterController::class, 'store'])->name('register.store');

});

Route::middleware(['auth'])->group(function () {
    // Çıkış yapma rotası
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
