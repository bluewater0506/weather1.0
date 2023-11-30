<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $jsonFilePath = public_path('/state.json');
    $jsonData = json_decode(File::get($jsonFilePath), true);
    return view('welcome',['state'=>$jsonData]);
});
Route::get('/getData', [App\Http\Controllers\HomeController::class, 'getData'])->name('getData');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
