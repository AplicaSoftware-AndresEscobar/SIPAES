<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserWorkExperienceController;

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

Route::get('perfil/historial-laboral', [UserWorkExperienceController::class, 'index'])->name('profile.work-experiences.index');

Route::post('perfil/historial-laboral', [UserWorkExperienceController::class, 'store'])->name('profile.work-experiences.store');

Route::get('perfil/historial-laboral/{userWorkExperience}', [UserWorkExperienceController::class, 'show'])->name('profile.work-experiences.show');

Route::put('perfil/historial-laboral/{userWorkExperience}', [UserWorkExperienceController::class, 'update'])->name('profile.work-experiences.update');

Route::delete('perfil/historial-laboral/{userWorkExperience}', [UserWorkExperienceController::class, 'destroy'])->name('profile.work-experiences.destroy');
