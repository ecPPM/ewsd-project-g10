<div class="main-container">
    <div class="w-full flex justify-between ">
        <h2 class="main-title">Students</h2>
        <button @if(count($selectedIds)===0) disabled @endif wire:click="toggleModal"
                class="btn btn-sm sm:btn-md btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
            </svg>
            <span class="hidden lg:inline">Assign</span>
        </button>

        <dialog id="bulkAllocationModal" class="modal @if($showModal) modal-open @endif">
            <div class="modal-box w-full flex flex-col">
                <button wire:click="toggleModal" class="btn btn-sm btn-circle btn-ghost absolute top-2 right-2">✕
                </button>
                <div class="flex flex-col gap-6">
                    <label for="select-tutor" class="font-bold text-lg">Bulk Allocation!</label>
                    <select wire:model.live="assignedTutorId" id="select-tutor"
                            class="w-full select select-primary">
                        <option value="default" disabled selected>Select Tutor Name</option>
                        @foreach($tutors as $tutor)
                            <option value="{{$tutor->id}}">{{ $tutor->name }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-primary self-end" wire:click.prevent="bulkAllocate">Assign</button>
                </div>
            </div>
        </dialog>
    </div>

    <section class="w-full flex flex-col gap-2">
        <div class="w-full flex justify-between items-center">
            <div>
                <label class="input input-bordered flex items-center gap-2">
                    <input wire:model.live.debounce="search" type="text" class="grow border-none input-ghost"
                           placeholder="Search" />
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                         class="w-4 h-4 opacity-70">
                        <path fill-rule="evenodd"
                              d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                              clip-rule="evenodd" />
                    </svg>
                </label>
            </div>

            @if(count($selectedIds)>0)
                <div class="flex items-center bg-base-200 py-2 px-3 rounded-full gap-2 shadow-sm">
                    <p class="text-base text-base-content">
                        <span class="pl-2 font-semibold">
                            {{ count($selectedIds) }}
                        </span>
                        &nbsp;selected
                    </p>
                    <button wire:click="clearSelection"
                            class="btn btn-sm btn-ghost btn-circle text-base-content">X
                    </button>
                </div>
            @endif
        </div>
        <table class="app-table">
            <thead>
            <tr class="text-left">
                <th class="action"></th>
                <th>Name</th>
                <th>Email</th>
                <th>Tutor Name</th>
                <th>Registered Date</th>
            </tr>
            </thead>

            <tbody>
            @foreach($students as $student)
                <tr class="cursor-pointer hover:bg-base-200" wire:click="handleRowClick({{$student->id}})">
                    <td class="action pl-3">
                        <input wire:key="{{count($selectedIds)}}" type="checkbox"
                               wire:click.stop="toggleSelect({{ $student->id }})"
                               class="checkbox checkbox-xs rounded-md checkbox-primary"
                               @if(in_array($student->id, $selectedIds)) checked @endif
                        />
                    </td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>
                        @if($student->activeTutor())
                            {{ $student->activeTutor()->name }}
                        @else
                            —
                        @endif
                    </td>
                    <td>{{ $student->created_at->format('d M Y') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="mt-6">
            {{ $students->links('vendor.livewire.pagination') }}
        </div>
    </section>
</div>
