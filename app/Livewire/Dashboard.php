<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Dashboard extends Component
{
    public $cards = [];
    public $message = null;

    public function mount()
    {
        if (!session('token')) {
            return redirect()->route('login');
        }
        $this->cargarTarjetas();
    }

    public function cargarTarjetas()
    {
        $baseUrl = config('api.base_url', 'http://laravel_app');

        try {
            $response = Http::get("{$baseUrl}/api/tarjetas");
            $this->cards = $response->json('data') ?? [];
        } catch (\Exception $e) {
            $this->message = 'Error al conectar con el servidor.';
        }
    }

    public function eliminar($id)
    {
        $baseUrl = config('api.base_url', 'http://laravel_app');
        $token = session('token');

        try {
            $response = Http::withToken($token)->delete("{$baseUrl}/api/pokemons/{$id}");

            if ($response->successful()) {
                $this->message = 'Tarjeta eliminada correctamente.';
                $this->cargarTarjetas();
            } else {
                $this->message = 'No se pudo eliminar la tarjeta.';
            }
        } catch (\Exception $e) {
            $this->message = 'Error al conectar con el servidor.';
        }
    }

    public function render()
    {
        return view('livewire.dashboard')
            ->layout('components.layouts.app');
    }
}
