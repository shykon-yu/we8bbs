<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\RootController::class, 'index'])->name('home');
// 登录和退出
Route::get('login', [\App\Http\Controllers\Auth\LoginController::class,'showLoginForm'])->name('login');
Route::post('login',[\App\Http\Controllers\Auth\LoginController::class,'login']);
Route::post('logout', [\App\Http\Controllers\Auth\LoginController::class,'logout'])->name('logout');


// 用户注册相关路由
Route::get('register', [\App\Http\Controllers\Auth\RegisterController::class,'showRegistrationForm'])->name('register');
Route::post('register',[\App\Http\Controllers\Auth\RegisterController::class,'register'])->name('register');


// 密码重置相关路由
Route::get('password/reset', [\App\Http\Controllers\Auth\ForgotPasswordController::class,'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [\App\Http\Controllers\Auth\ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [\App\Http\Controllers\Auth\ResetPasswordController::class,'showResetForm'])->name('password.reset');
Route::post('password/reset', [\App\Http\Controllers\Auth\ResetPasswordController::class,'reset'])->name('password.update');
//
// 再次确认密码（重要操作前提示）
Route::get('password/confirm', [\App\Http\Controllers\Auth\ConfirmPasswordController::class,'showConfirmForm'])->name('password.confirm');
Route::post('password/confirm', [\App\Http\Controllers\Auth\ConfirmPasswordController::class,'confirm']);
//
// 邮箱认证相关路由
Route::get('email/verify', [\App\Http\Controllers\Auth\VerificationController::class,'show'])->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [\App\Http\Controllers\Auth\VerificationController::class,'verify'])->name('verification.verify');
Route::post('email/resend', [\App\Http\Controllers\Auth\VerificationController::class,'resend'])->name('verification.resend');

// 游客可以看个人页面
Route::get('users/{user}', [\App\Http\Controllers\UsersController::class, 'show'])->name('users.show');

// 编辑、更新需要登录
Route::resource('users', \App\Http\Controllers\UsersController::class)
    ->only(['edit', 'update'])
    ->middleware('auth');

// 帖子资源路由
Route::resource('topics',\App\Http\Controllers\TopicController::class)->except('show');
Route::get('topics/{topic}/{slug?}', [\App\Http\Controllers\TopicController::class,'show'])->name('topics.show');
Route::post('upload_image',[\App\Http\Controllers\TopicController::class,'uploadImage'])->name('topics.upload_image');

//分类资源路由
Route::resource('categories',\App\Http\Controllers\CategoriesController::class)->only(['show']);

//帖子回复资源路由
Route::resource('replies',\App\Http\Controllers\ReplyController::class)->only(['store','destroy'])->middleware('auth');
