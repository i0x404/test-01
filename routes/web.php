<?php

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

Route::get('/', function () {
    return view('auth.auth');
})->name('login');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/academy/{id}', function ($id) {
    return view('academy.details', ['id' => $id]);
})->name('academy.details');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
