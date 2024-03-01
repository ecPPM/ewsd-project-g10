<tr wire:key="{{ $user->id }}" class="border-b border-gray-200 hover:bg-base-100">
    <td class="py-3 px-3 text-left">
        @include('livewire.allocation.student-row-student-cell')

        <dl class="sm:hidden">
            <dt class="sr-only sm:hidden">Tutor</dt>
            <dd class="sm:hidden">@include('livewire.allocation.student-row-tutor-cell')</dd>
        </dl>
    </td>

    <td class="hidden sm:table-cell py-3 px-3 text-left">
        @include('livewire.allocation.student-row-tutor-cell')
    </td>
</tr>
