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
Route::get('/online/registration', App\Http\Livewire\Admin\Onlineregistration::class);

/*
Administrators 
routes
*/
Route::group(['prefix' => 'admin',  'middleware' => 'auth'], function()
{
    //All the routes that belongs to the group goes here
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard'); 
    Route::resource('/user', App\Http\Controllers\UserController::class);
    Route::resource('/settings', App\Http\Controllers\SettingsController::class);
    Route::get('/news', App\Http\Livewire\Admin\Annoucements::class)->name('news');
    Route::get('/program', App\Http\Livewire\Admin\Program::class)->name('program');
    Route::get('/course', App\Http\Livewire\Admin\Courses::class)->name('course');
    Route::get('/learner-registration', App\Http\Livewire\Admin\Learners::class)->name('registerlearner');
    Route::get('/search-learner', App\Http\Livewire\Admin\Searchlearner::class)->name('searchlearner');
    Route::get('/edit-learner/{learnerid}', App\Http\Livewire\Admin\Editlearner::class)->name('editlearner');
    Route::get('/online-approval', App\Http\Livewire\Admin\Editlearner::class)->name('onlineapprove');
 
});

require __DIR__.'/auth.php';
