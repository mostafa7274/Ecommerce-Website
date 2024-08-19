@extends('layouts.app')

@section('content')
<div class="container-lg">
    <h1 class="my-4 text-center">Registered Users and Sellers</h1>

    <!-- Users Table -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Users</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Registered At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('d/m/Y') }}</td>
                            <td>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Sellers Table -->
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Sellers</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Registered At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sellers as $seller)
                        <tr>
                            <td>{{ $seller->name }}</td>
                            <td>{{ $seller->email }}</td>
                            <td>{{ $seller->created_at->format('d/m/Y') }}</td>
                            <td>
                                @if (in_array($seller->id, Cache::get('blocked_sellers', [])))
                                    <form action="{{ route('admin.sellers.unblock', $seller->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm">Unblock</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.sellers.block', $seller->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Block</button>
                                    </form>
                                @endif

                                <form action="{{ route('admin.sellers.destroy', $seller->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
