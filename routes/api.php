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
use App\Http\Controllers\RatingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FeedController;

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotificationRoomController;
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
Route::get('/user/{id}/rating', [RatingController::class, 'getUserRatings']);

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
  Route::post('set-cart-items-status-to-paid', [CartItemController::class, 'setCartItemStatusToPaid']);
  Route::post('set-cart-items-status-to-in-progress', [CartItemController::class, 'setCartItemStatusToInProgress']);
  Route::post('set-cart-items-status-to-cancelled', [CartItemController::class, 'setCartItemStatusToCancelled']);
  Route::post('set-cart-items-status-to-completed', [CartItemController::class, 'setCartItemStatusToCompleted']);
  Route::post('set-cart-items-status-to-confirmed', [CartItemController::class, 'setCartItemStatusToConfirmed']);

  Route::post('set-task-items-status-to-in-progress', [TaskItemController::class, 'setTaskItemsStatusToInProgress']);
  Route::post('set-task-items-status-to-cancelled', [TaskItemController::class, 'setTaskItemsStatusToCancelled']);
  Route::post('set-task-items-status-to-completed', [TaskItemController::class, 'setTaskItemsStatusToCompleted']);
  Route::post('set-task-items-status-to-accepted', [TaskItemController::class, 'setTaskItemStatusToAccepted']);
  Route::post('set-task-items-status-to-declined', [TaskItemController::class, 'setTaskItemsStatusToDeclined']);
  Route::post('set-task-items-status-to-paid', [TaskItemController::class, 'setTaskItemsStatusToPaid']);
  Route::post('set-task-items-status-to-confirmed', [TaskItemController::class, 'setTaskItemStatusToConfirmed']);



  Route::get('/task/{id}', [TaskController::class, 'getTaskItemById']);
  Route::get('/cart/{id}', [CartController::class, 'getCartItemById']);


  Route::post('/transaction ', [TransactionController::class, 'create']);
  Route::get('/taskitem/{id}/transaction', [TransactionController::class, 'getTaskItemTransactions']);
  Route::get('/cartitem/{id}/transaction', [TransactionController::class, 'getCartItemTransactions']);
  Route::post('/set-transaction-to-paid ', [TransactionController::class, 'setTransactionToPaid']);

  Route::get('/transaction/{id}', [TransactionController::class, 'getTransactionById']);


  Route::post('/set-transaction-to-confirmed ', [TransactionController::class, 'setTransactionToConfirmed']);
  Route::post('/set-transaction-to-completed ', [TransactionController::class, 'setTransactionToCompleted']);

  Route::get('/transaction ', [TransactionController::class, 'index']);

  Route::post('/rating ', [RatingController::class, 'store']);
  Route::get('/gig/{id}/rating', [RatingController::class, 'getGigRatings']);
  Route::get('/request/{id}/rating', [RatingController::class, 'getClientRequestRatings']);


//admin
  Route::delete('/admin/delete-user/{id}', [AdminController::class, 'deleteUser']);
  Route::delete('/admin/delete-gig/{id}', [AdminController::class, 'deleteGig']);
  Route::delete('/admin/delete-request/{id}', [AdminController::class, 'deleteClientRequest']);
  Route::delete('/admin/delete-all-users', [AdminController::class, 'deleteAllUsers']);
  Route::delete('/admin/delete-all-gigs', [AdminController::class, 'deleteAllGigs']);
  Route::delete('/admin/delete-all-requests', [AdminController::class, 'deleteAllClientRequests']);
  Route::delete('/admin/delete-all', [AdminController::class, 'deleteAll']);
  Route::get('/admin/get-all-users', [AdminController::class, 'getAllUsers']);
  Route::get('/admin/get-all-gigs', [AdminController::class, 'getAllGigs']);
  Route::get('/admin/get-all-requests', [AdminController::class, 'getAllClientRequests']);
  Route::get('/admin/get-all-handymen', [AdminController::class, 'getAllHandymen']);
  Route::get('/admin/get-all-clients', [AdminController::class, 'getAllClients']);
  Route::get('/admin/get-all-admins', [AdminController::class, 'getAllAdmins']);
  Route::get('/admin/get-all-moderators', [AdminController::class, 'getAllModerators']);
  Route::post('/admin/make-user-admin/{id}', [AdminController::class, 'makeUserAdmin']);
  Route::post('/admin/make-user-moderator/{id}', [AdminController::class, 'makeUserModerator']);
  Route::post('/admin/make-user-handyman/{id}', [AdminController::class, 'makeUserHandyman']);
  Route::get('/admin/get-all-users-paginate', [AdminController::class, 'getAllUsersPaginate']);
  Route::get('/admin/get-all-gigs-paginate', [AdminController::class, 'getAllGigsPaginate']);
  Route::get('/admin/get-all-requests-paginate', [AdminController::class, 'getAllClientRequestsPaginate']);
  Route::get('/admin/get-all-handymen-paginate', [AdminController::class, 'getAllHandymenPaginate']);
  Route::get('/admin/get-all-clients-paginate', [AdminController::class, 'getAllClientsPaginate']);
  Route::get('/admin/get-all-admins-paginate', [AdminController::class, 'getAllAdminsPaginate']);
  Route::get('/admin/get-all-moderators-paginate', [AdminController::class, 'getAllModeratorsPaginate']);
  Route::get('/admin/get-all-transactions ', [AdminController::class, 'getAllTransactions']);


//moderator
  Route::delete('/moderator/delete-user/{id}', [AdminController::class, 'deleteUser']);
  Route::delete('/moderator/delete-gig/{id}', [AdminController::class, 'deleteGig']);
  Route::delete('/moderator/delete-request/{id}', [AdminController::class, 'deleteClientRequest']);
  Route::post('/moderator/make-user-handyman/{id}', [AdminController::class, 'makeUserHandyman']);
  Route::get('/moderator/get-all-users-paginate', [AdminController::class, 'getAllUsersPaginate']);
  Route::get('/moderator/get-all-gigs-paginate', [AdminController::class, 'getAllGigsPaginate']);
  Route::get('/moderator/get-all-requests-paginate', [AdminController::class, 'getAllClientRequestsPaginate']);
  Route::get('/moderator/get-all-handymen-paginate', [AdminController::class, 'getAllHandymenPaginate']);
  Route::get('/moderator/get-all-clients-paginate', [AdminController::class, 'getAllClientsPaginate']);
  Route::get('/moderator/get-all-admins-paginate', [AdminController::class, 'getAllAdminsPaginate']);
  Route::get('/moderator/get-all-moderators-paginate', [AdminController::class, 'getAllModeratorsPaginate']);




  Route::get('/feed/users', [FeedController::class, 'getThreeRandomUsers']);
  Route::get('/feed/gigs', [FeedController::class, 'getThreeRandomGigs']);
  Route::get('/feed/requests', [FeedController::class, 'getThreeRandomClientRequests']);
  Route::get('/feed/handymen', [FeedController::class, 'getThreeRandomHandymen']);
  Route::get('/feed/clients', [FeedController::class, 'getThreeRandomClients']);
  Route::post('/notification', [NotificationController::class, 'store']);
  Route::post('/notification/room', [NotificationRoomController::class, 'create']);
  Route::get('/notification/room/{id}', [NotificationRoomController::class, 'getRoomNotifications']);

Route::get('/user/{id}/notification/room', [NotificationRoomController::class, 'getUserNotificationRoom']);
Route::post('/chat/sendnotification', [ChatController::class, 'sendNotification']);


});



