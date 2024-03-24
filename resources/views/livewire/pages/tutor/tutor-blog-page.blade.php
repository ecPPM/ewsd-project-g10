@php
    use Illuminate\Support\Str;
@endphp

<div class="main-container" style="height: 80vh;">
    <div class="flex h-full mx-6">
        <!-- Left part for chat list with user icons -->
        <div class="flex-none w-1/3 h-screen overflow-y-auto custom-scrollbar pe-6">
            <h2 class="main-title">Recent Chats</h2>
            <!-- Chat list content here -->
            <div id="search-box" class="flex flex-col items-start pt-4 my-4 justify-center">
                <div class="flex justify-center w-full items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                    <input wire:model.live.debounce.500ms="search" type="text"
                        placeholder='Search By Name'
                        class="bg-base-100 ml-2 rounded px-4 py-2 hover:bg-base-100 text-sm flex-grow" name="search-box" />
                </div>
            </div>

            @foreach ($lastChats as $lastChat)
            <div wire:click="openChat('{{ $lastChat['student']->id }}')"
                class="p-4 bg-white shadow-md rounded-lg mb-8 block hover:bg-gray-100 transition-colors duration-200">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-lg font-semibold">{{ $lastChat['student']->name }}</span>
                    <span class="text-xs text-gray-500">
                        {{ $lastChat['chat'] ? $lastChat['chat']->created_at->diffForHumans() : '' }}
                        @if ($lastChat['student']->hasUnreadMessagesByTutor())
                            <span class="badge badge-primary badge-xs"></span>
                        @endif
                    </span>
                </div>

                @if ($lastChat['chat'])
                    <div class="flex items-center">
                        @if (Auth::user()->id == $lastChat['chat']->sender_id)
                            <span class="text-sm font-medium me-2">
                                You:
                            </span>
                        @endif

                        <span class="text-sm">
                            <p class="@if (!$lastChat['student']->hasUnreadMessagesByTutor()) text-gray-500 @else  font-bold @endif">
                                {{ Str::limit($lastChat['chat']->content, $limit = 30, $end = '...') }}
                            </p>
                        </span>
                    </div>
                @else
                    <div class="text-sm text-gray-500">No conversation yet</div>
                @endif
            </div>
            @endforeach

        </div>

        <!-- Right part for actual chatting content -->
        @if ($selectedStudent)
            <div class="relative flex flex-col flex-grow bg-white ms-1 h-full">
                <!-- Chatting content here -->

                <div class="flex flex-col p-6 border-b h-15">
                    <span class="font-bold">
                        {{ $selectedStudent->name }}
                    </span>
                    <span class="text-sm text-gray-400">
                        {{ $selectedStudent->email }}
                    </span>
                </div>

                <div class="m-6 flex flex-1 flex-col overflow-y-auto custom-scrollbar" id="chat-container">
                    @foreach ($posts as $post)

                    @if ($post->sender_id === Auth::user()->id)
                        <div class="chat chat-end">
                            <time class="text-xs opacity-50">{{ $post->created_at->diffForHumans() }}</time>
                            <div class="chat-bubble chat-bubble-primary">{{ $post->content }}</div>
                            <div class="chat-footer opacity-50">
                                {{ $post->created_at->format('Y, M d  h:i a') }}
                            </div>
                        </div>
                    @else
                        <div class="chat chat-start">
                            <div class="chat-header">
                                {{ $post->sender->name }}
                            <time class="text-xs opacity-50 ms-6">{{ $post->created_at->diffForHumans() }}</time>
                            </div>
                            <div class="chat-bubble">{{ $post->content }}</div>
                            <div class="chat-footer opacity-50">
                                {{ $post->created_at->format('Y, M d  h:i a') }}
                            </div>
                        </div>
                    @endif


                    @if($post->files()->isNotEmpty())
                        <ul>
                            @foreach($post->files() as $file)
                                <li>
                                    <a class="mt-3 w-auto" href="{{ asset('/storage/'.$file->path) }}" download>
                                        <div class="bg-gray-100 p-2 m-1 flex rounded-md items-center text-sm
                                        @if ($post->sender_id === Auth::user()->id)
                                        justify-end
                                        @endif
                                        ">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M320 464c8.8 0 16-7.2 16-16V160H256c-17.7 0-32-14.3-32-32V48H64c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16H320zM0 64C0 28.7 28.7 0 64 0H229.5c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64z"/></svg>
                                            <span class="ml-2">{{ $file->name }}</span>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    @endforeach
                </div>

                <div class="h-15 px-0 flex flex-col items-center inset-x-0">
                    <form wire:submit.prevent="send" class="flex justify-between items-center w-full max-w-screen-sm">
                        <div class="relative w-full">
                            <textarea wire:model="editingText" placeholder="Type something here..." class="textarea textarea-bordered textarea-sm w-full pr-10" rows="2"></textarea>
                            <label for="file-upload" class="absolute inset-y-0 right-0 flex items-center justify-center bg-white rounded-full p-2 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M364.2 83.8c-24.4-24.4-64-24.4-88.4 0l-184 184c-42.1 42.1-42.1 110.3 0 152.4s110.3 42.1 152.4 0l152-152c10.9-10.9 28.7-10.9 39.6 0s10.9 28.7 0 39.6l-152 152c-64 64-167.6 64-231.6 0s-64-167.6 0-231.6l184-184c46.3-46.3 121.3-46.3 167.6 0s46.3 121.3 0 167.6l-176 176c-28.6 28.6-75 28.6-103.6 0s-28.6-75 0-103.6l144-144c10.9-10.9 28.7-10.9 39.6 0s10.9 28.7 0 39.6l-144 144c-6.7 6.7-6.7 17.7 0 24.4s17.7 6.7 24.4 0l176-176c24.4-24.4 24.4-64 0-88.4z"/></svg>
                            </label>
                            <input id="file-upload" type="file" wire:model="files" class="hidden" multiple/>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-none mt-1">
                            Send
                        </button>
                    </form>
                    <div class="mt-2 flex flex-wrap">
                        @if($files)
                            @foreach($files as $file)
                                <div class="bg-gray-100 p-2 m-1 rounded-md flex items-center text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M320 464c8.8 0 16-7.2 16-16V160H256c-17.7 0-32-14.3-32-32V48H64c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16H320zM0 64C0 28.7 28.7 0 64 0H229.5c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64z"/></svg>
                                    <span class="ml-2">{{ $file->getClientOriginalName() }}</span>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        @endif

    </div>

    <style>
        /* Hide the default scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 0;
        }

        /* Styling for the custom scrollbar */
        .custom-scrollbar {
            scrollbar-width: thin;
            scrollbar-color: #d4d4d4 transparent; /* Scrollbar Track Color and Scrollbar Thumb Color */
        }

        /* Styling for the custom scrollbar thumb */
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #d4d4d4; /* Scrollbar Thumb Color */
            border-radius: 6px;
        }

        /* Styling for the custom scrollbar track */
        .custom-scrollbar::-webkit-scrollbar-track {
            background-color: transparent; /* Scrollbar Track Color */
        }
    </style>
</div>




