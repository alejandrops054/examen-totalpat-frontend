<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Cards;
use App\Livewire\Login;
use App\Livewire\PokemonForm;

Route::get('/', Cards::class)->name('home');
Route::get('/login', Login::class)->name('login');
Route::get('/pokemons/create', PokemonForm::class)->name('pokemons.create');
