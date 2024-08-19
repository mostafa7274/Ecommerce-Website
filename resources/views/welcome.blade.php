<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>OldSchool Stripes</title>
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
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact.form') }}">Contact Us</a>
                </li>

            </ul>

            <a class="nav-link cart-icon" href="{{ url('/carts/show') }}">
                <i class="fas fa-shopping-cart"></i>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-link nav-link" style="color: white; display: inline; padding: 0;">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container mt-5 pt-5">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <a href="{{ url('/product/' . $product->id) }}" class="card-link">
                        <div class="card product-card">
                            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                                <p class="card-price">{{ number_format($product->price, 2) }}EGP</p>
                                <button class="btn btn-primary">View T-shirt</button>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        @if ($products->isEmpty())
            <div class="alert alert-info">No approved products available for purchase.</div>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        var prevScrollpos = window.pageYOffset;
        window.onscroll = function() {
            var currentScrollPos = window.pageYOffset;
            if (prevScrollpos > currentScrollPos) {
                document.querySelector(".navbar").style.top = "0";
            } else {
                document.querySelector(".navbar").style.top = "-70px";
            }
            prevScrollpos = currentScrollPos;
        }
    </script>
</body>
</html>
