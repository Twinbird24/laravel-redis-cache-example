<?php

use App\Article;
use Illuminate\Support\Facades\Redis as RedisManager;

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

Route::get('/articles', function () {
    $articles = RedisManager::lrange('articles', 0, -1);
    return view('welcome')->withArticles($articles);
});

Route::get('/articles/{name}', function ($name) {
    $article = new Article;
    $article->name = $name;
    $article->save();

    return 'Added article ' . $name;
});
