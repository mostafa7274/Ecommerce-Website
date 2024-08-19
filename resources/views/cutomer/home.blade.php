@extends('layouts.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<div class="container-lg">
    <h1 class="my-4 text-center">Customer Dashboard</h1>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card stats-card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-users"></i> Total Users</h5>
                    <p class="card-text">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card stats-card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-store"></i> Total Sellers</h5>
                    <p class="card-text">{{ $totalSellers }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <a href="{{ route('cutomer.products.index') }}" class="btn btn-manage-products w-100">Manage Products</a>
        </div>
        <div class="col-md-6 mb-3">
            <a href="{{ route('cutomer.users.index') }}" class="btn btn-manage-users w-100">Manage Users</a>
        </div>
    </div>


    <div class="card mb-4">
        <div class="card-header">
            <h3>Registered Users</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Registered Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Registered Sellers Table -->
    <div class="card">
        <div class="card-header">
            <h3>Registered Sellers</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Registered Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sellers as $seller)
                        <tr>
                            <td>{{ $seller->id }}</td>
                            <td>{{ $seller->name }}</td>
                            <td>{{ $seller->email }}</td>
                            <td>{{ $seller->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
