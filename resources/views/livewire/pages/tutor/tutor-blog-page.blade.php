<div>
    <select
        aria-label="select-box-for-student"
        name="select-student"
        id="select-student"
        wire:model.live="selectedStudentId"
        class="select w-full text-base {{  $errors->get('selectedStudentId')? 'select-error' : 'select-primary' }}"
    >
        <option value="default" disabled>Select Student Name</option>
        @foreach($activeStudents as $student)
            <option value="{{$student->id}}">{{ $student->name }}</option>
        @endforeach
    </select>

    {{-- Show posts and replies --}}
    <div class="m-6 flex flex-col border border-gray-500">
        @foreach ($posts as $post)
        <div class="mt-3 flex flex-row">
            <span class="">
                {{ $post->sender->name }}
            </span>
            <span class="ms-6">
                {{ $post->created_at->diffForHumans() }}
            </span>
        </div>

        <span class="mt-1">
            {{ $post->content }}
        </span>

        @endforeach
    </div>

    @if (!$newPostMode)
    <div class="fixed bottom-6 left-6">
        <button wire:click="toggleNewPost" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
            + New Post
        </button>
    </div>
    @else
        @include('components.blog.input-card')
    @endif


</div>
