@props([
    'modalOpen' => false,
])

<dialog id="deleteScheduleModal" {{ $attributes->class(['modal', 'modal-open' => $modalOpen]) }}>
    <div class="modal-box flex flex-col w-11/12 max-w-3xl px-5 md:px-10 pt-0 pb-4 md:pb-8">
        <div class="flex flex-col gap-8 relative">
            <div class="flex flex-col gap-4 pt-4 md:pt-8 bg-base-100 sticky top-0 left-0">
                <h4 class="text-lg md:text-2xl font-semibold">Delete Meeting Schedule</h4>
                <div class="h-[3px] rounded-full w-24 bg-primary"></div>
                <button wire:click="clearAll"
                        class="btn btn-sm sm:hidden z-10 btn-circle btn-ghost absolute top-2 right-0">✕
                </button>
            </div>

            <p>Are you sure you want to delete ? Deleting a schedule will permanently remove the meeting for student ,
                and it cannot be restored.</p>

            <div class="flex gap-3 items-center justify-end w-full">
                <button wire:click="clearAll" class="btn btn-outline">Cancel</button>
                <button wire:click="deleteMeeting" class="btn bg-red-500 text-base-100">Delete Schedule</button>
            </div>
        </div>
    </div>
</dialog>
