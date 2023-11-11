<?php

use App\Http\Controllers\Ai\AuthController;
use App\Http\Controllers\VideoController;
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
Route::prefix( 'auth' )->group( function() {
    Route::post( 'login', [ AuthController::class, 'login' ] );
    Route::post( 'register', [ AuthController::class, 'register' ] );
} );
Route::middleware( 'auth:sanctum' )->get( '/user', function( Request $request ) {
    return $request->user();
} );

Route::middleware( 'auth:sanctum' )->group( function() {
    Route::prefix( 'videos' )->controller( VideoController::class )->group( function() {
        Route::get( '/', 'index' );
        Route::get( '/mine', 'userVideos' );
        Route::post( '/', 'store' );
    } );
} );
