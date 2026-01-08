{{-- resources/views/user/checkout.blade.php --}}
@extends('user.layout')

@section('content')
<div class="container py-5" style="min-height:70vh;">

    <h3 class="mb-4 text-pink text-center wow fadeInDown">🛒 Checkout</h3>

    @if($cartItems->count() > 0)
    <div class="row g-4">

        {{-- Cart Items --}}
        <div class="col-lg-8 col-12">
            @foreach($cartItems as $item)
                <div class="card mb-3 shadow-sm wow fadeInUp" data-wow-delay="0.{{ $loop->index+1 }}s">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1 text-white">{{ $item->product->name }} × {{ $item->quantity }}</h6>
                            <small class="text-white">{{ $item->product->subcategory->name ?? '—' }}</small>
                        </div>
                        <span class="fw-bold text-white">Rs {{ number_format($item->product->price * $item->quantity, 2) }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Order Summary --}}
        <div class="col-lg-4 col-12">
            <div class="card shadow-sm wow fadeInRight" data-wow-delay="0.5s">
                <div class="card-body bg-dark text-white rounded-3">

                    <h5 class="mb-4">Order Summary</h5>

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
                    <hr class="bg-light">
                    <div class="d-flex justify-content-between fw-bold mb-3">
                        <span>Grand Total</span>
                        <span>Rs {{ number_format($grandTotal, 2) }}</span>
                    </div>

                    {{-- Place Order --}}
                    <form action="{{ route('place.order') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-pink w-100 py-2">
                            Place Order
                        </button>
                    </form>

                </div>
            </div>
        </div>

    </div>
    @else
        <p class="text-center text-white display-6 mt-5 wow fadeIn">Your cart is empty.</p>
    @endif

</div>

{{-- Custom CSS --}}
<style>
    .btn-pink { background-color: #ff2a95; color: #fff; font-weight:600; }
    .btn-pink:hover { background-color: #d31876; color:#fff; }

    .card { background-color: #1b1b1b; transition: transform 0.3s, box-shadow 0.3s; }
    .card:hover { transform: translateY(-5px); box-shadow: 0 12px 25px rgba(0,0,0,0.3); }
</style>

{{-- JS for subtle animations --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script>
    new WOW().init(); // WOW.js animation for fadeIn
</script>
@endsection
