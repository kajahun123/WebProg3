@extends('layouts.main')

@section('content')
    <h1 class="display-1">
        {{ $publisher->name }}
    </h1>
    <p>{{ $publisher->description }}</p>
    <div class="row">
        <div class="col-md-8 col-lg-6 mx-auto">
            @forelse($products as $product)
                @include('product._item')
            @empty
                <div class="alert alert-warning">
                    {{ __('No product to show') }}
                </div>
            @endforelse
        </div>
    </div>
    {{ $products->links() }}
@endsection