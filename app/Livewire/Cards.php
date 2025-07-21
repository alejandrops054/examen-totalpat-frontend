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
        $baseUrl = config('api.base_url');
        $response = Http::get("{$baseUrl}/api/tarjetas", ['page' => $page]);
        $this->cards = $response->json('data') ?? [];
        $this->links = $response->json('links') ?? [];
        $this->page = $response->json('current_page') ?? $page;
    }

    public function gotoPage($url)
    {
        if (!$url) {
            return;
        }
        parse_str(parse_url($url, PHP_URL_QUERY), $query);
        $page = $query['page'] ?? 1;
        $this->loadPage($page);
    }

    public function render()
    {
        return view('livewire.cards');
    }
}
