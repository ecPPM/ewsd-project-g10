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
                <option value="7" selected>Last 7 Days</option>
                <option value="28">Last 28 Days</option>
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
                        <th>
                            <label class="flex items-center gap-2">
                            Status
                            <button wire:click="handleStatusSortClick('status')" type="button">
                                @if ($statusFlag)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M151.6 42.4C145.5 35.8 137 32 128 32s-17.5 3.8-23.6 10.4l-88 96c-11.9 13-11.1 33.3 2 45.2s33.3 11.1 45.2-2L96 146.3V448c0 17.7 14.3 32 32 32s32-14.3 32-32V146.3l32.4 35.4c11.9 13 32.2 13.9 45.2 2s13.9-32.2 2-45.2l-88-96zM320 480h32c17.7 0 32-14.3 32-32s-14.3-32-32-32H320c-17.7 0-32 14.3-32 32s14.3 32 32 32zm0-128h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H320c-17.7 0-32 14.3-32 32s14.3 32 32 32zm0-128H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H320c-17.7 0-32 14.3-32 32s14.3 32 32 32zm0-128H544c17.7 0 32-14.3 32-32s-14.3-32-32-32H320c-17.7 0-32 14.3-32 32s14.3 32 32 32z"/></svg>
                                @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M151.6 469.6C145.5 476.2 137 480 128 480s-17.5-3.8-23.6-10.4l-88-96c-11.9-13-11.1-33.3 2-45.2s33.3-11.1 45.2 2L96 365.7V64c0-17.7 14.3-32 32-32s32 14.3 32 32V365.7l32.4-35.4c11.9-13 32.2-13.9 45.2-2s13.9 32.2 2 45.2l-88 96zM320 32h32c17.7 0 32 14.3 32 32s-14.3 32-32 32H320c-17.7 0-32-14.3-32-32s14.3-32 32-32zm0 128h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H320c-17.7 0-32-14.3-32-32s14.3-32 32-32zm0 128H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H320c-17.7 0-32-14.3-32-32s14.3-32 32-32zm0 128H544c17.7 0 32 14.3 32 32s-14.3 32-32 32H320c-17.7 0-32-14.3-32-32s14.3-32 32-32z"/></svg>
                                @endif
                            </button>
                            </label>
                        </th>
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
                                class="badge p-4 {{ $student->getActivityGrade($days) === 'Inactive' ? 'bg-red-200 text-red-500' : 'bg-green-200 text-green-500' }}">
                                {{ $student->getActivityGrade($days) }}
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
