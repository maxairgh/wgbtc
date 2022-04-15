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
//Route::get('/user/profile', App\Http\Livewire\UserProfile::class)->name('');

/*
Administrators 
routes
*/
Route::group(['prefix' => 'admin',  'middleware' => 'auth'], function()
{
    //All the routes that belongs to the group goes here
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard'); 
    Route::get('/user/profile', [App\Http\Controllers\UserController::class, 'adminProfile'])->name('userprofile'); 
    //Route::resource('/user', App\Http\Controllers\UserController::class);
    Route::get('/user/management', App\Http\Livewire\UserManagement::class)->name('manageuser');
    Route::resource('/settings', App\Http\Controllers\SettingsController::class);
    Route::get('/news', App\Http\Livewire\Admin\Annoucements::class)->name('news');
    Route::get('/program', App\Http\Livewire\Admin\Program::class)->name('program');
    Route::get('/course', App\Http\Livewire\Admin\Courses::class)->name('course');
    Route::get('/learner-registration', App\Http\Livewire\Admin\Learners::class)->name('registerlearner');
    Route::get('/search-learner', App\Http\Livewire\Admin\Searchlearner::class)->name('searchlearner');
    Route::get('/edit-learner/{learnerid}', App\Http\Livewire\Admin\Editlearner::class)->name('editlearner');
    Route::get('/online-approval', App\Http\Livewire\Admin\Onlineapprove::class)->name('onlineapprove');
    Route::get('/sessions', App\Http\Livewire\Admin\Session::class)->name('session');
    Route::get('learners/course/registration', App\Http\Livewire\Admin\LearnerCourseRegistration::class)->name('admincoursereg');
    Route::get('facilitators/course/registration', App\Http\Livewire\Admin\FacilitatorCoursereg::class)->name('teacherscoursereg');
    
});


/*
Facilitators 
routes
*/
Route::group(['prefix' => 'facilitators',  'middleware' => 'auth'], function()
{
    Route::get('news', App\Http\Livewire\Facilitators\Displaynews::class)->name('fnews');
    Route::get('course/content', App\Http\Livewire\Facilitators\Coursecontent::class)->name('fcoursecontent');
    Route::post('course/video/upload', [App\Http\Controllers\FacilitatorController::class, 'uploadVideo'])->name('uploadvideo'); 
    Route::get('course/work', App\Http\Livewire\Facilitators\Coursecontent::class)->name('fcoursecontent');

});

require __DIR__.'/auth.php';
