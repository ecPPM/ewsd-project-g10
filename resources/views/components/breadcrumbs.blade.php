@props(['links'])

@php
    $links = collect($links);
    $links = $links->map(function ($link) {
        return [
            'href' => $link['href'],
            'label' => $link['label']
        ];
    });
@endphp

<div {{ $attributes->merge(["class" => "text-sm py-0 breadcrumbs"]) }}>
    <ul>
        @foreach($links as $link)
            @if ($loop->last)
                <li>{{$link["label"]}}</li>
            @else
                <li><a href="{{$link["href"]}}">{{$link["label"]}}</a></li>
            @endif
        @endforeach
    </ul>
</div>
