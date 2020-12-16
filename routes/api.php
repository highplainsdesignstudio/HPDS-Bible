<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/books','Bible\GetBibleController@getBibleBooks');
Route::get('/chapter/{chapter_id}', 'Bible\GetBibleController@getChapterById');


Route::get('/{book_id}/{chapter}', 'Bible\GetBibleController@getBibleChapterText');

Route::resource('highlights', Bible\HighlightController::class)->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/stest', function (Request $request) {
    return $request->user();
});
