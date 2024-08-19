@extends('layouts.app')

@section('content')
<div class="container-lg">
    <h1 class="my-4 text-center">Registered Sellers</h1>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Registered Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sellers as $seller)
                <tr>
                    <td>{{ $seller->id }}</td>
                    <td>{{ $seller->name }}</td>
                    <td>{{ $seller->email }}</td>
                    <td>{{ $seller->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('admin.sellers.edit', $seller->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.sellers.destroy', $seller->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                        <form action="{{ route('admin.sellers.block', $seller->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-secondary">Block</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
