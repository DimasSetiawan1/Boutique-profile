<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\PhilosophyController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\TranslationController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Verifikasi Keamanan Pengunjung Manusia Asli (Real Human Verification Gatekeeper)
Route::get('/security/verification', [\App\Http\Controllers\SecurityVerificationController::class, 'showVerification'])->name('security.verification');
Route::redirect('/security/challenge', '/security/verification')->name('security.challenge');
Route::post('/security/verify', [\App\Http\Controllers\SecurityVerificationController::class, 'verifyHuman'])->middleware('throttle:live-check')->name('security.verify');

// Public Frontend Protected by Human Verification ("Saya bukan robot")
Route::middleware(['bot.challenge'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('/contact', [HomeController::class, 'submitContact'])->middleware('throttle:contact')->name('contact.submit');
    Route::post('/check-contact-email', [HomeController::class, 'checkContactEmail'])->middleware('throttle:live-check')->name('contact.check_email');
    Route::post('/check-contact-phone', [HomeController::class, 'checkContactPhone'])->middleware('throttle:live-check')->name('contact.check_phone');
});

// Custom Secret Admin Access URL (No /admin/login, No /login suffix)
Route::get('/abisg-ji4n', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/abisg-ji4n', [LoginController::class, 'login'])->middleware('throttle:login')->name('admin.login.post');

// Admin Authentication (Logout, Check Email, OTP, Password Reset)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/check-email', [LoginController::class, 'checkEmail'])->middleware('throttle:live-check')->name('check_email');

    // New Account OTP Verification (First Login Activation)
    Route::get('/activate-account/otp', [LoginController::class, 'showNewAccountOtpForm'])->name('account.otp.form');
    Route::post('/activate-account/otp', [LoginController::class, 'verifyNewAccountOtp'])->middleware('throttle:otp')->name('account.otp.verify');
    Route::post('/activate-account/resend', [LoginController::class, 'resendNewAccountOtp'])->middleware('throttle:otp')->name('account.otp.resend');

    // Forgot Password with OTP
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->name('password.forgot');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetOtp'])->middleware('throttle:otp')->name('password.send_otp');
    Route::get('/reset-password/otp', [ForgotPasswordController::class, 'showResetOtpForm'])->name('password.otp.form');
    Route::post('/reset-password/otp', [ForgotPasswordController::class, 'verifyResetOtp'])->middleware('throttle:otp')->name('password.otp.verify');
    Route::post('/reset-password/resend', [ForgotPasswordController::class, 'resendResetOtp'])->middleware('throttle:otp')->name('password.otp.resend');
    Route::post('/reset-password/lockout-send-otp', [ForgotPasswordController::class, 'sendLockoutOtp'])->middleware('throttle:otp')->name('password.lockout.send_otp');
    Route::get('/reset-password/new', [ForgotPasswordController::class, 'showNewPasswordForm'])->name('password.new.form');
    Route::post('/reset-password/new', [ForgotPasswordController::class, 'updateNewPassword'])->middleware('throttle:otp')->name('password.update_new');
});

// Secure Admin Panel Area
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Philosophy Items CRUD
    Route::resource('philosophies', PhilosophyController::class)->except(['show']);

    // Services CRUD
    Route::resource('services', ServiceController::class)->except(['show']);

    // Portfolios CRUD
    Route::resource('portfolios', PortfolioController::class)->except(['show']);

    // Clients CRUD
    Route::resource('clients', ClientController::class)->except(['show']);
    Route::delete('clients/product/{id}', [ClientController::class, 'deleteProductImage'])->name('clients.deleteProduct');
    Route::post('clients/product/{id}/dimension', [ClientController::class, 'updateProductDimensionAjax'])->name('clients.updateProductDimension');

    // Team Members CRUD
    Route::resource('team', TeamController::class)->except(['show']);

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    Route::post('/settings/logo', [SettingController::class, 'uploadLogo'])->name('settings.logo');
    Route::post('/settings/philosophy-image', [SettingController::class, 'uploadPhilosophyImage'])->name('settings.philosophy_image');
    Route::post('/settings/philosophy-image/delete', [SettingController::class, 'deletePhilosophyImage'])->name('settings.philosophy_image.delete');
    Route::post('/settings/fix-permissions', [SettingController::class, 'fixPermissions'])->name('settings.fix_permissions');
    Route::post('/settings/contacts/save', [SettingController::class, 'saveContactsAjax'])->name('settings.contacts.save');


    // Inbox Messages
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

    // Auto-Translate API
    Route::post('/translate', [TranslationController::class, 'translate'])->name('translate');

    // Admin Profile & Password Management
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::post('/profile/admins', [ProfileController::class, 'storeAdmin'])->name('profile.admins.store');
    Route::delete('/profile/admins/{admin}', [ProfileController::class, 'destroyAdmin'])->name('profile.admins.destroy');
});

// Language Switcher Route
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');
