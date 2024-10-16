<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersManagementController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/email/verify', function(){
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function(EmailVerificationRequest $request){
    $request->fullfill();
    return redirect('/home');
})->middleware(['auth','signed'])->name('verification.verify');

Route::post('/email/verification-notification', function(Request $request){
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification Link sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // user management
    Route::get('/management_users', [UsersManagementController::class, 'index']);
    Route::get('/management_users/detail/{id}', [UsersManagementController::class, 'detail']);
    Route::patch('/management_users/update', [UsersManagementController::class, 'update']);
    Route::get('/management_users/delete/{id}', [UsersManagementController::class, 'delete']);
});

require __DIR__.'/auth.php';
