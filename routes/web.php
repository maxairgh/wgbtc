<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/', [App\Http\Controllers\HomeController::class, 'logIn'])->name('login');  
/*
Administrators 
routes
*/
Route::group(['prefix' => 'admin',  'middleware' => 'auth'], function()
{
    //All the routes that belongs to the group goes here
    Route::get('dashboard', function() {} );
});
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard')->middleware(['auth']); 
Route::resource('/user', App\Http\Controllers\UserController::class)->middleware('auth');
Route::resource('/settings', App\Http\Controllers\SettingsController::class)->middleware('auth');
Route::get('/news', App\Http\Livewire\Admin\Annoucements::class)->name('news')->middleware('auth');
Route::get('/program', App\Http\Livewire\Admin\Program::class)->name('program')->middleware('auth');
Route::get('/course', App\Http\Livewire\Admin\Courses::class)->name('course')->middleware('auth');
Route::get('/learner-registration', App\Http\Livewire\Admin\Learners::class)->name('registerlearner')->middleware('auth');
Route::get('/learner-registration', App\Http\Livewire\Admin\Learners::class)->name('registerlearner')->middleware('auth');
Route::resource('/online-registration', App\Http\Controllers\OnlineRegistrationController::class);
 
require __DIR__.'/auth.php';
