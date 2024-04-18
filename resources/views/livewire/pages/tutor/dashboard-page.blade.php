<div class="main-container">

    <dialog id="welcomeModal" class="modal @if($modalOpen) modal-open @endif">
        <div class="modal-box flex flex-col w-4/12 max-w-3xl px-5 md:px-10 pt-0 pb-4 md:pb-8">
            <div class="flex flex-col gap-8 relative">
                <div class="flex flex-col gap-4 pt-4 md:pt-8 bg-base-100 sticky top-0 left-0">
                    <h4 class="text-lg md:text-2xl font-semibold">Welcome to eTutor!</h4>
                    @if(session('previousLastLogin') == "empty")
                        <p class="text-sm">Please explore around the application.</p>
                        <p class="text-sm">If you need any help, feel free to contact us.</p>
                    @else
                        <span class="text-sm">Last Login: {{ session('previousLastLogin') }}</span>
                    @endif
                    <button wire:click="closeFirstLoginModal" class="btn btn-sm bg-primary text-white">Okay</button>
                </div>
            </div>
        </div>
    </dialog>

    <h2 class="main-title">
        Statistics Reports
    </h2>
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
        <div
            class="flex items-center justify-between w-full bg-base-100 rounded-xl shadow py-10 px-6">
            <div class="flex flex-col gap-2">
                <span class="text-sm text-base-content/75">Number of Files</span>
                <span class="font-semibold">{{ $numberOfFiles }}</span>
            </div>
            <span>
                <svg fill="#0069FF" xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128z"/></svg>
            </span>

        </div>
        <div class="flex items-center w-full justify-between bg-base-100 rounded-xl shadow py-10 px-6">
            <div class="flex flex-col gap-2">
                <span class="text-sm text-base-content/75">Inactive Students</span>
                <span class="font-semibold">{{ $inactiveStudentCount }}</span>
            </div>
            <img src="{{ asset('images/user-icon.svg') }}" alt="Send"
                 class="w-8 h-8" />
        </div>
    </div>

    <section class="flex flex-col items-start gap-8 mt-10">
        <h2 class="main-title">Students List</h2>
        <div class="w-full flex justify-center items-center">
            <div class="w-full overflow-x-scroll">
                <table class="app-table">
                    <thead>
                    <tr class="text-left">
                        <th>Student</th>
                        <th>Tutor</th>
                        <th>Status</th>
                        <th>Browser</th>
                        <th>Activity</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($students as $student)
                        <tr title="Click to see details about this user" class="hover:bg-base-200">
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->activeTutor() ? $student->activeTutor()->name : '-'}}</td>
                            <td>
                            <span
                                class="badge p-4 {{ $student->getActivityGrade($days) === 'Inactive' ? 'bg-red-200 text-red-500' : 'bg-green-200 text-green-500' }}">
                                {{ $student->getActivityGrade($days) }}
                            </span>
                            </td>
                            <td>{{ $student->getLastBrowser() ?? '-' }}</td>
                            <td>{{ $student->getLastInteractionTime() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="w-full">
            {{ $students->links('vendor.livewire.pagination') }}
        </div>
    </section>

</div>
