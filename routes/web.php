<?php

use App\Http\Livewire\User;
use App\Http\Livewire\Songs;
use App\Http\Livewire\Contacts;
use App\Http\Livewire\StatusTypes;
use App\Http\Livewire\ContactTypes;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/users', User::class)->name('users');
Route::get('/contacts', Contacts::class)->name('contacts');
Route::get('/songs', Songs::class)->name('songs');

Route::get('/contact-types', ContactTypes::class)->name('songs');
Route::get('/status-types', StatusTypes::class)->name('songs');
Route::get('/users', User::class)->name('users');



Route::get('/maint', [App\Http\Controllers\MaintController::class, 'index'])->name('maint');

//Route::get('admin_area', ['middleware' => 'admin', function () {
//
// }]);

Route::group(['middleware' => 'is_admin'], function () {
       // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    });

    Route::group(['middleware' => 'auth'], function () {
// Songs
//Route::get('/', [\App\Http\Controllers\SongController::class, 'index'])->name('songs');

Route::resource('setlistgroups', \App\Http\Controllers\SetlistGroupsController::class);
    
Route::get('setlists/create/{id}', [
    'as' => 'setlists.create',
    'uses' => '\App\Http\Controllers\SetlistsController@create'
]);

Route::get('setlists/report/{id}', [
    'as' => 'setlists.report',
    'uses' => '\App\Http\Controllers\SetlistsController@report'
]);

Route::resource('setlists', \App\Http\Controllers\SetlistsController::class, 
    ['except' => 'create']);
 
Route::post('setlists/storecopy', [
    'as' => 'setlists.storecopy',
    'uses' => '\App\Http\Controllers\SetlistsController@storecopy'
]);

Route::get('/setlists/{id}/sort', '\App\Http\Controllers\SetlistsController@sort')->name('setlists.sort');

Route::get('/setlists/{id}/copy', '\App\Http\Controllers\SetlistsController@copy')->name('setlists.copy');

Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');

Route::post('/profile',  [App\Http\Controllers\ChangePasswordController::class,'changePassword'])->name('profile.change.password');
    });