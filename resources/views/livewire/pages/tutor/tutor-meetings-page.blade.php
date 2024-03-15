<div wire:key="{{'tutor-meetings-page'}}" class="main-container">
    <div class="w-full flex justify-between">
        <h2 class="main-title">Scheduling</h2>
        <button wire:click="toggleModal"
                class="btn btn-sm sm:btn-md btn-primary">
            <span class="text-base">Create Schedule</span>
        </button>

        <x-meeting.create-modal
            wire:key="meeting-create-modal"
            :modal-open="$modalOpen"
            :active-students="$activeStudents"
            :selected-student-id="$selectedStudentId"
            :selected-mode="$selectedMode"
        />

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
                            <label for="title" class="block text-sm font-medium text-gray-700">Meeting Name</label>
                            <input wire:model="title" name="title" type="text"
                                   class="input input-primary"
                                   placeholder="Enter Meeting Name"
                                   value="{{ $title }}"
                                   />
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
                            <input wire:model="invitationLink" name="invitation-link" type="text" class="grow border-none input-ghost"
                            placeholder="Invitation Link" value="{{ $invitationLink }}"/>
                        </div>

                        <div class="">
                            <label for="description" class="block text-sm font-medium text-gray-700">Enter Description</label>
                            <textarea wire:model="description" name="description" class="grow border-none input-ghost" placeholder="Description / Notes">{{ $description }}</textarea>
                        </div>

                        <button class="btn btn-primary self-end">Update</button>
                    </form>
                </div>
            </div>
        </dialog>

        <x-meeting.notes-modal
            wire:key="{{$editingMeetingId}}"
            :notes="$notes"
            :editing-note="$editingNote"
            :modal-open="$modalEditFinshedOpen"
        />
    </div>


    <section class="w-full flex flex-col gap-6">
        <h4 class="font-semibold text-lg">Upcoming Schedule</h4>

        @if(count($pendingMeetings))
            <dvi class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($pendingMeetings as $meeting)
                    <x-meeting.card :meeting="$meeting" />
                @endforeach
            </dvi>
        @else
            <div class="w-full flex justify-center items-center shadow-normal rounded-[12px] bg-base-100 py-12">
                <h4 class="font-medium text-base-content/80">No pending schedule!</h4>
            </div>
        @endif
    </section>

    <div class="divider"></div>

    <section class="w-full flex flex-col gap-6">
        <h4 class="font-semibold text-lg">Previous Schedule</h4>
        @if(count($finishedMeetings))
            <dvi class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($finishedMeetings as $meeting)
                    <x-meeting.card :meeting="$meeting" />
                @endforeach
            </dvi>
        <div class="md:self-end md:w-[200px]">
            {{ $finishedMeetings->links('vendor.livewire.simple-pagination', data: ['scrollTo' => false]) }}
        </div>
        @else
            <div class="w-full flex justify-center items-center shadow-normal rounded-[12px] bg-base-100 py-12">
                <h4 class="font-medium text-base-content/80">No previous schedule yet!</h4>
            </div>
        @endif
    </section>
</div>
