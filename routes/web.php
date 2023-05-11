<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Developer_ProjectController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketManagementController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/',[DashboardController::class, 'Index'])->middleware('auth');
Route::get('/projects', [ProjectController::class, 'index'])->middleware('auth');
Route::post('/projects', [ProjectController::class, 'store'])->middleware('auth');
Route::get('/project/{project:id}', [ProjectController::class, 'show'])->middleware('auth');
Route::delete('/projects/project/destroy/{project:id}', [ProjectController::class, 'destroy'])->middleware('auth', 'can:destroy,project');

Route::post('/projects/assign-dev',[Developer_ProjectController::class, 'store'])->middleware('auth');
Route::delete('/projects/developer/destroy/', [Developer_ProjectController::class,'destroy'])->middleware('auth');

Route::get('/ticket/create', [TicketController::class, 'create'])->middleware('auth');
Route::delete('/ticket/destroy/{ticket:id}', [TicketController::class, 'destroy'])->middleware('auth');
Route::post('/ticket/store', [TicketController::class, 'store'])->middleware('auth');
Route::get('/ticket/update/{ticket:id}', [TicketController::class, 'update'])->middleware('auth');
Route::patch('/ticket/update/{ticket:id}', [TicketManagementController::class, 'update'])->middleware('auth');

Route::post('/notification/mark-as-read', [NotificationController::class, 'store'])->middleware('auth');

Route::get('/notifications',[NotificationController::class, 'index'])->middleware('auth');;

Route::post('/flash-message/delete', function (){
    session()->forget('message');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
