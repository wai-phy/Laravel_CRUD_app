<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;



// Route::get('/', function () {
//     return view('create');
// });

Route::get('/',[PostController::class,'home'])->name('post#home');
Route::get('createPage',[PostController::class,'home'])->name('post#createPage');
Route::post('post/create',[PostController::class,'create'])->name('post#create');
Route::get('post/delete/{id}',[PostController::class,'deletePost'])->name('post#delete');

Route::get('post/updatePage/{id}',[PostController::class,'updatePage'])->name('post#updatePage');
Route::get('post/editPage/{id}',[PostController::class,'editPage'])->name('post#editPage');
Route::post('post/update/',[PostController::class,'update'])->name('post#update');