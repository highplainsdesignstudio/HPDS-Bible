<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;


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

Route::get('/', function() {
    return view('welcome');
});

Route::get('/{book}/{chapter}', 'Bible\GetBibleController@getBibleChapterText');

Route::get('/read', function(Request $request) {
    return view('bible.index');
}) ->name('bible');

Route::get('/home', 'HomeController@index')->name('home'); 

Route::get('/dashboard', 'Admin\DashboardController@index') -> name('dashboard') -> middleware('can:admin');

Auth::routes();

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware(['auth'])->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Sanctum test
// Route::middleware('auth:sanctum')->get('/stest', function (Request $request) {
//     return $request->user();
// });
