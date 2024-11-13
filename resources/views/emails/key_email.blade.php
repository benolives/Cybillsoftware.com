@component('mail::message')
# Product Keys

@if (!empty($productKeys))
    @foreach ($productKeys as $productKey)
        **Product Name:** {{ $productKey->product->product_name }}
        **Key Code:** {{ $productKey->key_code }}
    @endforeach
@else
    **Product Name:** {{ $mailData['productName'] }}
    **Key Code:** {{ $mailData['keyCode'] }}
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent