@props([
    'modalOpen' => false,
    'notes' => [],
    'editingNote'
])

<script>
    function toggleCollapse() {
        const element = document.getElementById("edit-collapse");
        console.log(element.classList.contains("collapse-open"));
        if (element.classList.contains("collapse-open")) {
            element.classList.remove("collapse-open");
        } else {
            element.classList.add("collapse-open");
        }
    }
</script>

<dialog id="editFinishedModal" {{ $attributes->class(['modal', 'modal-open' => $modalOpen]) }}>
    <div class="modal-box flex flex-col w-11/12 max-w-3xl px-5 md:px-10 pt-0 pb-4 md:pb-8">
        <div class="flex flex-col gap-2 relative">
            <div class="flex flex-col gap-4 pt-4 md:pt-8 bg-base-100 z-10 sticky top-0 left-0">
                <h4 class="text-lg md:text-2xl font-semibold">Meeting Notes</h4>
                <div class="h-[3px] rounded-full w-24 bg-primary"></div>
                <button wire:click="clearAll"
                        class="btn btn-sm sm:hidden z-10 btn-circle btn-ghost absolute top-2 right-0">✕
                </button>
            </div>

            @if(count($notes)>0)
                <div
                    id="edit-collapse"
                    class="collapse collapse-open collapse-arrow p-0 m-0 rounded-none"
                >
                    <div onclick="toggleCollapse()"
                         class="collapse-title cursor-pointer uppercase text-base-content/75 text-base font-semibold ps-0 py-0 flex justify-center items-center rounded-none w-fit">
                        Notes History
                    </div>

                    <div class="collapse-content p-0 overflow-y-auto max-h-72">
                        <div class="w-full flex flex-col gap-8">
                            @foreach ($notes as $note)
                                <div class="w-full flex flex-col gap-2">
                                    <div class="flex items-center gap-3">
                                        <span
                                            class="text-base text-base-content font-semibold">{{ auth()->user()->id === $note->user->id ? "You" : $note->user->name}}</span>
                                        <div class="w-[6px] h-[6px] rounded-full bg-base-content/50"></div>
                                        <span
                                            class="text-xs text-base-content/75">{{ $note->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-sm text-base-content/90 font-medium">{{ $note->content }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <div class="mt-6 flex flex-col w-full gap-2 items-start">
                <h4 class="text-base font-medium">Meeting Note</h4>
                <textarea wire:model.live.debounce="editingNote"
                          aria-label="meeting node textarea"
                          name="editingNote"
                          placeholder="Enter Text Here ..."
                          class="textarea text-base textarea-primary w-full"
                          rows="3"
                ></textarea>
            </div>

            <div class="flex gap-3 items-center mt-4 justify-end w-full">
                <button wire:click="clearAll" class="btn btn-outline">Cancel</button>
                <button wire:click="addNote" class="btn btn-primary" @if(!$editingNote) disabled @endif>Add Note
                </button>
            </div>
        </div>
    </div>
</dialog>
