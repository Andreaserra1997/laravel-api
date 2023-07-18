<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TechnologyController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('projects', [ProjectController::class, 'index'])->name('api.projects.index');
Route::get('projects/random', [ProjectController::class, 'random'])->name('api.projects.random');
Route::get('projects/{project}', [ProjectController::class, 'show'])->name('api.projects.show');
Route::get('technologies', [TechnologyController::class, 'index'])->name('api.technologies.index');
