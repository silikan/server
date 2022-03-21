<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialController;

use App\Models\Room;
use App\Models\User;


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






Route::get('/social/{provider}', [SocialController::class,'redirectToProvider']);
Route::get('social/{provider}/callback', [SocialController::class, 'handleProviderCallback']);
Route::get('/', function () {
    return view('welcome');
});



Route::get('/users', function () {


    //all rooms that are attacked to users with id one and two
    $rooms = Room::whereHas('users', function ($query) {
        $query->where('user_id', 2);
    })->WhereHas('users', function ($query) {
        $query->where('user_id', 1);
    })->get();

    return $rooms;


    });
