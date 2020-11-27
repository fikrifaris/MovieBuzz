<?php

use Illuminate\Support\Facades\Route;
use App\Models\movies;

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

  $movies = movies::all();

    foreach($movies as $movies) {
        return $movies;
    }

    return view('index');
});
