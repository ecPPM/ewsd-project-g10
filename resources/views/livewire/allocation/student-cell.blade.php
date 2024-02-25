<div class="flex flex-col my-4">
    <div class="text-blue-500 font-bold">Search and select students to add below</div>
    <input wire:model.live.debounce.500ms="editingStudentName" type="text"
        placeholder="Search Student..."
        class="bg-gray-100  text-gray-900 text-sm rounded block w-full p-2.5"
        wire:focus="toggleStudentSelect(true)"
        wire:focusout="clickOutsideStudentTextbox"
    >

    @if(sizeof($queryResults) > 0 && $isSelectingStudent)
        <div class="relative">
            <div class="absolute left-0 w-max bg-white shadow-md rounded-md border border-gray-200 mt-1">
                @foreach ($queryResults as $student)
                <div wire:key="{{ $student->id }}" wire:click="selectStudent({{ $student->id }})" class="cursor-pointer px-3 py-1 border-b border-gray-200 hover:bg-gray-100 focus:bg-gray-100">
                        <div class="flex flex-col ml-3">
                            <span class="text-base font-medium">{{ $student->name }}</span>
                            <span class="text-sm text-gray-500">{{ $student->email }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if (sizeof($selectedStudents) > 0)
        <div class="my-2">
            @foreach ($selectedStudents as $selectedStudent)
            <div class="flex flex-row bg-teal-500 my-1 p-2 justify-between">
                <div class="flex flex-col">
                    <span class="text-base text-white font-medium">{{ $selectedStudent->name }}</span>
                    <span class="text-sm text-white">{{ $selectedStudent->email }}</span>
                </div>
                <button wire:click="deselectStudent({{ $selectedStudent->id }})" class="text-sm text-red-500 font-semibold rounded hover:text-teal-800 flex items-center justify-end w-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                      </svg>
                </button>
            </div>
            @endforeach
        </div>
    @endif

    <div class="text-xs mt-2 text-gray-700 flex justify-end items-center">
        @if (sizeof($selectedStudents) > 0)
        {{-- <p class="text-sm text-green-500">Click Update to assign these students to this tutor.</p> --}}
        <button wire:click="bulkUpdate"
            class="ms-2 px-4 py-2 bg-teal-500 text-white font-semibold rounded hover:bg-teal-600">Update</button>
        @endif
        <button wire:click="cancelStudentEdit"
            class="ms-2 px-4 py-2 bg-red-500 text-white font-semibold rounded hover:bg-red-600">Cancel</button>
    </div>
</div>

