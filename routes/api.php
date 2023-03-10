<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\API\ChartDataController;

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

Route::get('me', function(Request $request) {

    $userId = $request->input('userId');

    $user = User::find($userId);
    return $user;
});

Route::controller(ChartDataController::class)->group(function() {

    Route::get('dashboard', 'index');
    Route::post('dashboard/save-user-input', 'store');

});

Route::group([
    'prefix' => 'auth'
], function () {
    
    Route::post('/login', 'App\Http\Controllers\Auth\AuthController@handleLogin')->name('login.handle'); 

    // Route::post('/logout', 'App\Http\Controllers\Auth\AuthController@handleLogout')->name('logout.handle');
    
});
