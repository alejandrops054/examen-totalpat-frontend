<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Http;

class PokemonForm extends Component
{
    use WithFileUploads;

    public $nombre = '';
    public $color = '';
    public $imagen;
    public $message = null;

    public function save()
    {
        $baseUrl = config('api.base_url');
        $token = session('token');

        $response = Http::withToken($token)
            ->attach('imagen', file_get_contents($this->imagen->getRealPath()), $this->imagen->getClientOriginalName())
            ->post("{$baseUrl}/api/tarjetas", [
                'nombre' => $this->nombre,
                'color' => $this->color,
            ]);

        if ($response->successful()) {
            $this->message = 'Pokémon creado correctamente';
            $this->reset(['nombre', 'color', 'imagen']);
        } else {
            $this->message = 'Ocurrió un error al crear el Pokémon';
        }
    }

    public function render()
    {
        return view('livewire.pokemon-form');
    }
}
