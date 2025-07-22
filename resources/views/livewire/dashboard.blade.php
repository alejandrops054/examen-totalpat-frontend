<x-layouts.app>
    <div class="p-6 max-w-5xl mx-auto">
        @if ($message)
            <div class="mb-4 text-green-600 font-semibold">{{ $message }}</div>
        @endif

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">Listado de tarjetas</h2>
            <a href="{{ route('pokemons.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">Registrar Pokémon</a>
        </div>

        <table class="min-w-full border text-sm bg-white">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left border">Nombre</th>
                    <th class="px-4 py-2 text-left border">Color</th>
                    <th class="px-4 py-2 text-left border">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cards as $card)
                    <tr>
                        <td class="border px-4 py-2">{{ $card['nombre'] }}</td>
                        <td class="border px-4 py-2">{{ $card['color'] }}</td>
                        <td class="border px-4 py-2 space-x-2">
                            <button class="px-2 py-1 bg-gray-400 text-white rounded opacity-50 cursor-not-allowed" disabled>Editar</button>
                            <button wire:click="eliminar('{{ $card['id'] }}')" class="px-2 py-1 bg-red-500 text-white rounded">Eliminar</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-4">No hay tarjetas disponibles.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.app>
