<div class="">
    @if (sizeof($user->activeStudents()) > 0)
        @foreach ($user->activeStudents() as $student)
            <div class="flex flex-col border my-1 p-2 bg-blue-100">
                <span class="text-base font-medium">{{ $student->name }}</span>
                <span class="text-sm text-gray-500">{{ $student->email }}</span>
            </div>
        @endforeach
    @else
        <p class="text-gray-500">No student assigned</p>
    @endif

    @if($editingTutorId === $user->id)
    <div class="flex flex-col my-4">
        <div class="text-blue-500 font-bold">Search and select students to add below</div>
        <input wire:model.live.debounce.500ms="editingStudentName" type="text"
            placeholder="Search Student..."
            class="bg-gray-100  text-gray-900 text-sm rounded block w-full p-2.5"
            wire:focus="toggleStudentSelect(true)"
            wire:focusout="clickOutsideStudentTextbox"
            name="studentName"
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
                <div class="flex flex-row bg-teal-400 my-1 p-2 justify-between">
                    <div class="flex flex-row ">
                        <div class="flex flex-col items-start">
                            <span class="text-base text-white font-medium">{{ $selectedStudent->name }}</span>
                            <span class="text-sm text-white">{{ $selectedStudent->email }}</span>
                        </div>

                        @php
                            $activeTutor = $selectedStudent->activeTutor();
                        @endphp

                        @if ($activeTutor)
                        @php
                            $initials = '';
                            $nameParts = explode(' ', $activeTutor->name);
                            foreach ($nameParts as $part) {
                                $initials .= strtoupper(substr($part, 0, 1));
                            }
                        @endphp
                        <div class="inline-flex items-center self-start ms-2 py-1.5 px-2 rounded text-xs bg-pink-100 font-bold text-pink-500">
                            <span class="">{{ $initials }}</span>
                        </div>
                        @endif
                    </div>

                    <button wire:click="deselectStudent({{ $selectedStudent->id }})" class="text-sm text-red-500 font-semibold rounded hover:text-red-800 flex items-center justify-end w-auto ms-2">
                        <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="#fc1d1d" d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg></button>
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
    @endif
</div>
