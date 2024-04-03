<div class="main-container">
    <div class="flex flex-row justify-between">
        <h2 class="main-title">
            Statistics Reports
        </h2>
        <div class="flex items-center">
            <select aria-label="select-box-for-duration-days"
                    name="days"
                    id="days"
                    wire:model.live="days"
                    class="select w-full text-base"
            >
                <option value="7" selected>7 Days</option>
                <option value="28">28 Days</option>
            </select>
        </div>
    </div>

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
        <div class="flex items-center justify-between w-full bg-base-100 rounded-xl shadow py-10 px-6">
            <div class="flex flex-col gap-2">
                <span class="text-sm text-base-content/75">Students Without Tutor</span>
                <span class="font-semibold">{{ $studentsWithoutTutor }}</span>
            </div>
            <img src="{{ asset('images/graduate-icon.svg') }}" alt="Send"
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
                        <th class="action"></th>
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
                            <td class="action pr-2">
                            <span wire:click="handleRowClick({{$student->id}})"
                                  class="badge badge-primary p-4 cursor-pointer hover:bg-primary hover:text-base-100 hover:border-primary badge-outline">
                                View
                            </span>
                            </td>
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

    <section class="flex flex-col items-start gap-8 mt-10">
        <h2 class="main-title">Views By Page Title</h2>
        <div class="w-full flex items-center justify-center">
            <ul class="flex flex-col w-full  rounded-lg overflow-hidden shadow">
                <li class="flex justify-between text-base font-semibold w-full px-10 py-6 bg-base-200">
                    <span>Page Title</span>
                    <span>Views</span>
                </li>
                @foreach($pageViewsData as $pageView)
                    <li class="flex text-sm justify-between w-full  px-10 py-6 border-b bg-base-100">
                        <span class=" w-1/4">{{ $pageView->page_url }}</span>
                        <div class="flex items-center justify-end gap-2 w-3/4">
                            <progress class="progress w-full h-1 progress-primary bg-transparent scale-x-[-1]"
                                      value="{{ $pageView->views }}"
                                      max="{{$maxPageViews}}"></progress>
                            <span class="min-w-[30px] text-end">{{ $pageView->views }}</span>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
</div>
