@php
    $show = file_get_contents('php://input', true);
    echo $show;
@endphp

@foreach($catch as $data)
    <p>{{ $data }}</p>
@endforeach