<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\mailController;


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


Route::get('/helpcenter',[HomeController::class ,'helpcenter'])->name('helpcenter');
Route::get('/contactus',[HomeController::class ,'contactus'])->name('contactus');
Route::get('/aboutus',[HomeController::class ,'aboutus'])->name('aboutus');
Route::get('/howitworks',[HomeController::class ,'howitworks'])->name('howitworks');



Route::post('/send' ,[mailController::class , 'send'])->name('send');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);



    Route::get('/register/create', [RegisterController::class, 'create'])->name('register.create');
    Route::post('/register/store', [RegisterController::class, 'store'])->name('register.store');

});

Route::middleware(['auth'])->group(function () {
    // Çıkış yapma rotası
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
