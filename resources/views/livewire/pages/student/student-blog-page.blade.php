<div class="main-container">
    <div class="flex custom-scrollbar h-[calc(100vh-4rem-80px-60px)]">
        <!-- Chatting content here -->

        @if(Auth::user()->activeTutor())
            <div class="relative flex flex-col flex-grow">
                <h2 class="main-title mb-6">Chat with Tutor</h2>
                <!-- Chatting content here -->
                <div class="px-6 pt-4 flex flex-1 flex-col gap-3 overflow-y-auto custom-scrollbar bg-base-100"
                     id="chat-container">
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
                                    class="w-full py-1 flex flex-col gap-1 rounded-md text-sm {{$post->sender_id === Auth::user()->id? "items-end": "items-start"}}">
                                    @if ($post->sender_id !== Auth::user()->id)
                                        <div class="chat-header text-sm text-base-content/75">
                                            {{ $post->sender->name }}
                                        </div>
                                    @endif
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

                <div class="px-6 pt-4 bg-base-100">
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
            <div class="flex items-center justify-center w-full">No tutor assigned</div>
        @endif
    </div>

    <script>
        Livewire.hook("morph.updated", ({ el, component }) => {
            scrollToBottom();
        });

        Livewire.hook("element.init", ({ component, el }) => {
            scrollToBottom();
        });

        function scrollToBottom() {
            const chatContainer = document.getElementById("chat-container");
            if (!chatContainer) return;
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
    </script>
</div>
