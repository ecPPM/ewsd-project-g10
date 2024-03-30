@props([
    "data",
    "selectedStudent",
])

@php
    $hasUnreadMessages = $data["student"]->hasUnreadMessagesByTutor();
@endphp

<div wire:key="{{$data["student"]->id}}" wire:click="openChat('{{ $data['student']->id }}')"
     class="px-6 py-[18px] border-b last:border-none bg-base-100 hover:bg-base-300 transition-colors duration-100 cursor-pointer {{$selectedStudent && $data["student"]->id === $selectedStudent->id ? "bg-base-200": ""}}">
    <div class="flex items-center justify-between">
        <span class="text-base font-semibold">{{ $data['student']->name }}</span>
        <div class="flex items-center gap-2">
            <span class="text-xs text-gray-500">
                {{ $data['chat'] ? $data['chat']->created_at->diffForHumans() : '' }}
            </span>
            @if ($hasUnreadMessages)
                <div class="w-2 h-2 rounded-full bg-primary"></div>
            @endif
        </div>
    </div>

    @if ($data['chat'])
        <div class="flex items-center mt-2">
            @if (Auth::user()->id == $data['chat']->sender_id)
                <span class="text-sm font-medium me-2">You:</span>
            @endif

            @if($data['chat']->content != "Please check the following file(s)" && $data['chat']->content != "")
                <span class="text-sm">
                    <p class="@if (!$data['student']->hasUnreadMessagesByTutor()) text-gray-500 @else  font-bold @endif">
                        {{ Str::limit($data['chat']->content, $limit = 30, $end = '...') }}
                    </p>
                </span>
            @else
                <span class="text-sm">
                    <p class="@if (!$data['student']->hasUnreadMessagesByTutor()) text-gray-500 @else  font-bold @endif">
                       File attached
                    </p>
                </span>
            @endif
        </div>
        {{--    @else--}}
        {{--        <div class="text-sm text-gray-500 mt-2">{{$data['student']->email}}</div>--}}
    @endif
</div>
