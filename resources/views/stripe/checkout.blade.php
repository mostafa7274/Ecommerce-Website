<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Checkout</h1>
        <div class="card">
            <div class="card-header">
                <h5>Shopping Cart</h5>
            </div>
            <div class="card-body">
                <table id="cart" class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th style="width:50%">Product</th>
                            <th style="width:10%">Price</th>
                            <th style="width:8%">Quantity</th>
                            <th style="width:22%" class="text-center">Subtotal</th>
                            <th style="width:10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $item)
                        <tr>
                            <td data-th="Product">
                                <div class="row">
                                    <div class="col-sm-3 hidden-xs">
                                        <img src="{{ asset('images/' . $item->image) }}" width="100" height="100" class="img-responsive" alt="{{ $item->name }}"/>
                                    </div>
                                    <div class="col-sm-9">
                                        <h4 class="nomargin">{{ $item->name }}</h4>
                                    </div>
                                </div>
                            </td>
                            <td data-th="Price">{{ number_format($item->price, 2) }} EGP</td>
                            <td data-th="Quantity">

                                {{ $item->pivot->quantity }}
                            </td>
                            <td data-th="Subtotal" class="text-center">

                                {{ number_format($item->price * $item->pivot->quantity, 2) }} EGP
                            </td>
                            <td class="actions" data-th="">
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash-o"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-end">
                                <h3><strong>Total {{ number_format($total, 2) }} EGP</strong></h3>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-end">
                                <form action="{{ route('session') }}" method="POST">
                                    @csrf
                                    <a href="{{ url('/') }}" class="btn btn-danger">
                                        <i class="fa fa-arrow-left"></i> Continue Shopping
                                    </a>

                                    <input type="hidden" name="total" value="{{ $total }}">
                                    <input type="hidden" name="productname" value="{{ $cartItems->pluck('name')->implode(', ') }}">
                                    <button class="btn btn-success" type="submit">
                                        <i class="fa fa-money"></i> Checkout
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
