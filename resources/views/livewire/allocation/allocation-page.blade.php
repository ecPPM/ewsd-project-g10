<div class="bg-white shadow-md rounded my-6 px-6">

    @script
    <script>
        $wire.on('flash-event', () => {
            setTimeout(() => {
                @this.call('resetFlashMessage');
            }, 2000);
        });
    </script>
    @endscript

    @if($flashMessage)
        @if($flashStatus === "success")
        <div class="w-full fixed top-3 left-0 right-0 p-4 font-bold mx-auto text-white bg-green-500 rounded">
            {{ $flashMessage }}
        </div>
        @else
        <div class="w-full fixed top-3 left-0 right-0 p-4 font-bold mx-auto text-white bg-yellow-500 rounded">
            {{ $flashMessage }}
        </div>
        @endif
    @endif

    <div class="flex justify-center items-center mt-3">
        <label for="toggle" class="text-blue-700 {{ !$checkedTutor ? 'font-bold' : '' }}">Student Table</label>
        <div class="relative inline-block w-20 m-2 align-middle select-none transition duration-200 ease-in">
            <input type="checkbox" wire:click="toggleTable" name="toggle" id="toggle" class="toggle-checkbox absolute block w-8 h-8 rounded-full border-4 appearance-none cursor-pointer bg-gray-300"/>
            <label for="toggle" class="toggle-label block overflow-hidden h-8 rounded-full cursor-pointer bg-blue-400"></label>
        </div>
        <label for="toggle" class="text-pink-600 {{ $checkedTutor ? 'font-bold' : '' }}">Tutor Table</label>
    </div>


    @include('livewire.allocation.search-box')

    @if ($checkedTutor)
        @include('livewire.allocation.tutor-table')
    @else
        @include('livewire.allocation.student-table')
    @endif


    <style>
        /* CHECKBOX TOGGLE SWITCH */
        /* @apply rules for documentation, these do not work as inline style */
        .toggle-checkbox:checked {
          @apply: right-0 border-pink-400;
          right: 0;
          border-color: #f099d0;
        }
        .toggle-checkbox:checked + .toggle-label {
          @apply: bg-pink-400;
          background-color: #f099d0;
        }
    </style>
</div>
