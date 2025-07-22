<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Cards extends Component
{
    public $cards = [];
    public $links = [];
    public $page = 1;

    public function mount()
    {
        $this->loadPage($this->page);
    }

    public function loadPage($page)
    {
        $this->page = $page;

        $url = "http://laravel_app/api/tarjetas?page={$page}";

        $response = Http::get($url);

        if ($response->successful()) {
            $data = $response->json();

            $this->cards = $data['data'] ?? [];
            $this->links = $data['links'] ?? [];
        } else {
            $this->cards = [];
            $this->links = [];
            session()->flash('error', 'Error al cargar las tarjetas.');
        }
    }

    public function gotoPage($url)
    {
        if (!$url) return;

        parse_str(parse_url($url, PHP_URL_QUERY), $query);
        $page = $query['page'] ?? 1;
        $this->loadPage($page);
    }

    public function render()
    {
        return view('livewire.cards');
    }
}
