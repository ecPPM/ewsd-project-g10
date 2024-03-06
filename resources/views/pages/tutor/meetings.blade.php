<x-app-layout>
    <div class="">
        @if (Auth::user()->role_id == 2)
            @livewire('pages.tutor.tutor-meetings-page')
        @else
            @livewire('pages.student.student-meetings-page')
        @endif

    </div>
</x-app-layout>
