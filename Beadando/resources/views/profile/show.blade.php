@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-4 col-xl-3 text-center">
            <img class="mb-3 rounded-circle" src="{{ $user->avatar }}" alt="{{ $user->name }}">
            <h4 class="mb-3">{{ $user->name }}</h4>
            <p class="px-5 text-start">{{ $user->description ?: __('No description'); }}</p>
            @can('update', $user)
                <a class="btn btn-sm btn-secondary" href="{{ route('profile.edit', $user)}}">
                    {{__('Edit profile')}}
                </a>
            @endcan
        </div>
        <div class="col-lg-8 col-xl-9">
            <h3 class="mb-3">{{ __('Products by this user:') }}</h3>
            @forelse($products as $product)
                @include('product._item')
            @empty
                <div class="alert alert-warning">
                    {{ __('No product to show') }}
                </div>
            @endforelse
            {{ $products->links() }}
        </div>
    </div>
@endsection