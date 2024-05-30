<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\ActorManagementController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\PlaceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\EmojiController;
use App\Http\Controllers\ArtistInformation;
use App\Http\Controllers\UserPlaceController;

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
Route::get('/', function () {
    return redirect('/dashboard');
})->middleware('auth');
Route::get('/events/{eventId}/places', [UserPlaceController::class, 'showPlaceAreas']);
Route::get('/errorplace', function () {
    return view('account-pages/error');
})->name('errorplace');
Route::resource('/events', EvenementController::class);
Route::get('/event/list', [EvenementController::class, 'indexFront'])->name('eventslist');
Route::resource('/articles', ArticleController::class);
Route::get('/articles/{eventId}', [ArticleController::class, 'create']);
Route::resource('/payments', PaymentController::class);
Route::resource('/tickets', TicketController::class);
Route::get('/checkout', 'App\Http\Controllers\StripeController@checkout')->name('checkout');
Route::post('/session', 'App\Http\Controllers\StripeController@session')->name('session');
Route::get('/success', 'App\Http\Controllers\StripeController@success')->name('success');
Route::get('actor-management', [ActorManagementController::class, 'index'])->name('actor-management.index');
Route::get('actor-management-create', [ActorManagementController::class, 'create'])->name('actor-management.create');
Route::get('actor', [ActorManagementController::class, 'show'])->name('actor.show');
Route::get('actor-management-edit', [ActorManagementController::class, 'edit'])->name('actor-management.edit');
Route::post('actor-management', [ActorManagementController::class, 'store'])->name('actor-management.store');
Route::put('actor-management', [ActorManagementController::class, 'update'])->name('actor-management.update');
Route::delete('actor-management/{id}', [ActorManagementController::class, 'destroy'])->name('actor-management.destroy');
Route::resource('places', PlaceController::class);
Route::put('/places/{id}', [PlaceController::class, 'update'])->name('places.update');
Route::resource('areas', AreaController::class);
Route::delete('/areas/{id}', [AreaController::class, 'destroy'])->name('areas.destroy');
Route::resource('/domain-management', DomainController::class);
Route::get('/artists', [ArtistInformation::class, 'index']);
Route::get('/search-artist', [ArtistInformation::class, 'scrape'])->name('search-artist');
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
    Route::resource('/emoji', EmojiController::class);
    Route::resource('/comment', CommentaireController::class);
    Route::put('/comment/like/{id}', [CommentaireController::class, 'like'])->name("like");
    Route::put('/comment/dislike/{id}', [CommentaireController::class, 'dislike'])->name("dislike");
    Route::post('/comment/addEmoji', [CommentaireController::class, 'addEmoji'])->name('addEmoji');
    Route::post('/comment/removeEmoji', [CommentaireController::class, 'removeEmoji'])->name('removeEmoji');
    Route::post('/comment/replay', [CommentaireController::class, 'replay'])->name('commentReplay');
    Route::post('/comment/commentonEvent', [CommentaireController::class, 'commentonEvent'])->name('commentonEvent');
    Route::put('/comment/like/{id}', [CommentaireController::class, 'like'])->name("like");
    Route::put('/comment/dislike/{id}', [CommentaireController::class, 'dislike'])->name("dislike");
    Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
    Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static');
    Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
    Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static');
    Route::resource('places', PlaceController::class);
    Route::get('/{page}', [PageController::class, 'index'])->name('page');
    Route::delete('/places/{id}', [PlaceController::class, 'destroy'])->name('places.destroy');
    Route::delete('/areas/{id}', [AreaController::class, 'destroy'])->name('areas.destroy');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

