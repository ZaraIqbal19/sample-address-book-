@extends('user.layout')

@section('content')
<div class="container py-5" style="min-height:70vh;">
    <h3 class="mb-4 text-dark">Checkout</h3>

    @if($cartItems->count() > 0)
    <div class="row">

        {{-- Cart Items --}}
        <div class="col-lg-8 col-12">
            @foreach($cartItems as $item)
                <div class="mb-3">
                    <h6>{{ $item->product->name }} x {{ $item->quantity }}</h6>
                    <p>Rs {{ number_format($item->product->price * $item->quantity, 2) }}</p>
                </div>
            @endforeach
        </div>

        {{-- Order Summary --}}
        <div class="col-lg-4 col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3 text-dark">Order Summary</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span>Rs {{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tax</span>
                        <span>Rs {{ number_format($tax, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Shipping</span>
                        <span>Rs {{ number_format($shipping, 2) }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold mb-3">
                        <span>Grand Total</span>
                        <span>Rs {{ number_format($grandTotal, 2) }}</span>
                    </div>

                    <form action="{{ route('place.order') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-dark w-100">Place Order</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    @else
        <p class="text-muted">Your cart is empty.</p>
    @endif
</div>
@endsection
