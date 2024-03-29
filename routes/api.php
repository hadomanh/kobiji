<?php

use App\Http\Controllers\LessonController;
use App\Http\Controllers\SubjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('subjects')->group(function () {
    Route::delete('/{id}', [SubjectController::class, 'destroy'])->name('api.subjects.delete');
});

Route::prefix('lessons')->group(function () {
    Route::delete('/{lesson}', [LessonController::class, 'destroy'])->name('api.lessons.delete');
});
