<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AboutController as AdminAboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\FaqPageController;
use App\Http\Controllers\Admin\HomeDashController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JoinUsController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ReorderController;
use App\Http\Controllers\ReservationController;
use GuzzleHttp\Middleware;
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


// home page
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/store', [HomeController::class, 'store'])->name('form.store');

// change lang
Route::get('lang/{lang}', [LanguageController::class, 'switchLang'])->name('lang.switchLang');

// join form
Route::get('join_us', [JoinUsController::class, 'show'])->name('join_us.show');
Route::post('join_us/store', [JoinUsController::class, 'join'])->name('join_us.store');

// Page Faq and about
Route::get('faq', [FaqController::class, 'index'])->name('faq.index');
Route::get('about', [AboutController::class, 'index'])->name('about.index');


Route::group(['middleware' => 'guest'], function () {
    // auth
    Route::get('register', [RegisterController::class, 'index'])->name('dashboard.register');
    Route::post('register', [RegisterController::class, 'register'])->name('dashboard.register.submit');

    Route::get('verify-email', [RegisterController::class, 'showVerificationForm'])->name('dashboard.verify.register');
    Route::post('verify-emaill', [RegisterController::class, 'verifyEmail'])->name('dashboard.verify.submit.otp');
    Route::get('fresh-code-email', [RegisterController::class, 'freshCodeEmail'])->name('dashboard.fresh.code.email');

    Route::get('complete-profile', [RegisterController::class, 'showCompleteProfileForm'])->name('dashboard.profile.complete.show');
    Route::post('complete-profile', [RegisterController::class, 'completeProfile'])->name('dashboard.profile.complete.submit');

    Route::get('login', [LoginController::class, 'index'])->name('dashboard.login.index');
    Route::post('login/submit', [LoginController::class, 'login'])->name('dashboard.login.form');
    Route::get('forgot-password', [LoginController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('forgot-password', [LoginController::class, 'sendResetOTP'])->name('password.email');
    Route::get('verify-code', [LoginController::class, 'showVerifyCodeForm'])->name('dashboard.verify.show');
    Route::post('verify-code', [LoginController::class, 'verifyCode'])->name('dashboard.verify.submit');

    Route::get('reset-password', [LoginController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('reset-password', [LoginController::class, 'resetPassword'])->name('password.update');
});

// pages show just to admin role and with two factor auth
Route::group(['prefix' => 'dashboard', 'middleware' => 'admin'], function () {
    Route::get('notifications', [NotificationController::class, 'notifications'])->name('dashboard.notifications.read');

    // item order
    Route::get('/{segment}/re-order/{id?}', [ReorderController::class, 'index'])->name('dashboard.reorder.index');
    Route::post('/re-order/update', [ReorderController::class, 'update'])->name('dashboard.reorder.update');

    //logout
    Route::get('logout', [LoginController::class, 'logout'])->name('dashboard.logout');


    //profile
    Route::get('profile', [ProfileController::class, 'index'])->name('dashboard.profile.index');
    Route::post('profile/update', [ProfileController::class, 'update'])->name('dashboard.profile.update');
    Route::get('password', [ProfileController::class, 'password'])->name('dashboard.password.index');
    Route::post('password/change', [ProfileController::class, 'update_password'])->name('dashboard.password.update');

    //agents
    Route::get('agents', [AgentController::class, 'index'])->name('dashboard.agents.index');
    Route::get('agents/create', [AgentController::class, 'create'])->name('dashboard.agents.create');
    Route::post('agents/store', [AgentController::class, 'store'])->name('dashboard.agents.store');
    Route::get('agents/{obj}/edit', [AgentController::class, 'edit'])->name('dashboard.agents.edit');
    Route::post('agents/{obj}/update', [AgentController::class, 'update'])->name('dashboard.agents.update');
    Route::delete('agents/{obj}/delete', [AgentController::class, 'destroy'])->name('dashboard.agents.destroy');

    //admins
    Route::get('admins', [AdminController::class, 'index'])->name('dashboard.admins.index');
    Route::get('admins/create', [AdminController::class, 'create'])->name('dashboard.admins.create');
    Route::post('admins/store', [AdminController::class, 'store'])->name('dashboard.admins.store');
    Route::get('admins/{obj}/edit', [AdminController::class, 'edit'])->name('dashboard.admins.edit');
    Route::post('admins/{obj}/update', [AdminController::class, 'update'])->name('dashboard.admins.update');
    Route::delete('admins/{obj}/delete', [AdminController::class, 'destroy'])->name('dashboard.admins.destroy');

    //settings
    Route::get('/settings', [SettingController::class, 'index'])->name('dashboard.settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('dashboard.settings.update');


    //pages  == faqs
    Route::get('faqs', [FaqPageController::class, 'index'])->name('dashboard.faqs.index');
    Route::get('faqs/create', [FaqPageController::class, 'create'])->name('dashboard.faqs.create');
    Route::post('faqs/store', [FaqPageController::class, 'store'])->name('dashboard.faqs.store');
    Route::get('faqs/{obj}/edit', [FaqPageController::class, 'edit'])->name('dashboard.faqs.edit');
    Route::post('faqs/{obj}/update', [FaqPageController::class, 'update'])->name('dashboard.faqs.update');
    Route::delete('faqs/{obj}/delete', [FaqPageController::class, 'destroy'])->name('dashboard.faqs.destroy');


    //pages  == about
    Route::get('about', [AdminAboutController::class, 'edit'])->name('dashboard.about.index');
    Route::post('about/update', [AdminAboutController::class, 'update'])->name('dashboard.about.update');


    //reservation
    Route::get('reservations', [ReservationController::class, 'index'])->name('dashboard.reservations.index');
    Route::delete('reservations/{obj}/delete', [ReservationController::class, 'destroy'])->name('dashboard.reservations.destroy');

    //join_us
    Route::get('join_us', [JoinUsController::class, 'index'])->name('dashboard.join_us.index');
    Route::delete('join_us/{obj}/delete', [JoinUsController::class, 'destroy'])->name('dashboard.join_us.destroy');

    //Offers Just for admin
    Route::get('offers', [OfferController::class, 'index'])->name('dashboard.offers.index');
    Route::get('offers/{obj}/edit', [OfferController::class, 'edit'])->name('dashboard.offers.edit');
    Route::post('offers/{obj}/update', [OfferController::class, 'update'])->name('dashboard.offers.update');

    //Events
    Route::get('events/create', [EventController::class, 'create'])->name('dashboard.events.create');
    Route::post('events/store', [EventController::class, 'store'])->name('dashboard.events.store');
    Route::get('events/{obj}/edit', [EventController::class, 'edit'])->name('dashboard.events.edit');
    Route::post('events/{obj}/update', [EventController::class, 'update'])->name('dashboard.events.update');
    Route::delete('events/{obj}/delete', [EventController::class, 'destroy'])->name('dashboard.events.destroy');
});

// both admin and agent can show this pages
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    //home page
    Route::get('/', [HomeDashController::class, 'index'])->name('dashboard.home');

    //logout
    Route::get('logout', [LoginController::class, 'logout'])->name('dashboard.logout');

    //profile
    Route::get('profile', [ProfileController::class, 'index'])->name('dashboard.profile.index');
    Route::post('profile/update', [ProfileController::class, 'update'])->name('dashboard.profile.update');
    Route::get('password', [ProfileController::class, 'password'])->name('dashboard.password.index');
    Route::post('password/change', [ProfileController::class, 'update_password'])->name('dashboard.password.update');

    // offer for all auth
    Route::get('offers/my_offers', [OfferController::class, 'myOffers'])->name('dashboard.my_offers.index');
    Route::get('offers/{obj}/show', [OfferController::class, 'show'])->name('dashboard.offers.show');
    Route::get('offers/create', [OfferController::class, 'create'])->name('dashboard.offers.create');
    Route::post('offers/store', [OfferController::class, 'store'])->name('dashboard.offers.store');
    Route::delete('offers/{obj}/delete', [OfferController::class, 'destroy'])->name('dashboard.offers.destroy');

    // show just events
    Route::get('events', [EventController::class, 'index'])->name('dashboard.events.index');
    Route::get('events/{obj}/show', [EventController::class, 'show'])->name('dashboard.events.show');
});
