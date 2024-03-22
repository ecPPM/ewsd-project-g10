<x-app-layout>
    <div class="">
        @if (Auth::user()->role_id == 2)
            @livewire('pages.tutor.tutor-blog-page')
        @else
            @livewire('pages.student.student-blog-page')
        @endif

    </div>
</x-app-layout>
