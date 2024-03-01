<tr wire:key="{{ $user->id }}" class="border-b border-gray-200 hover:bg-base-100">
    <td class="py-3 px-3 text-left">
        @include('livewire.allocation.tutor-row-tutor-cell')
        <dl class="sm:hidden">
            <dt class="sr-only sm:hidden">Students</dt>
            <dd class="sm:hidden">@include('livewire.allocation.tutor-row-student-cell')</dd>
        </dl>
    </td>

    <td class="hidden sm:table-cell py-3 px-3 text-left">
        @include('livewire.allocation.tutor-row-student-cell')
    </td>
</tr>
