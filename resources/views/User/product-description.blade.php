
@extends('user.layout')
@section('content')
<div class="container py-5">
    <h2>{{ $product->name }}</h2>
    <p>{{ $product->description }}</p>
</div>
@endsection
