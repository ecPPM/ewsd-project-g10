<div class="bg-white shadow-md rounded my-6 px-6 mx-4">
    <div class="flex justify-center items-center mt-3">
        <label>
            <input type="checkbox" wire:click="toggleTable" name="toggle">
            Tutor
        </label>
    </div>

    @include('livewire.allocation.search-box')

    @if ($checkedTutor)
        @include('livewire.allocation.tutor-table')
    @else
        @include('livewire.allocation.student-table')
    @endif
</div>
