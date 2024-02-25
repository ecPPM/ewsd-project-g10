<tr wire:key="{{ $user->id }}" class="border-b border-gray-200 hover:bg-gray-100">
    <td class="py-3 px-6 text-left">
        <div class="flex flex-row my-1 p-2 justify-between">
            <div class="flex flex-col">
                <span class="text-base font-medium">{{ $user->name }}</span>
                <span class="text-sm text-gray-500">{{ $user->email }}</span>
            </div>
            <button wire:click="edit({{ $user->id }})" class="text-sm text-teal-500 font-semibold rounded hover:text-teal-800 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                </svg>
                Assign
            </button>
        </div>
    </td>

    <td class="py-3 px-6 text-left">
        <div class="">
        @if($editingStudentId === $user->id)
            <input wire:model.live.debounce.500ms="editingTutorName" type="text"
                placeholder="Search Tutor..."
                class="bg-gray-100  text-gray-900 text-sm rounded block w-full p-2.5"
                wire:focus="toggleSelect(true)"
                wire:focusout="clickOutside"
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
            {{-- {{ optional($user->activeTutor())->name ?? 'No Tutor Assigned' }} --}}
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
        </div>

        @if($editingStudentId === $user->id)
        <div class="mt-2 text-xs text-gray-700 flex justify-end">
            <button wire:click="update"
                class="px-4 py-2 bg-teal-500 text-white font-semibold rounded hover:bg-teal-600">Update</button>
            <button wire:click="cancelEdit"
                class="ms-2 px-4 py-2 bg-red-500 text-white font-semibold rounded hover:bg-red-600">Cancel</button>
        </div>
        @endif
    </td>
</tr>
