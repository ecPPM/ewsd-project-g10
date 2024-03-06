<div class="main-container">
    <div class="w-full flex justify-between ">
        <h2 class="main-title">Meeting</h2>
        <button wire:click="toggleModal"
                class="btn btn-sm sm:btn-md btn-primary">
            <span class="">New Meeting</span>
        </button>

        <dialog id="newMeetingModal" class="modal @if($modalOpen) modal-open @endif">
            <div class="modal-box w-full flex flex-col">
                <button wire:click="clear" class="btn btn-sm btn-circle btn-ghost absolute top-2 right-2">✕
                </button>
                <div class="flex flex-col gap-6">
                    <form class="p-5" wire:submit.prevent='createNewMeeting' action=''>
                        <div class="mb-3">
                            <label for="select-student" class="block text-sm font-medium text-gray-700">Select Student</label>
                            <select name="select-student" id="select-student" wire:model.live="selectedStudentId" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="default" disabled>Select Student Name</option>
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
                            <select name="mode" id="mode" wire:model.live='selectedMode' class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="Online">Online</option>
                                <option value="In-Person">In-Person</option>
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
                            <input wire:model="invitationLink" name="invitation-link" type="text" class="grow border-none input-ghost"
                            placeholder="Invitation Link" />
                        </div>

                        <div class="">
                            <label for="notes" class="block text-sm font-medium text-gray-700">Enter Description</label>
                            <textarea wire:model="notes" name="notes" class="grow border-none input-ghost" placeholder="Description / Notes"></textarea>
                        </div>

                        <button class="btn btn-primary self-end"
                        @if($selectedStudentId === "default") disabled @endif>Create
                        </button>
                    </form>

                </div>
            </div>
        </dialog>

        <dialog id="editPendingModal" class="modal @if($modalEditPendingOpen) modal-open @endif">
            <div class="modal-box w-full flex flex-col">
                <button wire:click="clearAll" class="btn btn-sm btn-circle btn-ghost absolute top-2 right-2">✕
                </button>
                <div class="flex flex-col gap-6">
                    <form class="p-5" wire:submit.prevent='editMeeting' action=''>
                        <div class="mb-3">
                            <label for="select-student" class="block text-sm font-medium text-gray-700">Select Student</label>
                            <select name="select-student" id="select-student" wire:model="selectedStudentId" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach($activeStudents as $student)
                                    <option value="{{$student->id}}">{{ $student->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="time" class="block text-sm font-medium text-gray-700">Meeting Date and Time</label>
                            <input wire:model="time" name="time" type="text" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Meeting Date and Time" value="{{ $time }}"/>
                        </div>

                        <div class="mb-3">
                            <label for="mode" class="block text-sm font-medium text-gray-700">Select Meeting Mode</label>
                            <select name="mode" id="mode" wire:model='selectedMode' class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="Online">Online</option>
                                <option value="In-Person">In-Person</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="location" class="block text-sm font-medium text-gray-700">Enter Location</label>
                            <input wire:model="location" name="location" type="text" class="grow border-none input-ghost"
                            placeholder="Location" value="{{ $location }}"/>
                        </div>

                        <div class="mb-3">
                            <label for="platform" class="block text-sm font-medium text-gray-700">Enter Platform</label>
                            <input wire:model="platform" name="platform" type="text" class="grow border-none input-ghost"
                            placeholder="Platform" value="{{ $platform }}"/>
                        </div>

                        <div class="mb-3">
                            <label for="invitation-link" class="block text-sm font-medium text-gray-700">Enter Invitation Link</label>
                            <input wire:model="invitation_link" name="invitation-link" type="text" class="grow border-none input-ghost"
                            placeholder="Invitation Link" value="{{ $invitationLink }}"/>
                        </div>

                        <div class="">
                            <label for="notes" class="block text-sm font-medium text-gray-700">Enter Description</label>
                            <textarea wire:model="notes" name="notes" class="grow border-none input-ghost" placeholder="Description / Notes">{{ $notes }}</textarea>
                        </div>

                        <button class="btn btn-primary self-end">Update</button>
                    </form>
                </div>
            </div>
        </dialog>

        <dialog id="editFinishedModal" class="modal @if($modalEditFinshedOpen) modal-open @endif">
            <div class="modal-box w-full flex flex-col">
                <button wire:click="clearAll" class="btn btn-sm btn-circle btn-ghost absolute top-2 right-2">✕
                </button>
                <div class="flex flex-col gap-6">
                    <form class="p-5" wire:submit.prevent='editMeeting' action=''>
                        <div class="mb-3">
                            @if ($editingMeeting)
                            <label for="select-student" class="block text-sm font-medium text-gray-700">{{ $editingMeeting->student->name }}</label>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">{{ $time }}</label>
                        </div>

                        <div class="">
                            <label for="notes" class="block text-sm font-medium text-gray-700">Enter Meeting Notes</label>
                            <textarea wire:model="notes" name="notes" class="grow border-none input-ghost" placeholder="Description / Notes">{{ $notes }}</textarea>
                        </div>

                        <button class="btn btn-primary self-end">Update</button>
                    </form>
                </div>
            </div>
        </dialog>

    </div>

    <section class="w-full flex flex-col gap-2">
        <h6 class="">Pending Meetings</h6>
        <div class="w-full flex flex-col gap-2 sm:flex-row sm:justify-between sm:items-center">
            <div class="w-full border rounded">
                @foreach ($pendingMeetings as $meeting)
                <div class="m-3 p-3 flex justify-between border rounded ">
                    <div class="flex flex-col">
                        <span>{{ $meeting->student->name }}</span>
                        <span>{{ $meeting->mode }}</span>
                        <span>{{ $meeting->time }}</span>
                        <span>{{ $meeting->notes }}</span>
                    </div>
                    <div class="flex flex-row">
                        <button wire:click="handleEditClick('pending',{{ $meeting->id }})"
                                class="btn btn-sm sm:btn-md btn-primary">
                            <span class="">Edit</span>
                        </button>
                        <button wire:click="cancelMeeting({{ $meeting->id }})"
                            class="ms-5 btn btn-sm sm:btn-md btn-secondary">
                        <span class="">Cancel</span>
                    </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <h6 class="mt-3">Finished Meetings</h6>
        <div class="w-full flex flex-col gap-2 sm:flex-row sm:justify-between sm:items-center">
            <div class="w-full border rounded">
                @foreach ($finishedMeetings as $meeting)
                    <div class="m-3 p-3 flex justify-between border rounded ">
                        <div class="flex flex-col">
                            <span>{{ $meeting->student->name }}</span>
                            <span>{{ $meeting->mode }}</span>
                            <span>{{ $meeting->time }}</span>
                            <span>{{ $meeting->notes }}</span>
                        </div>
                        <div class="">
                            <button wire:click="handleEditClick('finished',{{ $meeting->id }})"
                                    class="btn btn-sm sm:btn-md btn-primary">
                                <span class="">Add Notes</span>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>