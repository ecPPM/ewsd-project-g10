<div class="bg-white shadow-md rounded my-6 px-6 mx-4 overflow-x-auto">

    @include('livewire.allocation.search-box')

    <table class="w-full table-auto mx-auto">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Student</th>
                <th class="py-3 px-6 text-left">Tutor</th>
                <th></th>
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
