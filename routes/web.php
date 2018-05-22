<?php

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

//route with string msg
Route::get('/home', function () {
    return 'Welcome to Home';
});

//route with parameter
Route::get('/user/{id}', function ($id) {
    return $id;
});

//route with calling view(user.blade.php)
Route::get('/user', function () {
    return view('user');
});

//route with calling view(user.blade.php)
Route::get('/user/detail/{name}', function ($name) {
    return view('user.profile',compact('name'));
});

//route with controller
Route::get('/user/profile', 'ProfilesController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('test','CurdsController');


// crud operation using resource
Route::resource('blog','BlogsController');
Route::post('/update','BlogsController@updateData');

// for deleting 
Route::delete('blog/{id}', 'BlogsController@destroy');



Route::get('downloadExcel/{type}', 'BlogsController@downloadExcel');

// cors middlewear example
// Route::get('', ['middleware' => 'cors', function() {
//        return view('welcome');
// }])->middleware('auth');

Route::get('', ['middleware' => 'cors', function() {
       return view('welcome');
}]);




