@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4 shadow-sm">
    <div class="container">

        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fas fa-tshirt"></i>
            OldSchool Stripes
        </a>


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center text-info fw-bold" href="{{ route('products') }}">
                        <i class="bi bi-arrow-left-circle me-2" style="font-size: 1.2rem;"></i>
                        Back
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<div class="container-lg">
    <h2 class="text-center mb-4">Add a New Product</h2>


    <div class="position-relative text-center mb-4">
        <div class="d-inline-block">
            @if(count($errors) > 0)
                <div class="alert alert-warning py-3 px-4 rounded-pill">
                    @foreach ($errors->all() as $i)
                        <h6>{{ $i }}</h6>
                        @break
                    @endforeach
                </div>
            @endif
            @if(\Session::has('success'))
                <div class="alert alert-success py-3 px-4 rounded-pill">
                    <h6>{{ \Session::get('success') }}</h6>
                </div>
            @endif
            @if(\Session::has('warning'))
                <div class="alert alert-warning py-2 px-4 rounded-pill">
                    <h6>{{ \Session::get('warning') }}</h6>
                </div>
            @endif
            @if(\Session::has('error'))
                <div class="alert alert-danger py-3 px-4 rounded-pill">
                    <h6>{{ \Session::get('error') }}</h6>
                </div>
            @endif
        </div>
    </div>

    
    <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data" class="shadow-sm p-4 rounded-3 bg-white">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" name="name" id="name" class="form-control" placeholder="Product name" value="{{ old('name') }}" required>
                    <label for="name">Product Name</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="number" name="price" id="price" class="form-control" placeholder="Product price" min="10" max="2000" value="{{ old('price') }}" required>
                    <label for="price">Price (EGP)</label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-floating">
                    <textarea name="description" class="form-control" id="description" rows="4" placeholder="Product description">{{ old('description') }}</textarea>
                    <label for="description">Description</label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="image" class="form-label">Product Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
            </div>
        </div>
        <div class="mt-4 text-center">
            <button class="btn btn-primary px-4 py-2 rounded-pill fw-bolder">Add Product</button>
        </div>
    </form>
</div>

@endsection
