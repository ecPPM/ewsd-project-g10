<div class="main-container">
    <div class="">
        <h2 class="main-title">
            Statistics Reports
        </h2>
        <section class="h-[200px] w-full flex flex-row justify-center items-center space-x-6">
            <div class="flex flex-col border border-gray-300 p-2 rounded">
                <span class="font-bold">Number of Messages</span>
                <span>{{ $numberOfMessages }}</span>
            </div>
            <div class="flex flex-col border border-gray-300 p-2 rounded">
                <span class="font-bold">Inactive Students</span>
                <span>{{ $inactiveStudentCount }}</span>
            </div>
            <div class="flex flex-col border border-gray-300 p-2 rounded">
                <span class="font-bold">Students Without Tutor</span>
                <span>{{ $studentsWithoutTutor }}</span>
            </div>
        </section>
    </div>

    <div class="mt-6">
        <h2 class="main-title">
            Students List
        </h2>
        <section class="h-[500px] w-full flex justify-center items-center">

            <div class="w-full overflow-x-scroll">
                <table class="app-table">
                    <thead>
                    <tr class="text-left">
                        <th class="action"></th>
                        <th>Student</th>

                        <th>Tutor</th>
                        <th>Status</th>
                        <th>Browser</th>
                        <th>Activity</th>
                        <th class="action"></th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($students as $student)
                        <tr title="Click to see details about this user" class="cursor-pointer hover:bg-base-200"
                            wire:click="handleRowClick({{$student->id}})">
                            <td class="action pl-3">

                            </td>
                            <td>{{ $student->name }}</td>

                            <td>
                                @if($student->activeTutor())
                                    {{ $student->activeTutor()->name }}
                                @else
                                    —
                                @endif
                            </td>
                            {{-- <td>{{ $student->getActivityGrade() }}</td> --}}
                            <td>
                                <span class="badge w-20 h-8 {{ $student->getActivityGrade() === 'Inactive' ? 'bg-red-200 text-red-500' : 'bg-green-200 text-green-500' }}">
                                    {{ $student->getActivityGrade() }}
                                </span>
                            </td>

                            <td>{{ $student->getLastBrowser() ?? '-' }}</td>

                            <td>{{ $student->getLastInteractionTime() }}</td>
                            <td class="action pr-2">
                                <div class="w-2 h-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                        <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path
                                            d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"
                                            fill="#676767" />
                                    </svg>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </section>
        <div class="mt-6">
            {{ $students->links('vendor.livewire.pagination') }}
        </div>
    </div>

    <div class="mt-6">
        <h2 class="main-title">
            Views By Page Title
        </h2>
        <section class="h-[500px] w-full flex justify-center items-center">
            <div class="flex flex-col border border-gray-300 p-2 rounded">
                <table class="app-table">
                    <thead>
                        <tr>
                            <th>Page Title</th>
                            <th>Views</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pageViewsData as $pageView)
                            <tr>
                                <td>{{ $pageView->page_url }}</td>
                                <td>{{ $pageView->views }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>

</div>
