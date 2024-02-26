<div class="">
    @if($editingStudentId === $user->id)
        <input wire:model.live.debounce.500ms="editingTutorName" type="text"
            placeholder="Search Tutor..."
            class="bg-gray-100  text-gray-900 text-sm rounded block w-full p-2.5"
            wire:focus="focusTextbox"
            wire:focusout="clickOutside"
            name="tutorName"
            >

            @if(sizeof($queryResults) > 0 && $isSelectingTutor)
            <div class="relative">
                <div class="absolute left-0 w-max bg-white shadow-md rounded-md border border-gray-200 mt-1">
                    @foreach ($queryResults as $tutor)
                    <div wire:key="{{ $tutor->id }}" wire:click="selectTutor({{ $tutor->id }})" class="cursor-pointer px-3 py-1 border-b border-gray-200 hover:bg-gray-100 focus:bg-gray-100">
                            <div class="flex flex-col ml-3">
                                <span class="text-base text-pink-500 font-medium">{{ $tutor->name }}</span>
                                <span class="text-sm text-gray-500">{{ $tutor->email }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif


        @if($errorTutorName != "")
        <span class="text-red-500 text-xs mt-2 block">{{ $errorTutorName }}</span>
        @endif

    @else
        @php
            $activeTutor = $user->activeTutor();
        @endphp

        @if($activeTutor)
            <div class="flex flex-col">
                <span class="text-base text-pink-500 font-medium">{{ $activeTutor->name }}</span>
                <span class="text-sm text-gray-500">{{ $activeTutor->email }}</span>
            </div>
        @else
            <div><p class="text-gray-500">No tutor assigned</p></div>
        @endif
    @endif

    @if($editingStudentId === $user->id)
    <div class="mt-2 text-xs text-gray-700 flex justify-end">
        <button wire:click="update"
            class="px-4 py-2 bg-teal-500 text-white font-semibold rounded hover:bg-teal-600">Update</button>
        <button wire:click="cancelEdit"
            class="ms-2 px-4 py-2 bg-red-500 text-white font-semibold rounded hover:bg-red-600">Cancel</button>
    </div>
    @endif
</div>
