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
use App\Http\Controllers\SearchController;


use App\Http\Controllers\CategoryController;

use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionController;
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

/* Route::post('/send-money', [TransactionController::class, 'store']);
 */



Route::get('/profile', [AccountController::class, 'index']);

Route::get('search', [SearchController::class, 'searchFunction']);
Route::get('search/gigs', [SearchController::class, 'searchGigs']);
Route::get('search/gigs/paginate', [SearchController::class, 'searchGigsPaginate']);
Route::get('search/requests', [SearchController::class, 'searchClientRequest']);
Route::get('search/requests/paginate', [SearchController::class, 'searchClientRequestPaginate']);
Route::get('search/handymen', [SearchController::class, 'searchHandymen']);
Route::get('search/handymen/paginate', [SearchController::class, 'searchHandymenPaginate']);

Route::get('request/{id}', [ClientRequestController::class, 'show']);
Route::get('user/{id}/request', [ClientRequestController::class, 'getUserRequests']);
Route::get('request/{id}/user', [ClientRequestController::class, 'getRequestUser']);
Route::get('user/{id}/gig', [GigController::class, 'getUserGigs']);
Route::get('gig/{id}/user', [GigController::class, 'getGigUser']);
Route::get('gig/{id}/image', [GigImagesController::class, 'show']);
Route::get('gig/{id}', [GigController::class, 'show']);

Route::get('cartitem/taskitem', [CartItemController::class, 'showTaskItem']);

Route::get('/gig/{id}/views', [GigController::class, 'views']);
Route::get('/request/{id}/views', [ClientRequestController::class, 'views']);

Route::get('/feed/gigs/{id}', [GigController::class, 'getMostViewed']);
Route::get('/feed/requests/{id}', [ClientRequestController::class, 'getMostViewed']);

Route::get('paginate/gig', [GigController::class, 'getGigsPaginate']);
Route::get('paginate/request', [ClientRequestController::class, 'getClientRequestsPaginate']);

Route::get('category/{title}/gigs/paginate', [CategoryController::class, 'getGigsByCategoryPaginate']);
Route::get('category/{title}/requests/paginate', [CategoryController::class, 'getclientRequestsByCategoryPaginate']);

Route::get('category', [CategoryController::class, 'index']);

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
  Route::get('chat/{room_id}', [ChatController::class, 'getChat']);
  Route::post('gig/image/{gigId}', [GigImagesController::class, 'store']);
  Route::post('request', [ClientRequestController::class, 'store']);
  Route::post('cart', [CartController::class, 'create']);
  Route::post('add-to-cart', [CartItemController::class, 'store']);
  Route::post('task', [TaskController::class, 'create']);
  Route::post('add-to-task-list', [TaskItemController::class, 'store']);
  Route::post('/room', [RoomController::class, 'createRoom']);
  Route::get('/room/{room_id}', [AuthController::class, 'show']);
  Route::get('/room/users', [RoomController::class, 'getRoomByUsersId']);
  Route::get('/room/{room_id}/users/{user_id}', [RoomController::class, 'getRoomByIdAndGetUsersData']);
  Route::get('/room/{room_id}/users', [RoomController::class, 'getRoomUsers']);
  Route::get('/user/{user_id}/rooms', [UserController::class, 'getUserRooms']);
  Route::post('/chat', [ChatController::class, 'store']);
  Route::post('/sendmsg', [ChatController::class, 'sendMessage']);
  Route::get('cartitem', [CartItemController::class, 'show']);
  Route::get('user/{id}/cart', [CartController::class, 'getUserCartItems']);
  Route::get('user/{id}/task', [TaskController::class, 'getUserTaskItems']);

  Route::post('set-cart-items-status-to-accepted', [CartItemController::class, 'setCartItemStatusToAccepted']);
  Route::post('set-cart-items-status-to-declined', [CartItemController::class, 'setCartItemStatusToDeclined']);
  Route::post('set-cart-items-status-to-paid', [CartItemController::class, ' setCartItemStatusToPaid']);
  Route::post('set-cart-items-status-to-in-progress', [CartItemController::class, 'setCartItemStatusToInProgress']);
  Route::post('set-cart-items-status-to-cancelled', [CartItemController::class, 'setCartItemStatusToCancelled']);
  Route::post('set-cart-items-status-to-completed', [CartItemController::class, 'setCartItemStatusToCompleted']);

  Route::post('set-task-items-status-to-in-progress', [TaskItemController::class, 'setTaskItemsStatusToInProgress']);
  Route::post('set-task-items-status-to-cancelled', [TaskItemController::class, 'setTaskItemsStatusToCancelled']);
  Route::post('set-task-items-status-to-completed', [TaskItemController::class, 'setTaskItemsStatusToCompleted']);
  Route::post('set-task-items-status-to-accepted', [TaskItemController::class, 'setTaskItemStatusToAccepted']);
  Route::post('set-task-items-status-to-declined', [TaskItemController::class, 'setTaskItemsStatusToDeclined']);
  Route::post('set-task-items-status-to-paid', [TaskItemController::class, 'setTaskItemsStatusToPaid']);

  Route::get('/task/{id}', [TaskController::class, 'getTaskItemById']);
  Route::get('/cart/{id}', [CartController::class, 'getCartItemById']);

});

