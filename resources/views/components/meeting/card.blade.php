@props([
    'meeting',
])

@php
    $id = $meeting->id;
    $name = $meeting->title;
    $dateTime = $meeting->time;
    $studentName = $meeting->student->name;
    $tutorName = $meeting->tutor->name;
    $isPending = $meeting->time->addMinutes(30) > now();
    $isActive = now() >= $meeting->time && now() <= $meeting->time->addMinutes(30);
    $link = $meeting->invitation_link;
    $description = $meeting->description;
    $student_response = $meeting->student_response;
    $notes = $meeting->notes;
    $mode = $meeting->mode;
    $location = $meeting->location;
@endphp

<script>
    function copyToClipboard(id, inputId) {
        try {
            const element = document.getElementById(id);
            window.navigator.clipboard.writeText(element.textContent);
            const tooltip = document.getElementById(`tooltip-${id}`)
            tooltip.classList.add('tooltip', 'tooltip-open')
            setTimeout(() => {
                tooltip.classList.remove("tooltip", "tooltip-open");
            }, 1000)
        } catch (err) {
            console.log(err);
        }
    }
</script>

<div wire:key="{{$id}}" {{ $attributes->merge(["class" => "col-span-1 shadow-normal bg-base-100 rounded-[12px]"]) }}>
    <div class="w-full flex flex-col gap-2 p-5">
        <div class="flex items-center justify-between w-full">
            <h3 class="text-base text-neutral font-medium">{{ $name }}</h3>
            @if($isPending && !$isActive && auth()->user()->role->id === 2)
                <button class="btn btn-sm btn-ghost" wire:click="handleEditClick('pending',{{ $id }})">
                    <div class="h-auto w-[5px]">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 512" fill="#676767">
                            <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z" />
                        </svg>
                    </div>
                </button>
            @endif
        </div>

        <div class="flex gap-3 text-sm text-base-content/80">
            <p>
                <span>{{$dateTime->format('h:i')}}</span> {{-- meeting_start_time --}}
                <span>-</span>
                <span>{{$dateTime->addMinutes(30)->format("h:i")}}</span> {{-- meeting_end_time --}}
                <span>{{$dateTime->format('a')}}</span>
            </p>
            <div class="divider divider-horizontal m-0 p-0"></div>
            <p>{{$meeting->time->format('M d, Y')}}</p>
        </div>
    </div>

    <div class="h-[1.5px] bg-gray-200 m-0 p-0"></div>

    <div class="p-5 flex flex-col gap-4 text-sm">
        <p class="flex items-center gap-4">
            @if(auth()->user()->role->id === 2)
                <span>Student</span>
                <span class="text-base-content/50 font-bold">-</span>
                <span>{{$studentName}}</span>
            @elseif(auth()->user()->role->id === 3)
                <span>Teacher</span>
                <span>-</span>
                <span>{{$tutorName}}</span>
            @endif
        </p>

        <div class="h-16 overflow-y-auto">
            <p class="text-base-content/70">{{$description ?: "No specific description for this meeting."}}</p>
        </div>

        @if($mode=== "Online")
            <div class="w-full flex items-stretch flex-wrap gap-2">
                <label class="input flex-grow min-w-sm input-bordered flex items-center gap-2 px-0 pr-1">
                    <input id="input-link-{{$id}}" type="text" class="grow border-none text-base-content/60 text-sm"
                           disabled placeholder="Meeting link" value="{{$link}}" />
                    <div id="tooltip-copy-meeting-{{$id}}" data-tip="Copied">
                        <button class="btn btn-sm btn-ghost flex items-center justify-center !p-2 !m-1 !h-9 !w-9"
                                onclick="copyToClipboard('copy-meeting-{{$id}}','input-link-{{$id}}')">
                            <span id="copy-meeting-{{$id}}" class="hidden">{{$link}}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#9CA3AF" viewBox="0 0 512 512">
                                <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M64 464H288c8.8 0 16-7.2 16-16V384h48v64c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V224c0-35.3 28.7-64 64-64h64v48H64c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16zM224 304H448c8.8 0 16-7.2 16-16V64c0-8.8-7.2-16-16-16H224c-8.8 0-16 7.2-16 16V288c0 8.8 7.2 16 16 16zm-64-16V64c0-35.3 28.7-64 64-64H448c35.3 0 64 28.7 64 64V288c0 35.3-28.7 64-64 64H224c-35.3 0-64-28.7-64-64z" />
                            </svg>
                        </button>
                    </div>
                </label>

                @if($isActive)
                    <a href="{{$link}}" target="_blank" class="btn flex-grow btn-outline btn-primary text-base">Join
                        Now</a>
                @endif

            </div>
        @else
            <div class="w-full">
                <input aria-label="meeting-location"
                       disabled
                       value="{{$location}}"
                       class="input input-primary text-sm w-full !text-base-content" />
            </div>
        @endif
    </div>

    <div class="h-[1.5px] bg-gray-200 m-0 p-0"></div>

    @if($isPending)
        <div class="p-5 text-sm">
            @if(auth()->user()->role->id === 2)
                <div class="flex justify-between items-center">
                    <span class="text-base-content/80">Student chose</span>
                    <ul class="flex gap-1.5">
                        <li class="badge badge-outline px-3 py-[15px] {{$student_response === 'Yes' ? "badge-primary !font-semibold" : "!font-normal !text-base-content/75 border-base-content/30"}}">
                            Yes
                        </li>
                        <li class="badge badge-outline px-3 py-[15px] {{$student_response === 'No' ? "badge-error !font-semibold" : "!font-normal !text-base-content/75 border-base-content/30"}}">
                            No
                        </li>
                        <li class="badge badge-outline px-3 py-[15px] {{$student_response === 'Maybe' ? "badge-neutral !text-neutral-700 !font-semibold" : "!font-normal !text-base-content/75 border-base-content/30"}}">
                            Maybe
                        </li>
                    </ul>
                </div>
            @elseif(auth()->user()->role->id === 3)
                <div class="flex justify-between items-center">
                    <span class="text-base-content/80">Attending?</span>
                    <ul class="flex gap-1">
                        <li>
                            <button wire:click="handleRespondMeeting({{ $id }},'Yes')"
                                    class="btn font-normal rounded-full btn-sm btn-outline {{$student_response === 'Yes' ? "btn-primary !font-semibold" : "!font-normal text-base-content/75 border-base-content/30"}}">
                                Yes
                            </button>
                        </li>
                        <li>
                            <button wire:click="handleRespondMeeting({{ $id }},'No')"
                                    class="btn font-normal rounded-full btn-sm btn-outline {{$student_response === 'No' ? "btn-error !font-semibold" : "!font-normal text-base-content/75 border-base-content/30"}}">
                                No
                            </button>
                        </li>
                        <li>
                            <button wire:click="handleRespondMeeting({{ $id }},'Maybe')"
                                    class="btn font-normal rounded-full btn-sm btn-outline {{$student_response === 'Maybe' ? "btn-neutral !font-semibold" : "!font-normal text-base-content/75 border-base-content/30"}}">
                                Maybe
                            </button>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
    @else
        <div class="p-3">
            <button class="btn btn-link text-primary" wire:click="handleEditClick('finished',{{ $id }})">
                <div class="w-4 h-4">
                    <svg fill="#0069FF" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                        <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path
                            d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
                    </svg>
                </div>
                View Note
            </button>
        </div>
    @endif
</div>
