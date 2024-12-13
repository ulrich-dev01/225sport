<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BanieresController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommuniqueesController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\ProfileController;
use App\Models\article;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [ArticleController::class, 'Accueil'])->name('home');



// Route des Pages web
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/communiqué/{slug}', [CommuniqueesController::class, 'show'])->name('communique.show');
Route::resource('/NewsLetter', LetterController::class)->except('show', 'index', 'create', 'edit', 'update', 'destroy');
Route::get('/search', [ArticleController::class, 'search'])->middleware('throttle:60,1')->name('articles.search');
Route::get('/category/{nom}', [CategoryController::class, 'show'])->name('category.show');

// Route::get()




Route::get('/dashboardAdministration225', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->prefix('/admin')->group(function()
{
    Route::resource('articles', ArticleController::class)->except('show');
    Route::resource('categories', CategoryController::class)->except('show');
    Route::resource('Banière', BanieresController::class)->except('show');
    Route::resource('communiqué', CommuniqueesController::class);

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';