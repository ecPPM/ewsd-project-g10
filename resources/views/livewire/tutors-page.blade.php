<div class="main-container">
    <div class="w-full flex justify-between ">
        <h2 class="main-title">Tutors</h2>
    </div>

    <section class="w-full flex flex-col gap-2">
        <div class="w-full flex justify-between items-center">
            <div>
                <label class="input input-bordered flex items-center gap-2">
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
        </div>
        <table class="app-table">
            <thead>
            <tr class="text-left">
                <th>Name</th>
                <th>Email</th>
                <th>Assigned Students</th>
                {{--                <th>Registered Date</th>--}}
                <th>Last Login</th>
            </tr>
            </thead>

            <tbody>
            @foreach($tutors as $tutor)
                <tr class="cursor-pointer hover:bg-base-200" wire:click="handleRowClick({{$tutor->id}})">
                    <td>{{ $tutor->name }}</td>
                    <td>{{ $tutor->email }}</td>
                    <td>{{$tutor->studentCount}}</td>
                    {{--                    <td>{{ $tutor->created_at->format('d M Y') }}</td>--}}
                    <td>{{ $tutor->last_login_at ? $tutor->last_login_at->format('d/M/Y h:m') : 'Never' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="mt-6">
            {{ $tutors->links('vendor.livewire.pagination') }}
        </div>
    </section>
</div>
