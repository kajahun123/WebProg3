@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-8 col-lg-6 mx-auto">
        @foreach($products as $product)
            @include('product._item')
        @endforeach
    </div>
</div>
{{ $products->links() }}
@endsection