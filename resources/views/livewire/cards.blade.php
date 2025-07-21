<x-layouts.app>
    <div class="container mx-auto p-4">
        <div class="grid gap-4 md:grid-cols-3">
            @foreach($cards as $card)
                <div class="border rounded p-4 bg-white shadow">
                    <img src="{{ config('api.base_url').'/'.$card['imagen'] }}" class="w-full h-48 object-cover" alt="{{ $card['nombre'] }}">
                    <h3 class="mt-2 font-semibold">{{ $card['nombre'] }}</h3>
                    <p class="text-sm text-gray-500">{{ $card['color'] }}</p>
                </div>
            @endforeach
        </div>

        @if ($links)
            <div class="mt-4 flex justify-center space-x-2">
                @foreach($links as $link)
                    @if ($link['url'])
                        <button wire:click="gotoPage('{{ $link['url'] }}')" class="px-3 py-1 border rounded {{ $link['active'] ? 'bg-blue-500 text-white' : 'bg-white' }}">
                            {!! $link['label'] !!}
                        </button>
                    @else
                        <span class="px-3 py-1 border rounded text-gray-500">{!! $link['label'] !!}</span>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</x-layouts.app>
