<?php

use App\Http\Controllers\TodoController;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Scramble\WebistesController;
use App\Http\Controllers\Doc\Website\ShowController as WebsiteShowController;
use App\Http\Controllers\Scramble\AdvertiserController;
use App\Http\Controllers\Doc\Advertiser\ShowController as AdvertiserShowController;
use App\Http\Controllers\Doc\Offer\ListController as OfferListController;
use App\Http\Controllers\Doc\Offer\ShowController as OfferShowController;
use App\Http\Controllers\Scramble\TransactionController as TransactionListController;
use App\Http\Controllers\Scramble\GenerateController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// routes/api.php
Route::group(['middleware' => ['doc.auth', 'throttle:60,1'], 'prefix' => 'v0.1'], function () {
    Route::get('websites', WebistesController::class);
    Route::get('websites/{id}',[ WebistesController::class,'show_By_id']);
    Route::get('advertisers', AdvertiserController::class);
    Route::get('advertisers/{id}', [AdvertiserController::class,'show_by_id']);
    Route::get('transactions', TransactionListController::class);
    Route::post('generate-tracking-link/{id}', [GenerateController::class,'tracking_link']);
    Route::post('generate-deep-link/{id}',[ GenerateController::class,'deep_link']);
    });
    // Route::get('websites/{id}', WebsiteShowController::class);
    
    // Route::get('advertisers/{id}', AdvertiserShowController::class);
    // Route::get('offers', OfferListController::class);
    // Route::get('offer/{id}', OfferShowController::class);
    // Route::get('transactions', TransactionListController::class);
    // Route::post('generate-link/{id}', TrackingLinkController::class);
    // Route::post('generate-deep-link/{id}', DeeplinkController::class);

// Route::get('/get_users',function(){
//     $user=User::where('type','admin')->first();
   
//     return response()->json(['user'=>$user]);
// });
