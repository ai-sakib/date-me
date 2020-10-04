<?php

use Illuminate\Support\Facades\Route;
//Clear Cache facade value:
Route::get('reboot', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    file_put_contents(storage_path('logs/laravel.log'),'');
    Artisan::call('key:generate');
    Artisan::call('config:cache');
    return '<center><h1>System Rebooted!</h1></center>';
});

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'HomeController@userProfile')->name('profile');
Route::get('/users', 'HomeController@userList')->name('user-list');
Route::put('/users', 'HomeController@updateProfile')->name('update.profile');
Route::get('/change-password', 'HomeController@changePassword')->name('change-password');
Route::post('/update-password', 'HomeController@updatePassword')->name('update.password');
Route::get('/update-location/{data}', 'HomeController@updateLocation')->name('update-location');
Route::get('/like-status/{data}', 'HomeController@likeStatus')->name('like-status');
