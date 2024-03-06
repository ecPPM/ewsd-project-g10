<div class="main-container">
    <div class="w-full flex justify-between ">
        <h2 class="main-title">Meeting</h2>
    </div>

    <section class="w-full flex flex-col gap-2">
        <h6 class="">Upcoming Meetings</h6>
        <div class="w-full flex flex-col gap-2 sm:flex-row sm:justify-between sm:items-center">
            <div class="w-full border rounded">
                @foreach ($pendingMeetings as $meeting)
                    <div class="m-3 p-3 border flex flex-col rounded ">
                        <span>{{ $meeting->mode }}</span>
                        <span>{{ $meeting->time }}</span>
                        <span>{{ $meeting->notes }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <h6 class="mt-3">Finsihed Meetings</h6>
        <div class="w-full flex flex-col gap-2 sm:flex-row sm:justify-between sm:items-center">
            <div class="w-full border rounded">
                @foreach ($finishedMeetings as $meeting)
                    <div class="m-3 p-3 border flex flex-col rounded ">
                        <span>{{ $meeting->mode }}</span>
                        <span>{{ $meeting->time }}</span>
                        <span>{{ $meeting->notes }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
