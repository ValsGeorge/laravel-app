<?php

use Illuminate\Support\Facades\Route;
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