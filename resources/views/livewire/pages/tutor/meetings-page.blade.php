<div class="main-container">
    <div class="w-full flex justify-between ">
        <h2 class="main-title">Meeting</h2>
        <button wire:click="toggleModal"
                class="btn btn-sm sm:btn-md btn-primary">

            <span class="">New Meeting</span>
        </button>

        <dialog id="newMeetingModal" class="modal @if($modalOpen) modal-open @endif">
            <div class="modal-box w-full flex flex-col">
                <button wire:click="toggleModal" class="btn btn-sm btn-circle btn-ghost absolute top-2 right-2">✕
                </button>
                <div class="flex flex-col gap-6">
                    <form class="p-5" wire:submit.prevent='createNewMeeting' action=''>
                        <div class="mb-3">
                            <label for="select-student" class="block text-sm font-medium text-gray-700">Select Student</label>
                            <select name="select-student" id="select-student" wire:model.live="selectedStudentId" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="default" disabled selected>Select Student Name</option>
                                @foreach($activeStudents as $student)
                                    <option value="{{$student->id}}">{{ $student->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="time" class="block text-sm font-medium text-gray-700">Meeting Date and Time</label>
                            <input wire:model="time" name="time" type="text" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Meeting Date and Time" />
                        </div>

                        <div class="mb-3">
                            <label for="mode" class="block text-sm font-medium text-gray-700">Select Mode</label>
                            <select name="mode" id="mode" wire.model.live='selectedMode' class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="default" disabled selected>Select Meeting Mode</option>
                                <option value="online">Online</option>
                                <option value="in-person">In-person</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="location" class="block text-sm font-medium text-gray-700">Enter Location</label>
                            <input wire:model="location" name="location" type="text" class="grow border-none input-ghost"
                            placeholder="Location" />
                        </div>

                        <div class="mb-3">
                            <label for="platform" class="block text-sm font-medium text-gray-700">Enter Platform</label>
                            <input wire:model="platform" name="platform" type="text" class="grow border-none input-ghost"
                            placeholder="Platform" />
                        </div>

                        <div class="mb-3">
                            <label for="invitation-link" class="block text-sm font-medium text-gray-700">Enter Invitation Link</label>
                            <input wire:model="invitation_link" name="invitation-link" type="text" class="grow border-none input-ghost"
                            placeholder="Invitation Link" />
                        </div>

                        <div class="">
                            <label for="notes" class="block text-sm font-medium text-gray-700">Enter Description</label>
                            <textarea wire:model="notes" name="notes" class="grow border-none input-ghost" placeholder="Description / Notes"></textarea>
                        </div>

                        <button class="btn btn-primary self-end"
                        @if($selectedStudentId === "default" && $selectedMode === "default") disabled @endif>Create
                        </button>
                    </form>

                </div>
            </div>
        </dialog>
    </div>
</div>
