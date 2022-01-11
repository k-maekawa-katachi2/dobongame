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

Route::get('start', function () {return view('games.gameStart');})->middleware('auth');;

Route::get('players', 'PlayersController@index')->middleware('auth');;
Route::post('players', 'PlayersController@enter');



Route::post('result', function () {return view('games.loading');});

Route::get('result', 'ResultController@index')->middleware('auth');;

Route::get('fighters', 'FighterController@afterMovie')->middleware('auth');;
Route::post('fighters', 'FighterController@index');

Route::get('demmon_words', 'DemmonController@index')->middleware('auth');;


Route::post('demmon_words', 'DemmonController@enter');
Route::get('gameStart', 'DemmonController@gameStart')->middleware('auth');;



Route::post('player/check', 'PlayersController@check');
Route::post('players/last', 'PlayersController@last');



Route::get('/', function () {return view('welcome');});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/opening', function () {
//     return view('layouts.opening');
// });

// Route::get('/demmon_words',function(){
//     return view('layouts.demmon_words');
// });
