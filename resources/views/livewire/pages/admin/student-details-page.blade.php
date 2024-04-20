<div class="main-container">
    <x-breadcrumbs :links="[
        ['href' => route('students'), 'label' => 'Students'],
        ['href' => route('students-details', $student->id), 'label' => $student->name]
    ]" />

    <h2 class="main-title">{{ $student->name }}</h2>

    <section class="w-full max-w-md">
        <ul class="app-list w-full flex flex-col gap-1">
            <li>
                <label>Email :</label>
                <span>{{ $student->email }}</span>
            </li>
            <li>
                <label>Last Login :</label>
                <span>{{$student->last_logged_in ? date('d/m/Y h:m',strtotime($student->last_logged_in)) : "Never"}}</span>
            </li>
            <li>
                <label>Tutor Name :</label>
                @if($student->activeTutor())
                    <div class="flex items-center gap-3">
                        {{$student->activeTutor()->name}}
                    </div>
                @else
                <div class="flex items-center gap-3">
                    -
                </div>
                @endif
            </li>
        </ul>
    </section>

    <section class="w-full h-[300px] flex justify-center items-center">
        <div class="w-full max-w-5xl mx-auto flex flex-col sm:flex-row items-center gap-6">
            <div
                class="flex items-center justify-between w-full bg-base-100 rounded-xl shadow py-10 px-6">
                <div class="flex flex-col gap-2">
                    <span class="text-sm text-base-content/75">Number of Messages</span>
                    <span class="font-semibold">{{ $numberOfMessages }}</span>
                </div>
                <img src="{{ asset('images/message-icon.svg') }}" alt="Send"
                     class="w-8 h-8" />
            </div>
            <div class="flex items-center w-full justify-between bg-base-100 rounded-xl shadow py-10 px-6">
                <div class="flex flex-col gap-2">
                    <span class="text-sm text-base-content/75">Number of Files</span>
                    <span class="font-semibold">{{ $numberOfFiles }}</span>
                </div>
                <span>
                    <svg fill="#0069FF" xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128z"/></svg>
                </span>
            </div>
        </div>
    </section>
</div>
