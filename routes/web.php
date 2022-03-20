<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialController;


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
Route::get('fire', function () {
    // this fires the event
    event(new App\Events\MessageSent());
    return "event fired";
});

Route::get('test', function () {
    // this checks for the event
    return view('test');
});
Route::post('/channels/{channel}/messages', function (App\Channel $channel) {
    $message = Message::forceCreate([
        'channel_id' => $channel->id,
        'author_username' => request('username'),
        'message' => request('message'),
    ]);

    return $message;
});
Route::get('/social/{provider}', [SocialController::class,'redirectToProvider']);
Route::get('social/{provider}/callback', [SocialController::class, 'handleProviderCallback']);
Route::get('/', function () {
    return view('welcome');
});



