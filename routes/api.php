<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\IntervenantController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\StudentController;
use App\Models\Intervenant;
use App\Models\Promotion;
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

Route::middleware('api')->prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware('jwt.auth')->group(function () {
    Route::resource('promotions', PromotionController::class);
    Route::resource('students', StudentController::class);
    Route::resource('intervenants', IntervenantController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('notes', NoteController::class);
});
