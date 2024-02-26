<x-app-layout>
    @if (session('success'))
        <span class="w-full p-3 text-white bg-green-200 rounded">{{ session('success') }}</span>
    @endif
    @livewire('allocation.allocation-page')
</x-app-layout>


