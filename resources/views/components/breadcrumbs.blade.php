<div class="text-sm breadcrumbs">
    <ul>
        {{--        TODO : Show last item as plain text--}}
        @foreach($links as $link)
            <li><a href="{{$link["href"]}}">{{$link["label"]}}</a></li>
        @endforeach
    </ul>
</div>
