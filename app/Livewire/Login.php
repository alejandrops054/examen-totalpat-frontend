<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $error = null;

    public function submit()
    {
        $baseUrl = config('api.base_url');

        $response = Http::post("{$baseUrl}/api/login", [
            'email' => $this->email,
            'password' => $this->password,
        ]);

        if ($response->successful()) {
            session(['token' => $response->json('token')]);
            return redirect()->route('pokemons.create');
        }

        $this->error = 'Credenciales incorrectas';
    }

    public function render()
    {
        return view('livewire.login');
    }
}
