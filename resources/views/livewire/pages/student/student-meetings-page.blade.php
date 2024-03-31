<div class="main-container">
    @if(Auth::user()->activeTutor())
        <div class="w-full flex justify-between ">
            <h2 class="main-title">Scheduling</h2>
        </div>

        <x-meeting.notes-modal
            wire:key="{{$editingMeetingId}}"
            :notes="$notes"
            :editing-note="$editingNote"
            :modal-open="$modalAddNoteOpen"
        />

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
            @if(count($finishedMeetings) >0 )
                <dvi class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($finishedMeetings as $meeting)
                        <x-meeting.card :meeting="$meeting" />
                    @endforeach
                </dvi>
            @else
                <div class="w-full flex justify-center items-center shadow-normal rounded-[12px] bg-base-100 py-12">
                    <h4 class="font-medium text-base-content/80">No previous schedule yet!</h4>
                </div>
            @endif
        </section>
    @else
        <div class="flex custom-scrollbar h-[calc(100vh-4rem-80px-60px)]">
            <div class="flex items-center justify-center w-full">No tutor assigned</div>
        </div>
    @endif
</div>
