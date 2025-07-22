<div class="max-w-md mx-auto p-4">
        @if ($message)
            <div class="mb-4 text-green-600 font-semibold">
                {{ $message }}
            </div>
        @endif

        <form wire:submit.prevent="save" class="space-y-4" enctype="multipart/form-data">
            {{-- Nombre --}}
            <div>
                <label class="block mb-1 font-medium">Nombre</label>
                <input type="text" wire:model.defer="nombre" class="w-full border rounded p-2">
                @error('nombre') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Color --}}
            <div>
                <label class="block mb-1 font-medium">Color</label>
                <input type="text" wire:model.defer="color" class="w-full border rounded p-2">
                @error('color') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Imagen --}}
            <div>
                <label class="block mb-1 font-medium">Imagen</label>
                <input type="file" wire:model="imagen" class="w-full">
                @error('imagen') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

                @if ($imagen)
                    <div class="mt-2">
                        <span class="text-gray-600 text-sm">Vista previa:</span>
                        <img src="{{ $imagen->temporaryUrl() }}" class="w-32 h-32 object-cover rounded mt-1">
                    </div>
                @endif
            </div>

            {{-- Botón --}}
            <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                Guardar
            </button>
        </form>
    </div>
