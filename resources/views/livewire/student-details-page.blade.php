<div class="main-container">
    @include('components.breadcrumbs', ['links' => [
        ['href' => route('students'), 'label' => 'Students'],
        ['href' => route('students-details', $student->id), 'label' => $student->name]
    ]])
    <h2 class="main-title">Student Dashboard</h2>
    <section class="w-full max-w-md">
        <ul class="app-list w-full flex flex-col gap-4">
            <li>
                <label>Name :</label>
                <span>{{ $student->name }}</span>
            </li>
            <li>
                <label>Email :</label>
                <span>{{ $student->email }}</span>
            </li>
            <li>
                <label>Registered Date :</label>
                <span>{{ $student->created_at->format('d M Y') }}</span>
            </li>
            <li>
                <label>Tutor Name :</label>
                <span>
                    @if($student->activeTutor())
                        {{$student->activeTutor()->name}}
                    @else
                        —
                    @endif
                </span>
            </li>
        </ul>
    </section>
    <section class="w-full h-[300px] flex justify-center items-center">
        <h2 class="text-primary font-bold text-lg">Dashboard for each student will be displayed here. (For admin
            user)</h2>
    </section>
</div>
