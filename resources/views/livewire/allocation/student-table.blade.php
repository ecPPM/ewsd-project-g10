<div class="overflow-x-auto">
    <table class="w-full table-auto mx-auto sm:table-fixed min-h-[21rem]">
        <thead>
            <tr class="bg-gray-200 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-center font-bold bg-blue-200">
                    <div class="flex justify-center items-center">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>
                    <span class="ms-2">Student</span>

                    </div>
                </th>
                <th class="hidden sm:table-cell py-3 px-6 text-center font-bold bg-pink-200">
                    <div class="flex justify-center items-center">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M192 96a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm-8 384V352h16V480c0 17.7 14.3 32 32 32s32-14.3 32-32V192h56 64 16c17.7 0 32-14.3 32-32s-14.3-32-32-32H384V64H576V256H384V224H320v48c0 26.5 21.5 48 48 48H592c26.5 0 48-21.5 48-48V48c0-26.5-21.5-48-48-48H368c-26.5 0-48 21.5-48 48v80H243.1 177.1c-33.7 0-64.9 17.7-82.3 46.6l-58.3 97c-9.1 15.1-4.2 34.8 10.9 43.9s34.8 4.2 43.9-10.9L120 256.9V480c0 17.7 14.3 32 32 32s32-14.3 32-32z"/></svg>
                    <span class="ms-2">Tutor</span>

                    </div>
                </th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @foreach($users as $user)
                @include('livewire.allocation.student-row')
            @endforeach
        </tbody>
    </table>

    <div class="my-5 mx-5">
        {{ $users->links() }}
    </div>
</div>
