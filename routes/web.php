<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Cards;
use App\Livewire\Login;
use App\Livewire\Dashboard;
use App\Livewire\PokemonForm;

Route::get('/', Cards::class)->name('home');
Route::get('/login', Login::class)->name('login');
Route::get('/dashboard', Dashboard::class)->name('dashboard');
Route::get('/pokemons/create', PokemonForm::class)->name('pokemons.create');
Route::get('/logout', function () {
    session()->forget('token');
    return redirect()->route('login')->with('message', 'Sesión finalizada');
})->name('logout');
