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
                <span>{{ $tutor->last_logged_in ? $tutor->last_logged_in->format('d/m/Y h:m') : "Never" }}</span>
            </li>
        </ul>
    </section>

    <section class="w-full h-[300px] flex justify-center items-center">
        <h2 class="text-primary font-bold text-lg">Dashboard for each tutor will be displayed here</h2>
    </section>

    <section class="w-full mb-16 flex flex-col gap-4">
        <h2 class="text-2xl font-semibold text-base-content">
            <span>Assigned Students</span>
            <span class="text-base-content/60">({{$tutor->studentCount}})</span>
        </h2>
        <table class="app-table">
            <thead>
            <tr class="text-left">
                <th>Name</th>
                <th>Email</th>
                <th>Registered Date</th>
                <th>Last Login</th>
            </tr>
            </thead>

            <tbody>
            @foreach($assignedStudents as $student)
                <tr class="hover:bg-base-200">
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->created_at->format('d M Y') }}</td>
                    <td>{{ $student->last_login_at ? $tutor->last_login_at->format('d/M/Y h:m') : 'Never' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{--        <div class="mt-6">--}}
        {{--            {{ $assignedStudents->links('vendor.livewire.pagination') }}--}}
        {{--        </div>--}}
    </section>
</div>
