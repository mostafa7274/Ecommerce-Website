@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Cart</h1>



    @if($cartItems->isEmpty())
        <p>Your cart is empty.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td><img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->name }}" style="width: 100px; height: auto;"></td>
                        <td>{{ $item->pivot->quantity }}</td>
                        <td>{{ number_format($item->price * $item->pivot->quantity, 2) }} EGP</td>
                        <td>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-right">
            <form action="{{ route('checkout') }}" method="GET">
                @csrf
                <a href="{{ url('/') }}" class="btn btn-warning ">Back to Home</a>
                <button type="submit" class="btn btn-success">Pay</button>

            </form>
        </div>
    @endif
</div>
@endsection
