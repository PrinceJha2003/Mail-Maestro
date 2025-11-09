<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\email_controller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\validUser;
use App\Http\Middleware\forAdm;
use App\Models\User;

Route::get('/', function () {
    return view('globalsoft/login');
});

// Grouped under /account prefix
Route::group(['prefix' => 'account'], function () {

    // Guest Routes
    Route::get('login', [LoginController::class, 'index'])->name('AccountLogin');
    Route::post('authenticate', [LoginController::class, 'authenticate'])->name('AccountAuthenticate');

    // Admin-only Routes
    Route::middleware(forAdm::class)->group(function () {
        Route::get('logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('profile', [ProfileController::class, 'profile'])->name('profile');

        // Email management
        Route::get('email', [email_controller::class, 'email_fun'])->name('email');
        Route::post('/email-process', [email_controller::class, 'email_data'])->name('email_data');
        Route::get('email-dashboard', [email_controller::class, 'email_dashboard'])->name('email_dashboard');
        Route::get('email_edit/{id}', [email_controller::class, 'email_edit'])->name('email_edit');
        Route::post('email_edit_process/{id}', [email_controller::class, 'email_edit_process'])->name('email_edit_process');
        Route::get('email_stop/{id}', [email_controller::class, 'email_stop'])->name('email_stop');
        Route::get('email_delete/{id}', [email_controller::class, 'email_delete'])->name('email_delete');
        Route::get('email_start/{id}', [email_controller::class, 'email_start'])->name('email_start');

        // User management
        Route::get('sign_up', [LoginController::class, 'sign_up'])->name('sign_up');
        Route::post('sign_up_process', [LoginController::class, 'sign_up_process'])->name('sign_up_process');

        // Password management
        Route::get('pw_change', [LoginController::class, 'pw_change'])->name('pw_change');
        Route::post('pw_change_process', [LoginController::class, 'pw_change_process'])->name('pw_change_process');
    });

    // Authenticated user routes
    Route::middleware(validUser::class)->group(function () {
        Route::get('logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('profile', [ProfileController::class, 'profile'])->name('profile');

        // Email functions
        Route::get('email', [email_controller::class, 'email_fun'])->name('email');
        Route::post('/email-process', [email_controller::class, 'email_data'])->name('email_data');
        Route::get('email-dashboard', [email_controller::class, 'email_dashboard'])->name('email_dashboard');
        Route::get('email_edit/{id}', [email_controller::class, 'email_edit'])->name('email_edit');
        Route::post('email_edit_process/{id}', [email_controller::class, 'email_edit_process'])->name('email_edit_process');
        Route::get('email_stop/{id}', [email_controller::class, 'email_stop'])->name('email_stop');
        Route::get('email_delete/{id}', [email_controller::class, 'email_delete'])->name('email_delete');
        Route::get('email_start/{id}', [email_controller::class, 'email_start'])->name('email_start');

        Route::get('pw_change', [LoginController::class, 'pw_change'])->name('pw_change');
        Route::post('pw_change_process', [LoginController::class, 'pw_change_process'])->name('pw_change_process');
    });

    // ======================
    // EMAIL VERIFICATION ROUTES
    // ======================

    // Optional fallback (only works when user is logged in)
    Route::get('/email/verify', function () {
        return redirect()->route('profile');
    })->middleware('auth')->name('verification.notice');

    // ✅ CUSTOM EMAIL VERIFICATION ROUTE (user doesn't need to be logged in)
    Route::get('/custom/email/verify/{id}/{hash}', function ($id, $hash, Request $request) {
        $user = User::findOrFail($id);

        if (! URL::hasValidSignature($request)) {
            abort(403, 'Invalid or expired verification link.');
        }

        if (! hash_equals(sha1($user->getEmailForVerification()), $hash)) {
            abort(403, 'Invalid verification hash.');
        }

        if ($user->hasVerifiedEmail()) {
            return response('Email already verified.', 200);
        }

        $user->markEmailAsVerified();

        return response('Email verified successfully!', 200);
    })->name('custom.verification.verify');

    // Only used when user is logged in and wants to re-send the email
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});
