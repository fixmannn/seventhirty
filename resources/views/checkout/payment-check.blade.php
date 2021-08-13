@php
    $show = file_get_contents('https://seventhirty-id.com/payment-check', true);
    echo $show;
@endphp

@foreach($catch as $data)
    <p>{{ $data }}</p>
@endforeach