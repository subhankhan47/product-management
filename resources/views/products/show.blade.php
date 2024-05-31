@extends('layouts.app')

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>{{ $product->name }}</h2>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Price: ${{ $product->price }}</h4>
                        <p class="card-text"><strong>Description:</strong> {{ $product->description }}</p>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Back to Products</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
