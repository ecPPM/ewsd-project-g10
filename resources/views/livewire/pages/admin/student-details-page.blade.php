<div class="main-container">
    <x-breadcrumbs :links="[
        ['href' => route('students'), 'label' => 'Students'],
        ['href' => route('students-details', $student->id), 'label' => $student->name]
    ]" />

    <h2 class="main-title">{{ $student->name }}</h2>

    <section class="w-full max-w-md">
        <ul class="app-list w-full flex flex-col gap-1">
            <li>
                <label>Email :</label>
                <span>{{ $student->email }}</span>
            </li>
            <li>
                <label>Last Login :</label>
                <span>{{ $student->last_logged_in ? $student->last_logged_in->format('d/m/Y h:m') : "Never" }}</span>
            </li>
            <li>
                <label>Tutor Name :</label>
                @if($student->activeTutor())
                    <div class="flex items-center gap-3">
                        {{$student->activeTutor()->name}}
                        <button title="Reallocate this student to another tutor"
                                class="btn btn-sm btn-ghost btn-circle hover:text-base-content">
                            <div class="w-4 h-4 ">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z" />
                                </svg>
                            </div>
                        </button>
                    </div>
                @else
                    <button class="btn btn-sm text-primary">Assign Tutor</button>
                @endif
            </li>
        </ul>
    </section>

    <section class="w-full h-[300px] flex justify-center items-center">
        <h2 class="text-primary font-bold text-lg">Dashboard for each student will be displayed here.</h2>
    </section>
</div>
