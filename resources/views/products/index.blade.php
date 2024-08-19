@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<div class="container-lg">


    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-tshirt"></i>
                OldSchool Stripes
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">

                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center text-info fw-bold" href="{{ route('products.create') }}">
                            <i class="bi bi-plus-circle me-2" style="font-size: 1.2rem;"></i>
                            Create A New Product
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    
    <h2 class="text-center mb-4">Products Dashboard</h2>


    @if($products->isEmpty())
        <div class="alert alert-info">No products found.</div>
    @else
        <div class="row row-cols-1 row-cols-md-2 g-4">
            @foreach ($products as $product)
                <div class="col">
                    <div class="card h-100 p-3 rounded-3 shadow-sm">
                        <img src="{{ asset('images/' . $product->image) }}" class="card-img-top" alt="Product Image">
                        <div class="card-body">
                            <h5 class="card-title">
                                Product by
                                <a href="{{ route('profile', $product->seller_id) }}" class="fw-regular">
                                    {{ $product->seller->name ?? 'Unknown Seller' }}
                                </a>
                            </h5>
                            <p class="card-text">
                                Description: {{ Str::limit($product->description, 50) ?? 'No Description' }}
                            </p>
                            <p class="card-text">
                                Price: <span class="fw-bold">${{ $product->price ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Status: {{ ucfirst($product->status) }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@endsection
