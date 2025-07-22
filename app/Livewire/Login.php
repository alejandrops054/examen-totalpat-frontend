<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $authError = null;

    public function submit()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:4',
        ]);

        $baseUrl = config('api.base_url', 'http://laravel_app');

        try {
            $response = Http::post("{$baseUrl}/api/login", [
                'email' => $this->email,
                'password' => $this->password,
            ]);

            if ($response->successful()) {
                $token = $response->json('token');
                $this->dispatch('token-obtenido', token: $token);
            } else {
                $this->authError = 'Credenciales incorrectas.';
            }
        } catch (\Exception $e) {
            $this->authError = 'Error al conectar con el servidor.';
        }
    }

    public function render()
    {
        return view('livewire.login');
    }
}
