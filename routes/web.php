<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaticPageController;
use App\Http\Controllers\BookController;
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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', [StaticPageController::class, 'home'])->name('home');
Route::get('/about', [StaticPageController::class, 'about'])->name('about');

Route::resource('books', BookController::class);
Route::resource('genres', GenreController::class);


/*
Route::get('/{book}/delete', [BookController::class, 'delete'])
    ->name("books.delete");
Route::resource('books', BookController::class);

Route::get('/genres/{genre}/delete', [GenreController::class, 'delete'])
    ->name("genres.delete");
Route::resource('genres', GenreController::class);
*/

// Routes requiring authentication
Route::get('/admin/dashboard', [StaticPageController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth']], function () {

    Route::get('/genres/{genre}/edit', [GenreController::class, 'edit'])
        ->name("genres.edit");
    Route::get('/genres/{genre}/delete', [GenreController::class, 'delete'])
        ->name("genres.delete");
    Route::get('/genres/create', [GenreController::class, 'create'])
        ->name("genres.create");

    Route::get('/books/{book}/edit', [BookController::class, 'edit'])
        ->name("books.edit");
    Route::get('/books/{book}/delete', [BookController::class, 'delete'])
        ->name("books.delete");
    Route::get('/books/create', [BookController::class, 'create'])
        ->name("books.create");

    /* These are placeholder routes to indicate the admin pages are not implemented */
    Route::get('/authors', function () {
        if (auth()) {
            return redirect('admin/dashboard')->with('error', 'Authors not implemented');
        }
        return redirect('/')->with('error', 'Authors not implemented');
    })->name("authors.index");
    Route::get('/publishers', function () {
        if (auth()) {
            return redirect('admin/dashboard')->with('error', 'Publishers not implemented');
        }
        return redirect('/')->with('error', 'Publishers not implemented');
    })->name("publishers.index");
    Route::get('/users', function () {
        if (auth()) {
            return redirect('admin/dashboard')->with('error', 'Users not implemented');
        }
        return redirect('/')->with('error', 'Users not implemented');
    })->name("users.index");
});

require __DIR__.'/auth.php';
