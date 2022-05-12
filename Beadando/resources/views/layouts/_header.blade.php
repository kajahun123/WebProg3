<div class="container">
  <header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4 pt-1">
        <a class="blog-header-logo text-dark" href="{{route('home')}}">{{config('app.name')}}</a>
      </div>
      <div class="col-4 d-flex justify-content-end align-items-center">
        @auth
          <a class="btn btn-sm btn-primary" href="{{ route('product.create') }}">{{ __('Add Product') }}</a>
          <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="rounded-circle me-2" width="25" src="{{ Auth::user()->avatar }}" />
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="#">
                                    {{ __('Profile') }}
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item" type="submit">
                                        {{ __('Sign out') }}
                                    </button>
                                </form>
                            </li>
                        </ul>
                      </div>
        @else
          <a class="btn btn-sm btn-outline-secondary" href="{{ route('login')}}">{{__('Sign in')}}</a>
          <a class="btn btn-sm btn-outline-secondary ms-3" href="{{ route('register')}}">{{__('Sign up')}}</a>
        @endauth
      </div>
    </div>
  </header>

<div class=" py-1 mb-2">
<nav class="nav d-flex justify-content">
  <div class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      {{__('Genres')}}
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
      @foreach($types as $type)
        <a class="dropdown-item" href="{{route('type.show',$type)}}">
          {{ $type->name }}
        </a>
      @endforeach
    </ul>
  </div>

  <div class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      {{__('Publishers')}}
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
      @foreach($publishers as $publisher)
        <a class="dropdown-item" href="{{route('publisher.show',$publisher)}}">
          {{ $publisher->name }}
        </a>
      @endforeach
    </ul>
  </div>
  </nav>
  </div>
</div>