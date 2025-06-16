<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\TambahFilmController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\KomenController;
use App\Http\Controllers\SukaController;
use App\Http\Controllers\UserController;



Route::get('/', function () {
    return view('welcome');
})->name('welcome');


// Route::get('/profile', function () {
//     return view('profile');
// });


Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/logout', [FilmController::class, 'logout'])->name('logout');


Route::post('/film/{film}/komen', [KomenController::class, 'komen'])->name('post.komen');
Route::put('/komen/{id}', [KomenController::class, 'editKomen'])->name('edit.komen');
Route::delete('/komen/{id}', [KomenController::class, 'hapusKomen'])->name('hapus.komen');

// untuk menampilkan dan proses register
Route::get('/register', [FilmController::class, 'showRegister'])->name('register');
Route::post('/register', [FilmController::class, 'register'])->name('register.store');

Route::post('/login', [FilmController::class, 'login'])->name('login.store');
Route::post('/film/{film}/suka',[SukaController::class,'suka'])->name('sukai.film');

Route::get('/views/{id}', [TambahFilmController::class, 'view'])->name('film.view');
Route::get('/films/all', [FilmController::class, 'showAll'])->name('films.all');



Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/managefilm', [TambahFilmController::class, 'SearchBarAdmin'])->name('get.tambah');
    Route::post('/managefilm', [TambahFilmController::class, 'tambahFilm'])->name('post.tambah');
    Route::delete('/managefilm/{id}', [TambahFilmController::class, 'delete'])->name('hapus.film');
    Route::get('/managefilm/{id}/{judul}', [TambahFilmController::class, 'edit'])->name('get.edit');
    Route::put('/managefilm/{id}', [TambahFilmController::class, 'edit_film'])->name('put.edit');    
    Route::get('/report', [KomenController::class, 'daftarLapor'])->name('report');
    Route::delete('/report/{id}', [KomenController::class, 'hapusKomenLapor'])->name('hapus.komen.lapor');
    Route::post('/report/{id}/tolakLaporan', [KomenController::class, 'abaikanLaporan'])->name('tolak.laporan');
});


Route::middleware([RoleMiddleware::class . ':user'])->group(function () {
    Route::get('/dashboard', [TambahFilmController::class, 'dashboardUser'])->name('dashboard');    
    Route::get('/favorites', [SukaController::class, 'filmKesukaan'])->name('film.disukai');
    Route::post('/komen/{id}/report', [KomenController::class, 'lapor'])->name('lapor.komen');
    Route::get('/favorites', [SukaController::class, 'FilterSuka'])->name('favorites');
    Route::get('/profile', [UserController::class, 'editProfile'])->name('profile');
    Route::post('/profile', [UserController::class, 'update'])->name('profile.update');
    Route::get('/filmsgenre/{id}', [TambahFilmController::class, 'showByGenre'])->name('genre.films');
    Route::post('/film/{id}/unlike', [SukaController::class, 'unlike'])->name('unlike.film');
    Route::get('/favorites', [SukaController::class, 'FilterSuka'])->name('favorites');
});