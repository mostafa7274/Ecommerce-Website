@extends('seller.layouts.app')

@section('content')

<div class="container-lg mt-4">

    <div class="mb-4">
        <h1 class="display-4">Welcome, {{ Auth::guard('seller')->user()->name }}!</h1>
        <p class="lead">Here's an overview of your dashboard.</p>
    </div>


    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Add a New Product</h5>
                    <p class="card-text">Easily add new products to your store.</p>
                    <a href="{{ url('product/create') }}" class="btn btn-primary">Add Product</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">View Your Products</h5>
                    <p class="card-text">View and manage the products you've added.</p>
                    <a href="{{ url('product') }}" class="btn btn-secondary">View Products</a>
                </div>
            </div>
        </div>
    </div>

   

</div>

@endsection
