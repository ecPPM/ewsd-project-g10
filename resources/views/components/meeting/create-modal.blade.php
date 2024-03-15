@props([
    'modalOpen' => false,
    'activeStudents' => [],
    'selectedStudentId',
    'selectedMode',
])


<dialog id="newMeetingModal" {{ $attributes->class(['modal', 'modal-open' => $modalOpen]) }}>
    <div class="modal-box flex flex-col w-11/12 max-w-3xl px-5 md:px-10 pt-0 pb-4 md:pb-8">
        <div class="flex flex-col gap-8 relative">
            <div class="flex flex-col gap-4 pt-4 md:pt-8 bg-base-100 sticky top-0 left-0">
                <h4 class="text-lg md:text-2xl font-semibold">Create Meeting Schedule</h4>
                <div class="h-[3px] rounded-full w-24 bg-primary"></div>
                <button wire:click="clear" class="btn btn-sm sm:hidden z-10 btn-circle btn-ghost absolute top-2 right-0">✕</button>
            </div>

            <form class="grid grid-cols-2 gap-6">
                <x-meeting.form-group id="title" label="Meeting Name">
                    <input wire:model.live="title" name="title" type="text" aria-label="meeting-title"
                           class="input w-full {{  $errors->get('title')? 'input-error' : 'input-primary' }}"
                           placeholder="Enter Meeting Name" />
                        <x-input-error :messages="$errors->get('title')" />
                </x-meeting.form-group>

                <x-meeting.form-group id="mode" label="Meeting Platform">
                    <select aria-label="select-box-for-meeting-type"
                            name="mode"
                            id="mode"
                            wire:model.live="selectedMode"
                            class="select {{ $errors->get('selectedMode')? 'select-error' : 'select-primary' }} w-full text-base"
                    >
                        <option value="default" disabled>Please Select Meeting Type</option>
                        <option value="Online" selected>Online</option>
                        <option value="In-Person">Offline</option>
                    </select>
                    <x-input-error :messages="$errors->get('selectedMode')" />
                </x-meeting.form-group>

                <x-meeting.form-group id="teacherName" label="Teacher Name">
                    <input name="teacherName"
                           type="text"
                           aria-label="teacher-name"
                           disabled
                           value="{{auth()->user()->name}}"
                           class="input input-primary w-full text-base-content"
                           placeholder="Enter Meeting Name" />
                </x-meeting.form-group>

                <x-meeting.form-group id="select-student" label="Student Name">
                    <select
                        aria-label="select-box-for-student"
                        name="select-student"
                        id="select-student"
                        wire:model.live="selectedStudentId"
                        class="select w-full text-base {{  $errors->get('selectedStudentId')? 'select-error' : 'select-primary' }}"
                    >
                        <option value="default" disabled>Select Student Name</option>
                        @foreach($activeStudents as $student)
                            <option value="{{$student->id}}">{{ $student->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('selectedStudentId')" />
                </x-meeting.form-group>

                <x-meeting.form-group id='meeting-date' label="Meeting Date">
                    <input aria-label="meeting-date"
                           type="date"
                           wire:model.live="meetingDate"
                           class="input input-primary" />
                </x-meeting.form-group>

                <x-meeting.form-group id='meeting-time' label="Meeting Time">
                    <input aria-label="meeting-time"
                           type="time"
                           wire:model.live="meetingTime"
                           class="input input-primary" />
                </x-meeting.form-group>

                @if($selectedMode === 'Online')
                    <x-meeting.form-group id="invitation-link" label="Meeting Invitation Link" class="col-span-2 md:col-span-2">
                        <input aria-label="meeting-invitation-link"
                               name="invitation-link"
                               id="invitation-link"
                               class="input {{$errors->get('invitationLink')? 'input-error' : 'input-primary'}} w-full"
                               placeholder="Enter Meeting Link"
                               wire:model="invitationLink" />
                        <x-input-error :messages="$errors->get('invitationLink')" />
                    </x-meeting.form-group>
                @else
                    <x-meeting.form-group id="location" label="Meeting Location" class="col-span-2 md:col-span-2">
                        <input aria-label="meeting-location"
                               name="location"
                               id="location"
                               class="input {{$errors->get('location')? 'input-error' : 'input-primary'}} w-full"
                               placeholder="Enter Meeting Location"
                               wire:model="location" />
                        <x-input-error :messages="$errors->get('location')" />
                    </x-meeting.form-group>
                @endif

                <x-meeting.form-group id="meeting-create-description" label="Description" class="col-span-2 md:col-span-2">
                    <textarea
                        aria-label="meeting-create-description"
                        name="meeting-create-description"
                        id="meeting-create-description"
                        class="textarea textarea-primary w-full text-base"
                        wire:model="description"
                        rows="3"
                        placeholder="Enter Description Here ....."
                    ></textarea>
                </x-meeting.form-group>
            </form>

            <div class="flex gap-3 items-center justify-end w-full">
                <button wire:click="clear" class="btn btn-outline">Cancel</button>
                <button wire:click="createNewMeeting" class="btn btn-primary">Create Schedule</button>
            </div>
        </div>
    </div>
</dialog>
