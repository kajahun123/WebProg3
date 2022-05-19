@extends('layouts.main')

@section('content')
<div class="d-flex">
    <img width="150" height="200" src="{{ $product->cover_image }}" alt="{{ $product->title }}" style="object-fit: cover;">
    <div class="ms-3">
        <h1 class="display-1">{{ $product->title }}</h1>
        <p class="display-5">{{ $product->publisher->name }}</p>
        <p>
            <a href="{{ route('profile.show', $product->author) }}">
                        <img class="rounded-circle me-2" width="25" src="{{ $product->author->avatar }}" alt="{{ $product->author->name }}">
            <a href="{{ route('profile.show', $product->author) }}">
                {{ $product->author->name }}</a>
                 | <a href="{{ route('type.show', $product->type) }}">
                            {{ $product->type->name }}</a>
                 | {{ $product->created_at->diffForHumans() }}</p>
            @auth    
                    @can('shop', $product)
                        <p class="">{{ $product->price }} Ft <a class="btn btn-sm btn-primary" href="{{ route('product.details', $product)}}">
                                    {{__('Buy it')}}
                                </a></p>    
                    @endcan
            @endauth 
<p class="fw-bold">{{ $product->description }}</p>

<div>
    {!! $product->content !!}
</div>
</div>
<p> 
    @can('update', $product)
        <a class="btn btn-sm btn-secondary" href="{{ route('product.edit', $product)}}">
            {{__('Edit')}}
        </a>
    @endcan

</p>
<p> 
    @can('delete', $product)
        <a class="btn btn-sm btn-secondary" href="{{ route('product.delete', $product)}}">
            {{__('Delete')}}
        </a>
    @endcan

</p>
</div>
<div class="row">
    <div class="col-md-8 col-lg-6 mx-auto">
        <h5 class="display-5">
            {{ __('Comments') }}
        </h5>
        @auth
         <form action="{{ route('product.comment', $product) }}" method="POST">
            @csrf
            <div class="mb-3">
                <textarea class="form-control" name="comment"></textarea>
            </div>
            <div class="d-grid">
                <button class="btn btn-primary">
                    {{ __('Comment') }}
                </button>
            </div>
        </form>
        @else
        <div class="d-grid">
            <a class="btn btn-primary" href="{{ route('login') }}">
                {{ __('Log in to comment') }}
            </a>
        </div>
        @endif
        <div class="mt-5">
            @foreach($product->comments as $comment)
                <div class="card mb-3" id="comment-{{$comment->id}}">
                    <div class="card-body">
                        <div class="mb-3 d-flex">
                            <div class="d-flex">
                                <a href="{{ route('profile.show', $comment->user) }}">
                                    <img class="rounded-circle me-2" width="25" src="{{ $comment->user->avatar }}" alt="{{ $comment->user->name }}">
                                </a>
                                <a href="{{ route('profile.show', $comment->user) }}">
                                    {{ $comment->user->name }}
                                </a>
                            </div>
                            <span class="ms-3">
                                {{ $comment->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <div style="white-space: pre-line;">
                            {{ $comment->message }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection