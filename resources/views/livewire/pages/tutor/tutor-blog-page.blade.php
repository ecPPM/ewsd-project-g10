<div class="flex h-full">
    <!-- Left part for chat list with user icons -->
    <div class="flex-none w-1/4 bg-gray-100">
        <!-- Chat list content here -->
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

        @foreach ($lastChats as $lastChat)
            <div class="card card-body">
                <div class="text-sm flex flex-col">
                    <span class="me-2">
                        {{ $lastChat['student']->name }}
                    </span>
                    @if ($lastChat['chat'])
                    <div class="text-sm flex flex-row">
                        <span class="me-2">
                            {{ Auth::user()->id == $lastChat['chat']->sender_id ? "You:" : $lastChat['chat']->sender->name.':' }}
                        </span>
                        <span class="">
                            {{ $lastChat['chat']->content }}
                        </span>
                    </div>
                    @else
                        <span class="">
                            No conversation yet
                        </span>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <!-- Right part for actual chatting content -->
    <div class="flex-grow bg-white">
        <!-- Chatting content here -->

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

            @if($post->files()->isNotEmpty())
                <ul>
                    @foreach($post->files() as $file)
                        <li>
                            <a class="mt-3" href="{{ asset('/storage/'.$file->path) }}" download>
                                <i class="far fa-file"></i> {{ $file->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
            @endforeach
        </div>

        @include('components.blog.input-bar')
    </div>
</div>






