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

Route::resource('groups', 'GroupController', ['except' => [
    'edit', 'create'
]]);

Route::post('groups/{name}/join', 'GroupDetailsController@join');
Route::post('groups/{name}/leave', 'GroupDetailsController@leave');

Route::get('/testauth', function () {
    return response()->json([
        'message' => 'This is just a test authentication page'
    ]);
})->middleware('auth:api');
Auth::routes();

Route::get('/home', 'HomeController@index');
