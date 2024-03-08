<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


try{
    if(env('APP_ENV') == 'local'){
        Artisan::call('route:clear');
        Artisan::call('cache:clear');
    }
} catch(\Exception $e) {
    dd($e);
}

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

Route::resource('pages', \App\Domain\Pages\Controllers\PagesController::class);
Route::resource('posts', \App\Domain\Posts\Controllers\PostsController::class);
Route::resource('sections', \App\Domain\Sections\Controllers\SectionsController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
