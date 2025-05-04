<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Meeting validation route
Route::post('/validate-meeting-access', 'App\Http\Controllers\Api\MeetingController@validateMeetingAccess');

// Debug route to check authentication status
Route::get('/check-auth', function() {
    return response()->json([
        'client_auth' => auth()->guard('client')->check(),
        'professional_auth' => auth()->guard('professional')->check(),
        'client_id' => auth()->guard('client')->check() ? auth()->guard('client')->id() : null,
        'professional_id' => auth()->guard('professional')->check() ? auth()->guard('professional')->id() : null,
    ]);
});
