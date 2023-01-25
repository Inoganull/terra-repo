<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Article\ArticleController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Comment\CommentController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [ArticleController::class, 'index']);

Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/detail/{id}', [ArticleController::class, 'detail']);
Route::get('/articles/add', [ArticleController::class, 'add']);
Route::post('/articles/add', [ArticleController::class, 'create']);
Route::get('/articles/delete/{id}', [ArticleController::class, 'delete']);
Route::get('/articles/detail/edit/{id}', [ArticleController::class, 'edit']);
Route::patch('/articles/detail/update/{id}', [ArticleController::class, 'update']);

Route::post('/comments/add', [CommentController::class, 'create']);
Route::get('/comments/delete/{id}', [CommentController::class, 'delete']);


Route::get('/products', [ProductController::class, 'index']);
Auth::routes();

Route::get('/home', [ArticleController::class, 'index']);
