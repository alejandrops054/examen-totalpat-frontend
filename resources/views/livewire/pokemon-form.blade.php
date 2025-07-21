<x-layouts.app>
    <div class="max-w-md mx-auto p-4">
        @if ($message)
            <div class="mb-4 text-green-600">{{ $message }}</div>
        @endif
        <form wire:submit.prevent="save" class="space-y-4" enctype="multipart/form-data">
            <div>
                <label class="block mb-1">Nombre</label>
                <input type="text" wire:model="nombre" class="w-full border rounded p-2">
            </div>
            <div>
                <label class="block mb-1">Color</label>
                <input type="text" wire:model="color" class="w-full border rounded p-2">
            </div>
            <div>
                <label class="block mb-1">Imagen</label>
                <input type="file" wire:model="imagen" class="w-full">
            </div>
            <button class="bg-green-500 text-white px-4 py-2 rounded">Guardar</button>
        </form>
    </div>
</x-layouts.app>
