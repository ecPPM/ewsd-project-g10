<div class="main-container">
    <div class="w-full flex justify-between ">
        <h2 class="main-title">Tutors</h2>
    </div>

    <section class="w-full flex flex-col gap-2">
        <div class="w-full flex justify-between items-center">
            <label class="input input-bordered w-full sm:w-auto flex items-center gap-2">
                <input wire:model.live.debounce="search" type="text" class="grow border-none input-ghost"
                       placeholder="Search" />
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                     class="w-4 h-4 opacity-70">
                    <path fill-rule="evenodd"
                          d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                          clip-rule="evenodd" />
                </svg>
            </label>
        </div>

        <div class="w-full overflow-x-scroll">
            <table class="app-table">
                <thead>
                <tr class="text-left">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Assigned Students</th>
                    {{--                <th>Registered Date</th>--}}
                    <th>Last Login</th>
                    <th class="action"></th>
                </tr>
                </thead>

                <tbody>
                @foreach($tutors as $tutor)
                    <tr wire:key="{{$tutor->id.$tutor->studentCount}}" title="Click to see details about this user"
                        class="cursor-pointer hover:bg-base-200"
                        wire:click="handleRowClick({{$tutor->id}})">
                        <td>{{ $tutor->name }}</td>
                        <td>{{ $tutor->email }}</td>
                        <td>{{$tutor->studentCount}}</td>
                        <td>{{$tutor->last_logged_in ? date('d/m/Y h:m',strtotime($tutor->last_logged_in)) : "Never"}}</td>

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
        <div class="mt-6">
            {{ $tutors->links('vendor.livewire.pagination') }}
        </div>
    </section>
</div>
