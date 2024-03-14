<div class="main-container">
    <div class="w-full flex justify-between ">
        <h2 class="main-title">Scheduling</h2>
    </div>

    <dialog id="addNoteModal" class="modal @if($modalAddNoteOpen) modal-open @endif">
        <div class="modal-box w-full flex flex-col">
            <button wire:click="toggleAddNoteModal" class="btn btn-sm btn-circle btn-ghost absolute top-2 right-2">✕</button>
            <div class="flex flex-col gap-6">
                <form class="p-5" wire:submit.prevent='addNote' action=''>

                    <h6 for="description" class="block text-sm font-medium text-gray-700">Meeting Notes</h6>


                    <div class="my-6">
                        <label for="editingNote" class="block text-sm font-medium text-gray-700">Enter Meeting Notes</label>
                        @foreach ($notes as $note)
                            {{-- display previous notes here --}}
                            <div class="my-3">
                                <div class="flex flex-row">
                                    <span class="me-6">{{ $note->user->name }}</span>
                                    <span>{{ $note->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="mt-3">{{ $note->content }}</p>
                            </div>

                        @endforeach
                        <textarea wire:model="editingNote" name="editingNote" class="grow border-none input-ghost" placeholder="Enter Text Here ..."></textarea>
                    </div>

                    <button class="btn btn-primary self-end">Add Note</button>
                </form>
            </div>
        </div>
    </dialog>

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

{{--    <section class="w-full flex flex-col gap-2">--}}
{{--        <h6 class="">Upcoming Meetings</h6>--}}
{{--        <div class="w-full flex flex-col gap-2 sm:flex-row sm:justify-between sm:items-center">--}}
{{--            <div class="w-full border rounded">--}}
{{--                @foreach ($pendingMeetings as $meeting)--}}
{{--                    <div class="m-3 p-3 border flex flex-col rounded ">--}}
{{--                        <span>{{ $meeting->mode }}</span>--}}
{{--                        <span>{{ $meeting->time }}</span>--}}
{{--                        <span>{{ $meeting->notes }}</span>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <h6 class="mt-3">Finsihed Meetings</h6>--}}
{{--        <div class="w-full flex flex-col gap-2 sm:flex-row sm:justify-between sm:items-center">--}}
{{--            <div class="w-full border rounded">--}}
{{--                @foreach ($finishedMeetings as $meeting)--}}
{{--                    <div class="m-3 p-3 border flex flex-col rounded ">--}}
{{--                        <span>{{ $meeting->mode }}</span>--}}
{{--                        <span>{{ $meeting->time }}</span>--}}
{{--                        <span>{{ $meeting->notes }}</span>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
</div>
