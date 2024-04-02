<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RevisorController;
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

Route::get('/', [PageController::class, 'home'])->name('home');

// Route::post('/annunci.categoria', [PageController::class, 'searchByCategory'])->name('searchByCategory');

Route::get('/annunci/{id}', [AnnouncementController::class, 'announceView'])->name('announce.View');

Route::get('/categorie/{id}', [CategoryController::class, 'categoryView'])->name('category.View');

Route::get('/annunci', [AnnouncementController::class, 'showAnnouncements'])->name('show_announcements');

Route::get('/rendi/revisore/{user}', [RevisorController::class, 'makeRevisor'])->name('make.revisor');

Route::get('/ricerca/annuncio', [PageController::class, 'searchAnnouncements'])->name('announcements.search');

Route::post('/lingua/{lang}', [PageController::class, 'setLanguage'])->name('setLocale');
