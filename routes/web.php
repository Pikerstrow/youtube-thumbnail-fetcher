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

use App\Helpers\Localizer;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => Localizer::getLocalizationPrefix(), 'middleware' => ['web']], static function () {
    Route::get('/zip-archives/archive/{archive}', 'ZipArchivesController@index')
        ->where('archive', '[A-Za-z0-9_\.]+')->name('archive');

    Route::get('/', function(){
        return view('index');
    });
});

Route::get('/', function(){
    return view('index');
})->middleware('set_localization');;
