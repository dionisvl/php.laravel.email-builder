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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', BuilderController::class.'@index');
Route::post('/constructPreview', BuilderController::class.'@constructPreview');
Route::get('/constructPreview/source/{id}', BuilderController::class.'@viewSource');

//Route::resource('photos', 'PhotoController');
Route::get('/blocks', BlockController::class . '@index');
Route::get('/blocks/create', BlockController::class . '@create');
Route::post('/blocks/store', BlockController::class . '@store');
Route::get('/blocks/{block}/edit', BlockController::class . '@edit');
Route::patch('/blocks/{block}', BlockController::class . '@update');
Route::delete('/blocks/{block}', BlockController::class . '@destroy');


Route::get('/types', TypeController::class . '@index');

Route::get('/templates/{template}', TemplateController::class . '@show');
Route::get('/templates', TemplateController::class . '@index');
Route::get('/templates/create', TemplateController::class . '@create');
Route::get('/templates/store', TemplateController::class . '@store');
Route::get('/templates/{template}/edit', TemplateController::class . '@edit');

