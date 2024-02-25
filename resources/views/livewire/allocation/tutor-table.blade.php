<div class="overflow-x-auto">
    <table class="w-full table-auto mx-auto sm:table-fixed min-h-[24rem]">
        <thead>
            <tr class="bg-gray-200 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-center font-bold bg-pink-200">Tutor</th>
                <th class="py-3 px-6 text-center font-bold bg-blue-200">Students</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @foreach($users as $user)
                @include('livewire.allocation.tutor-row')
            @endforeach
        </tbody>
    </table>

    <div class="my-5 mx-5">
        {{ $users->links() }}
    </div>
</div>
