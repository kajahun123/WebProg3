
<div class="card mb-3">
    <div class="card-body">
        <div class="d-flex">
            <img width="150" height="200" src="{{ $product->cover_image }}" alt="{{ $product->title }}" style="object-fit: cover;">
            <div class="ms-3">
                <h4 class="display-4">{{ $product->title }}</h4>
                <p class="fw-bold">
                    {{ $product->publisher->name }}
                </p>
                <div class="mb-3 d-flex">
                    <div class="d-flex">
                       <a href="{{ route('profile.show', $product->author) }}">
                        <img class="rounded-circle me-2" width="25" src="{{ $product->author->avatar }}" alt="{{ $product->author->name }}">
                        
                        <a href="{{ route('profile.show', $product->author) }}">
                            {{ $product->author->name }}
                        </a> 
                    </div>
                    <div class="ms-3">{{ $product->created_at->diffForHumans() }}</div>
                    <div class="ms-3">
                         <a href="{{ route('type.show', $product->type) }}">
                            {{ $product->type->name }}
                        </a> 
                    </div>
                </div>
                <p class="fw-bold">
                    {{ $product->description }}
                </p>
                <div class="text-start">
                    {{ $product->price }} Ft
                </div>
                <div class="text-end">
                    <a class="btn btn-sm btn-primary" href="{{ route('product.details', $product)}}">
                        {{__('Details')}}
                    </a>
                @auth    
                    @can('shop', $product)
                    <a class="btn btn-sm btn-primary" href="{{ route('product.buy', $product)}}">
                        {{__('Purchase')}}
                    </a>
                    @endcan
                @endauth
                </div>
            </div>
        </div>
    </div>
</div>
