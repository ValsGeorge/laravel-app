<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Register;
use App\Livewire\Login;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', Register::class)
    ->middleware('guest')
    ->name('register');


Route::get('/login', Login::class)
    ->middleware('guest')
    ->name('login');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->middleware('auth')->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');