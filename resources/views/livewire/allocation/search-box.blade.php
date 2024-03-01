<div id="search-box" class="flex flex-col items-start pt-4 my-4 justify-center">
    <div class="flex justify-center items-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
             stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
        </svg>
        <input wire:model.live.debounce.500ms="search" type="text"
               placeholder='{{ $checkedTutor ? "Search Tutor ..." : "Search Student ..." }}'
               class="bg-base-100 ml-2 rounded px-4 py-2 hover:bg-base-100 text-sm" name="search-box" />
    </div>
</div>
