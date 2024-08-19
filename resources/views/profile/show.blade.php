@extends('layouts.app')

@section('content')

<div class="container-lg">
    <h1>{{ $seller->name }}</h1>
    <p>Email: {{ $seller->email }}</p>
    
</div>

@endsection
