<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

//UserController
Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
Route::get('/user/profile/edit', [UserController::class, 'editProfile'])->name('user.edit.profile');
Route::post('/user/profile/post', [UserController::class, 'postEditProfile'])->name('post.edit.profile');
Route::get('/user/editPass', [UserController::class, 'editPass'])->name('user.editPass');
Route::post('/user/postPass', [UserController::class, 'postPass'])->name('post.editPass');
Route::get('/user/logout', [UserController::class, 'logoutPage'])->name('logoutpage');
