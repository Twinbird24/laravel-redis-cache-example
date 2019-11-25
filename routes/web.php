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
    // if cache isn't expired, then return it
    if (RedisManager::keys('articles')) {
        $articles = RedisManager::lrange('articles', 0, -1);
    } else {
        // otherwise cache is expired, fetch database
        $articles = Article::pluck('name');
        foreach ($articles as $article) {
            RedisManager::lpush('articles', $article);
        }
        // set cache time limit
        RedisManager::expire('articles', 30);
    }

    return view('welcome')->withArticles($articles);
});

Route::get('/articles/{name}', function ($name) {
    $article = new Article;
    $article->name = $name;
    $article->save();

    return 'Added article ' . $name;
});
