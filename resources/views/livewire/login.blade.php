<x-layouts.app>
    <div class="flex items-center justify-center min-h-screen">
        <form wire:submit.prevent="submit" class="bg-white p-6 rounded shadow w-full max-w-md">
            @if ($authError)
                <div class="mb-2 text-red-600">{{ $authError }}</div>
            @endif
            <div class="mb-4">
                <label class="block mb-1">Email</label>
                <input type="email" wire:model.defer="email" class="w-full border rounded p-2">
            </div>
            <div class="mb-4">
                <label class="block mb-1">Password</label>
                <input type="password" wire:model.defer="password" class="w-full border rounded p-2">
            </div>
            <button class="bg-blue-500 text-white px-4 py-2 rounded w-full">Entrar</button>
        </form>
    </div>
</x-layouts.app>

@push('scripts')
<script>
    Livewire.on('token-obtenido', ({ token }) => {
        localStorage.setItem('token', token);
        document.cookie = `token=${token}; path=/`;
        window.location.href = "{{ route('dashboard') }}";
    });
</script>
@endpush
