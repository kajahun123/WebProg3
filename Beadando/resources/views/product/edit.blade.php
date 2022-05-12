@extends('layouts.main')

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error( error )
        })
</script>
@endpush

@section('content')
<form action="{{ route('product.edit', $product) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="d-flex align-items-center mb-3">
        <h3 class="display-3">{{ __('Updating') }} {{ $product->title }}</h3>
        <button class="ms-auto btn btn-primary">Update</button>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-6">
            <div class="card">
                <div class="card-body">
                    <x-forms.input name="title" label="{{ __('Title') }}" value="{{ $product->title }}" />
                    <div class="mb-3">
                        <label for="description">{{ __('Description') }}</label>
                        <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description">{{ old('description', $product->description) }}</textarea>
                        @if ($errors->has('description'))
                            <p class="invalid-feedback">{{ $errors->first('description') }}</p>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="content">{{ __('Content') }}</label>
                        <textarea id="editor" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content">{{ old('content', $product->content) }}</textarea>
                        @if ($errors->has('content'))
                            <p class="invalid-feedback">{{ $errors->first('content') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="type_id">{{ __('Type') }}</label>
                        <select class="form-control{{ $errors->has('type_id') ? ' is-invalid' : '' }}" name="type_id">
                            <option value="">{{ __('Please choose') }}</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}" {{ old('type_id', $product->type_id) == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('type_id'))
                            <p class="invalid-feedback">{{ $errors->first('type_id') }}</p>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="cover">{{ __('Cover image') }}</label>
                        <input class="form-control{{ $errors->has('cover') ? ' is-invalid' : '' }}" type="file" name="cover" value="{{ old('cover') }}">
                        @if ($errors->has('cover'))
                            <p class="invalid-feedback">{{ $errors->first('cover') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection