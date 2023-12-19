<x-head></x-head>
    @foreach ($category as $c)
    <p>title - {{$c->title}} </p>
    <p>slug -{{$c->slug }}</p>
    @endforeach
<x-foot/>