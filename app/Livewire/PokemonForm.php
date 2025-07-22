<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class PokemonForm extends Component
{
    use WithFileUploads;

    public $nombre = '';
    public $color = '';
    public $imagen;
    public $message = null;

    public function mount()
    {
        if (!session('token')) {
            return redirect()->route('login');
        }
    }

    protected function rules()
    {
        return [
            'nombre' => 'required|string|min:2',
            'color' => 'required|string',
            'imagen' => 'required|image|max:2048',
        ];
    }

    public function save()
    {
        $this->validate();

        try {
            $baseUrl = config('api.base_url', 'http://laravel_app');
            $token = session('token');

            $response = Http::withToken($token)
                ->attach(
                    'imagen',
                    file_get_contents($this->imagen->getRealPath()),
                    $this->imagen->getClientOriginalName()
                )
                ->post("{$baseUrl}/api/tarjetas", [
                    'nombre' => $this->nombre,
                    'color' => $this->color,
                ]);

            if ($response->successful()) {
                $this->message = 'Pokémon creado correctamente';
                $this->reset(['nombre', 'color', 'imagen']);
            } else {
                $this->message = 'Ocurrió un error al crear el Pokémon. Código: ' . $response->status();
            }
        } catch (\Exception $e) {
            $this->message = 'Error inesperado: ' . $e->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.pokemon-form')
            ->layout('components.layouts.app');
    }
}
