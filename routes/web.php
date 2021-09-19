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
    return redirect()->route('login');
});

Auth::routes(['verify'=>true]);

Route::group(['middleware' => ['auth'], 'namespace' => '\App\Http\Controllers'], function () {
    Route::get('part-details', 'PartDetailController@partDetails')->name('part-details.index');
    Route::get('part-details/{part}', 'PartDetailController@partDetailsEdit')->name('part-details.edit');
    Route::post('part-details', 'PartDetailController@partDetailsUpdate')->name('part-details.update');
});
