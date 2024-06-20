<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


Route::get('/',[PostController::class, 'index'])->name('home');
Route::get('/posts/{post:slug}',[PostController::class, 'show'])->name('post');
Route::get('/category',[CategoryController::class,'index'])->name('category');
Route::get('/category/{category:slug}',[CategoryController::class,'show'])->name('category.show');

Route::middleware('guest')->group(function () {
Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/login',[AuthController::class,'authenticate'])->name('login.authenticate');
Route::get('/register',[AuthController::class,'register'])->name('register');
Route::post('/register',[AuthController::class,'store'])->name('register.store');
});

Route::get('/otp/verify', [AuthController::class, 'verifyOtp'])->name('otp.verify');
Route::post('/otp/verify', [AuthController::class, 'postVerifyOtp'])->name('otp.postVerify');

Route::get('/forgot-password', function () {
    return view('Auth.reset_password');
})->middleware('guest')->name('password.request');
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
    $status = Password::sendResetLink(
        $request->only('email')
    );
    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', function (string $token) {
    return view('Auth.form_reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');
Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');


Route::get('/email/verify', function () {
    return view('Mail.verify-email');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/admin/posts');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');
Route::get('/admin/posts', function () {
    Return view('Mail.verify-email');
})->middleware(['auth', 'verified']);


Route::controller(App\Http\Controllers\Admin\PostController::class)->middleware(['auth:web','admin'])->group(function () {
    Route::get('/admin/posts', 'index')->name('admin.posts');
    Route::get('/admin/posts/create', 'create')->name('admin.posts.create');
    Route::post('/admin/posts', 'store')->name('admin.posts.store');
    Route::get('/admin/posts/{post}', 'show')->name('admin.posts.show');
    Route::get('/admin/posts/{post}/edit', 'edit')->name('admin.posts.edit');
    Route::put('/admin/posts/{post}', 'update')->name('admin.posts.update');
    Route::delete('/admin/posts/{post}', 'destroy')->name('admin.posts.destroy');
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
});

Route::controller(App\Http\Controllers\Admin\CategoryController::class)->middleware(['auth:web','admin'])->group(function () {
    Route::get('/admin/categories', 'index')->name('admin.categories');
    Route::get('/admin/categories/create', 'create')->name('admin.categories.create');
    Route::post('/admin/categories', 'store')->name('admin.categories.store');
    Route::get('/admin/categories/{category:slug}', 'show')->name('admin.categories.show');
    Route::get('/admin/categories/{category}/edit', 'edit')->name('admin.categories.edit');
    Route::put('/admin/categories/{category}', 'update')->name('admin.categories.update');
    Route::delete('/admin/categories/{category}', 'destroy')->name('admin.categories.destroy');
});

Route::controller(App\Http\Controllers\User\PostController::class)->middleware('auth:web')->group(function () {
    Route::get('/user/posts', 'index')->name('user.posts');
    Route::get('/user/posts/create', 'create')->name('user.posts.create');
    Route::post('/user/posts', 'store')->name('user.posts.store');
    Route::get('/user/posts/{post}', 'show')->name('user.posts.show');
    Route::get('/user/posts/{post}/edit', 'edit')->name('user.posts.edit');
    Route::put('/user/posts/{post}', 'update')->name('user.posts.update');
    Route::delete('/user/posts/{post}', 'destroy')->name('user.posts.destroy');
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
});



Route::controller(App\Http\Controllers\User\CategoryController::class)->middleware('auth:web')->group(function () {
    Route::get('/user/categories', 'index')->name('user.categories');
    Route::get('/user/categories/create', 'create')->name('user.categories.create');
    Route::post('/user/categories', 'store')->name('user.categories.store');
    Route::get('/user/categories/{category:slug}', 'show')->name('user.categories.show');
    Route::get('/user/categories/{category}/edit', 'edit')->name('user.categories.edit');
    Route::put('/user/categories/{category}', 'update')->name('user.categories.update');
    Route::delete('/user/categories/{category}', 'destroy')->name('user.categories.destroy');
});



