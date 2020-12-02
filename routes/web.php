<?php
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\LendingController;
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
    return view('index');
});

Route::resource('movies', 'MoviesController');

Route::resource('members', 'MembersController');

Route::resource('lending', 'LendingController');
