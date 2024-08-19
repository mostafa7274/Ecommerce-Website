<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>{{ $product->name }}</title>
    <style>
        .navbar-custom {
            background-color: #2c3e50;
        }
        .navbar-custom .navbar-brand, .navbar-custom .nav-link {
            color: #fff;
        }
        .navbar-custom .nav-link:hover {
            color: #ddd;
        }
        .product-card img {
            max-height: 400px;
            object-fit: cover;
        }
        .product-details {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fas fa-tshirt"></i>
            OldSchool Stripes
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>
            </ul>

            <a class="nav-link cart-icon" href="{{ url('/cart.php') }}">
                <i class="fas fa-shopping-cart"></i>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-link nav-link" style="color: #fff; padding: 0;">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid product-card">
            </div>
            <div class="col-lg-6 mb-4 product-details">
                <h1>{{ $product->name }}</h1>
                <p>{{ $product->description }}</p>
                <p class="h4">{{ number_format($product->price, 2) }} EGP</p>
                <p><strong>Seller Name:</strong> {{ $product->seller->name }}</p>
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </form>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
