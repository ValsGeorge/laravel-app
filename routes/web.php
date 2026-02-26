<?php

use App\Livewire\Admin;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Register;
use App\Livewire\Login;
use App\Livewire\Dashboard;

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

Route::get('/dashboard', Dashboard::class)
    ->middleware('auth')
    ->name('dashboard');

Route::get('/admin', Admin::class)
    ->middleware(['auth', 'isAdmin'])
    ->name('admin');
