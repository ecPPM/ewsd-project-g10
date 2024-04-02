<div class="main-container">
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
                                class="badge p-4 {{ $student->getActivityGrade() === 'Inactive' ? 'bg-red-200 text-red-500' : 'bg-green-200 text-green-500' }}">
                                {{ $student->getActivityGrade() }}
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
