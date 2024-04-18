<div class="main-container">
    <x-breadcrumbs :links="[
        ['href' => route('tutors'), 'label' => 'Tutors'],
        ['href' => route('tutor-details', $tutor->id), 'label' => $tutor->name]
    ]" />

    <h2 class="main-title">{{ $tutor->name }}</h2>

    <section class="w-full max-w-md">
        <ul class="app-list w-full flex flex-col gap-1">
            <li>
                <label>Email :</label>
                <span>{{ $tutor->email }}</span>
            </li>
            <li>
                <label>Last Login :</label>
                <span>{{$tutor->last_logged_in ? date('d/m/Y h:m',strtotime($tutor->last_logged_in)) : "Never"}}</span>
            </li>
        </ul>
    </section>

    <section class="w-full h-[300px] flex justify-center items-center">
        <div class="w-full max-w-5xl mx-auto flex flex-col sm:flex-row items-center gap-6">
            <div class="flex items-center justify-between w-full bg-base-100 rounded-xl shadow py-10 px-6">
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
    </section>

    <section class="w-full flex flex-col gap-4">
        <h2 class="text-xl md:text-2xl font-semibold text-base-content">
            <span>Assigned Students</span>
            <span class="text-base-content/50 text-xl leading-[2rem]">({{$tutor->studentCount}})</span>
        </h2>

        <div class="w-full overflow-x-scroll">
            <table class="app-table">
                <thead>
                <tr class="text-left">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Registered Date</th>
                    <th>Last Login</th>
                    <th>Status</th>
                    <th>Browser</th>
                    <th>Activity</th>
                </tr>
                </thead>

                <tbody>
                @foreach($assignedStudents as $student)
                    <tr class="hover:bg-base-200">
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->created_at->format('d/m/Y h:m') }}</td>
                        <td>{{$student->last_logged_in ? date('d/m/Y h:m',strtotime($student->last_logged_in)) : "Never"}}</td>
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
        <div class="">
            {{ $assignedStudents->links('vendor.livewire.pagination') }}
        </div>
    </section>
</div>
