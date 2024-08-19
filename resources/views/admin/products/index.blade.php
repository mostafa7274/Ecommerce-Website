@extends('layouts.app')

@section('content')
<div class="container-lg">
    <div class="mb-3">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-info">Back</a>
    </div>

    <h1 class="my-4">Pending Products</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($products->isEmpty())
        <div class="alert alert-info">No products pending approval.</div>
    @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
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
                                Description: {{ Str::limit($product->description, 100) ?? 'No Description' }}
                            </p>
                            <p class="card-text">
                                Price: <span class="fw-bold">${{ number_format($product->price, 2) ?? 'N/A' }}</span>
                            </p>
                        </div>


                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <small class="text-muted">Status: {{ ucfirst($product->status) }}</small>
                            <div class="mt-2">

                                <form action="{{ route('admin.products.approve', $product->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                </form>

                                <!-- Reject Form -->
                                <form action="{{ route('admin.products.reject', $product->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
