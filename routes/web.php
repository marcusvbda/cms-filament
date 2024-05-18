<?php

use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/set-language/{lang}', [PagesController::class, 'setLanguage'])->name('set-language');
Route::get('/webhook/{slug}', [PagesController::class, 'webhook'])->name('webhook');
Route::get('/{slug}', [PagesController::class, 'show'])->where('slug', '.*');
