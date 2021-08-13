@php
    file_get_contents('https://seventhirty-id.com/payment-check', true);
@endphp

@foreach($catch as $data)
    <p>{{ $data }}</p>
@endforeach