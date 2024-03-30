@php
    use Illuminate\Support\Str;
@endphp

<div class="main-container">
    <div class="flex gap-8 custom-scrollbar h-[calc(100vh-4rem-80px-60px)]">
        <!-- Left part for chat list with user icons -->
        <div class="flex flex-col flex-1 gap-4 w-full">
            <h2 class="text-xl sm:text-2xl font-bold text-base-content">Recent Chats</h2>
            <label class="input input-bordered flex items-center gap-1 w-full">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                     class="w-4 h-4 opacity-70">
                    <path fill-rule="evenodd"
                          d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                          clip-rule="evenodd" />
                </svg>
                <input wire:model.live.debounce.400ms="search" type="text"
                       class="grow input-ghost border-none" placeholder="Search" />
            </label>

            <section class="flex flex-col overflow-y-auto w-full">
                @if($search)
                    @if(count($lastChats) > 0)
                        @foreach($lastChats as $chat)
                            <x-blog.overview :data="$chat"
                                             :selected-student="$selectedStudent"
                            />
                        @endforeach
                    @else
                        <p class="text-center text-base-content/75 text-sm mt-16">Search not found.</p>
                    @endif
                @else
                    @if(count($activeChats) > 0)
                        @foreach ($activeChats as $chat)
                            <x-blog.overview
                                :data="$chat"
                                :selected-student="$selectedStudent"
                            />
                        @endforeach
                    @else
                        <p class="text-center text-base-content/75 text-sm mt-16">
                            No
                            recent chat
                            history
                            yet.</p>
                    @endif
                @endif
            </section>
        </div>

        <!-- Right part for actual chatting content -->
        @if ($selectedStudent)
            <div class="relative overflow-y-auto flex flex-col bg-white w-2/3 h-full">
                <!-- Chatting content here -->
                <div class="flex flex-col p-6 gap-1 border-b h-15">
                    <span class="font-bold">
                        {{ $selectedStudent->name }}
                    </span>
                    <span class="text-sm text-gray-400">
                        Reply to message
                    </span>
                </div>

                <div class="flex px-6 flex-1 flex-col gap-2 overflow-y-auto custom-scrollbar py-4" id="chat-container">
                    @foreach ($posts as $post)
                        @if($post->content != "" && $post->content != "Please check the following file(s)")
                            @if ($post->sender_id === Auth::user()->id)
                                <div class="chat chat-end flex flex-col gap-1">
                                    <div class="chat-bubble chat-bubble-primary">{{ $post->content }}</div>
                                    <div class="chat-footer text-xs text-base-content/50">
                                        {{ $post->created_at->format('Y, M d  h:i a') }}
                                    </div>
                                </div>
                            @else
                                <div class="chat chat-start flex flex-col gap-1">
                                    <div class="chat-header text-sm text-base-content/75">
                                        {{ $post->sender->name }}
                                    </div>
                                    <div class="chat-bubble bg-gray-200 text-base-content/90">{{ $post->content }}</div>
                                    <div class="chat-footer text-xs text-base-content/50">
                                        {{ $post->created_at->format('Y, M d  h:i a') }}
                                    </div>
                                </div>
                            @endif
                        @endif

                        @if($post->files()->isNotEmpty())
                            @foreach($post->files() as $file)
                                <div
                                    class="w-full flex flex-col gap-1 rounded-md text-sm {{$post->sender_id === Auth::user()->id? "items-end": "items-start"}}">
                                    <a class="bg-base-300 w-fit flex items-center px-4 py-3 rounded-lg"
                                       href="{{ asset('/storage/'.$file->path) }}" download>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                             viewBox="0 0 384 512">
                                            <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                            <path
                                                d="M320 464c8.8 0 16-7.2 16-16V160H256c-17.7 0-32-14.3-32-32V48H64c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16H320zM0 64C0 28.7 28.7 0 64 0H229.5c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64z" />
                                        </svg>
                                        <span class="ml-2">{{ $file->name }}</span>
                                    </a>
                                    <div class="chat-footer text-xs text-base-content/50">
                                        {{ $post->created_at->format('Y, M d  h:i a') }}
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endforeach
                </div>

                <div class="px-6">
                    <form wire:submit.prevent="send" class="flex gap-2">
                        <div class="relative w-full">
                            <label class="textarea ps-0 textarea-bordered flex items-center gap-4">
                                <textarea type="text"
                                          rows="1"
                                          wire:model="editingText"
                                          class="grow border-none text-sm focus:border-none focus:outline-0 focus:ring-0 appearance-none"
                                          placeholder="Type something here ..."></textarea>
                                <label for="file-upload">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 cursor-pointer"
                                         viewBox="0 0 448 512">
                                        <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path
                                            fill="#676767"
                                            d="M364.2 83.8c-24.4-24.4-64-24.4-88.4 0l-184 184c-42.1 42.1-42.1 110.3 0 152.4s110.3 42.1 152.4 0l152-152c10.9-10.9 28.7-10.9 39.6 0s10.9 28.7 0 39.6l-152 152c-64 64-167.6 64-231.6 0s-64-167.6 0-231.6l184-184c46.3-46.3 121.3-46.3 167.6 0s46.3 121.3 0 167.6l-176 176c-28.6 28.6-75 28.6-103.6 0s-28.6-75 0-103.6l144-144c10.9-10.9 28.7-10.9 39.6 0s10.9 28.7 0 39.6l-144 144c-6.7 6.7-6.7 17.7 0 24.4s17.7 6.7 24.4 0l176-176c24.4-24.4 24.4-64 0-88.4z" />
                                    </svg>
                                </label>
                                <input id="file-upload" type="file" wire:model="files" class="hidden" multiple />
                            </label>
                        </div>
                        <button type="submit"
                                class="bg-primary hover:bg-opacity-75 rounded-lg px-4">
                            <img src="{{ asset('images/send-icon.svg') }}" alt="Send"
                                 class="w-4 h-4" />
                        </button>
                    </form>
                    <div class="mt-2 flex flex-wrap">
                        @if($files)
                            @foreach($files as $file)
                                <div class="bg-gray-100 p-2 m-1 rounded-md flex items-center text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 384 512">
                                        <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path
                                            d="M320 464c8.8 0 16-7.2 16-16V160H256c-17.7 0-32-14.3-32-32V48H64c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16H320zM0 64C0 28.7 28.7 0 64 0H229.5c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64z" />
                                    </svg>
                                    <span class="ml-2">{{ $file->getClientOriginalName() }}</span>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="relative flex flex-col bg-transparent w-2/3 h-full"></div>
        @endif
    </div>


    <script>
        Livewire.hook("morph.updated", ({ el, component }) => {
            scrollToBottom();
        });

        function scrollToBottom() {
            const chatContainer = document.getElementById("chat-container");
            if (!chatContainer) return;
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
    </script>

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





