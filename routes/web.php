<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\SelectController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

// Resource route for image upload and crop
Route::post('upload/store', [UploadController::class, 'store'])->name('upload.store');
Route::get('/upload-view', [UploadController::class, 'uploadView']);
Route::post('/delete-image/{imageName}', [UploadController::class, 'deleteFromStorage'])->name('delete.image');

Route::resource('/', UploadController::class);
// web.php
Route::get('/countries', [SelectController::class, 'getCountries']);
Route::get('/states/{country_id}', [SelectController::class, 'getStates']);
