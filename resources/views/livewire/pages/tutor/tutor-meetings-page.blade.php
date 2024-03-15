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

        <x-meeting.edit-modal
            wire:key="edit-{{$editingMeetingId}}-modal"
            :modal-open="$modalEditPendingOpen"
            :active-students="$activeStudents"
            :selected-student-id="$selectedStudentId"
            :selected-mode="$selectedMode"
        />

        <x-meeting.notes-modal
            wire:key="notes-{{$editingMeetingId}}-modal"
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
