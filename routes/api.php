<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\RoomController;

use App\Http\Controllers\ChatController;

use App\Http\Controllers\GigImagesController;

use App\Http\Controllers\GigController;
use App\Http\Controllers\ClientRequestController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\TaskController;

use App\Http\Controllers\TaskItemController;


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

//getUserGigs
Route::get('request/{id}', [ClientRequestController::class, 'show']);
Route::get('user/{id}/request', [ClientRequestController::class, 'getUserRequests']);
Route::get('request/{id}/user', [ClientRequestController::class, 'getRequestUser']);

  Route::get('user/{id}/cart', [CartController::class, 'getUserCartItems']);


Route::get('user/{id}/gig', [GigController::class, 'getUserGigs']);

Route::get('gig/{id}/user', [GigController::class, 'getGigUser']);
Route::get('gig/{id}/image', [GigImagesController::class, 'show']);
Route::post('/room', [RoomController::class, 'createRoom']);
Route::get('/room/{room_id}', [AuthController::class, 'show']);
Route::get('/room/users', [RoomController::class, 'getRoomByUsersId']);
Route::get('/room/{room_id}/users/{user_id}', [RoomController::class, 'getRoomByIdAndGetUsersData']);
Route::get('/room/{room_id}/users', [RoomController::class, 'getRoomUsers']);
Route::get('/user/{user_id}/rooms', [UserController::class, 'getUserRooms']);
/* Route::get('/rooms/{room_id}', function (App\Channel $channel) {
  if (!request()->wantsJson()) {
      abort(404);
  }

  $messages = App\Message::where('channel_id', $channel->id)->get();

  return $messages;
});

Route::post('/rooms/{room_id}', function (Request $room_id, $from, $to, $message ) {





  event(new MessageSent($room_id, $from, $to, $message));

  return response()->json(['status' => 'Message Sent!']);

}); */
Route::get('cartitem', [CartItemController::class, 'show']);

Route::get('gig/{id}', [GigController::class, 'show']);

Route::post('/chat', [ChatController::class, 'store']);
Route::post('/sendmsg', [ChatController::class, 'sendMessage']);


Route::get('guest-users/handymen/search', [UserController::class, 'searchHandymen']);
Route::get('guest-users/handymen/search/paginate', [UserController::class, 'searchHandymenPaginate']);


Route::get('guest-users/handymen', [UserController::class, 'handymen']);
Route::get('guest-users/{id}', [UserController::class, 'getUser']);

Route::post('/sanctum/token', TokenController::class);

Route::middleware(['auth:sanctum'])->group(function () {
  Route::get('/users/auth', AuthController::class);
  Route::resource('users', UserController::class);
  Route::post('/users/auth/avatar', [AvatarController::class, 'upload_user_photo']);

  Route::post('gig', [GigController::class, 'store']);

  Route::post('gig/image/{gigId}', [GigImagesController::class, 'store']);
  Route::post('request', [ClientRequestController::class, 'store']);
  Route::post('cart', [CartController::class, 'create']);
  Route::post('add-to-cart', [CartItemController::class, 'store']);
  Route::post('task', [TaskController::class, 'create']);
  Route::post('add-to-task-list', [TaskItemController::class, 'store']);


});
