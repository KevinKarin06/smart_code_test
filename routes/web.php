<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsLetterController;
use App\Models\Article;
use Illuminate\Http\Request;
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

Route::get('/', [ArticleController::class, 'index']);
Route::resource('article', ArticleController::class);
Route::post('/news-letter', NewsLetterController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . './auth.php';

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::view('', 'admin.index');
    Route::get('article', function (Request $request) {
        $articles = Article::orderBy('published_at', 'desc')->get();
        return view('admin.index_article', ['articles' => $articles]);
    })->name('admin.article');
    Route::resource('category', CategoryController::class)->except(['show']);
});
