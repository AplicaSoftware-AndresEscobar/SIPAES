<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Fortify;

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

Route::redirect('/', 'iniciar-sesion');

Route::view('iniciar-sesion', 'pages.auth.login')->name('login')->middleware('guest');

Route::view('inicio', 'pages.dashboard')->name('home')->middleware('auth');

Route::view('perfil', 'pages.auth.profile')->name('profile')->middleware('auth');