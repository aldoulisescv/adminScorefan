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

Route::get('/', function () {
    return redirect('/login');
});

// Auth::routes();
//  Route::get('/home', 'HomeController@index')->name('home');


Auth::routes(['verify' => true, 'register' => false]);

Route::middleware(['auth', 'root:root'])->group(function(){
    Route::get('/home', 'HomeController@index')->middleware('verified');
    Route::get('/logout', 'Auth\LoginController@logout')->withoutMiddleware(['root:root']);
    Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
    Route::resource('users', 'UserController');
    Route::resource('states', 'StateController');
    Route::post('/updateEnabled', 'AjaxController@updateEnabled');
    Route::resource('teams', 'TeamController');
    Route::resource('matches', 'MatchController');
    Route::resource('products', 'ProductController');
    Route::resource('payments', 'PaymentController');
    Route::resource('predictions', 'PredictionController');
    Route::resource('accessories', 'AccessoryController');
    Route::resource('results', 'ResultController');
    Route::resource('movements', 'MovementController');
    Route::resource('rounds', 'RoundController');
    Route::resource('leagues', 'LeagueController');
    Route::resource('tournaments', 'TournamentController');
    Route::resource('methods', 'MethodController');
    Route::resource('categories', 'CategoryController');
});
Route::get('/download/android', function () {
    $file = public_path('/storage/app-release.apk');
    // dd($file);
    return redirect("https://scorefan.com.mx/storage/ScoreFan.apk");
});