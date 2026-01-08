@extends('user.layout')

@section('content')

<div class="container py-5 position-relative">

    {{-- BACK / CLOSE BUTTON --}}
    <button class="btn btn-outline-light close-page rounded-circle position-absolute"
            style="top:40px; right:10px; width:40px; height:40px; font-size:22px; line-height:1; z-index:1000;">
        &times;
    </button>

    {{-- PAGE HEADING --}}
    <div class="text-center mb-5 wow fadeInDown">
        <h1 class="fw-bold text-uppercase text-white" style="font-family:'Playfair Display', serif;">Product Details</h1>
        <p class="text-white mt-3 mx-auto" style="max-width:700px; line-height:1.6; font-family:Poppins, sans-serif;">
            Explore this product in detail, check stock availability, pricing, and conveniently add it to your cart.
        </p>
        <hr class="mx-auto" style="width:100px; border-top:4px solid #ff2a95;">
    </div>

    <div class="row g-4 align-items-start">

        {{-- PRODUCT IMAGE --}}
        <div class="col-md-6 wow fadeInLeft">
            <div class="border rounded shadow-sm overflow-hidden product-image-container" 
                 style="transition: transform 0.3s, box-shadow 0.3s;">
                <img src="{{ asset('products/'.$product->image) }}"
                     class="img-fluid w-100 product-img"
                     style="max-height:700px; object-fit:cover; transition: transform 0.3s;"
                     alt="{{ $product->name }}">
            </div>
        </div>

        {{-- PRODUCT INFO --}}
        <div class="col-md-6 d-flex flex-column justify-content-start wow fadeInRight">

            {{-- PRODUCT NAME --}}
            <h2 class="fw-bold mb-3 text-center text-white text-uppercase" style="font-family:'Playfair Display', serif;">
                {{ ucfirst($product->name) }}
            </h2>

            {{-- STOCK STATUS --}}
            @php
                $stockClass = $product->sku > 0 ? 'text-success' : 'text-danger';
                $stockText = $product->sku > 0 ? 'In Stock' : 'Out of Stock';
            @endphp
            <p id="stockStatus" class="fw-semibold mb-3 text-center {{ $stockClass }}" style="font-family:Poppins, sans-serif;">
                {{ $stockText }}
            </p>

            {{-- PRODUCT DESCRIPTION --}}
            <div class="mb-3">
                <p class="text-white text-center" style="white-space: pre-line; line-height:1.5; font-family:Poppins, sans-serif;">
{{ $product->description }}                </p>
            </div>

            {{-- PRICE --}}
            <h4 class="text-white fw-bold mb-4 text-center" style="font-family:Playfair Display, serif;">
                Rs {{ number_format($product->price, 2) }}
            </h4>

            {{-- QUANTITY SELECTOR --}}
            <div class="d-flex justify-content-center align-items-center mb-4 qty-box" 
                 data-product="{{ $product->id }}" data-sku="{{ $product->sku }}">
                <button class="btn btn-outline-pink btn-sm minus">−</button>
                <input type="number" class="form-control text-center mx-2 qty-input" value="1" readonly style="width:70px;">
                <button class="btn btn-outline-pink btn-sm plus">+</button>
            </div>

            {{-- ADD TO CART BUTTON --}}
            <button class="btn btn-gradient-pink add-to-cart w-100 py-2 fw-bold">
                Add to Cart
            </button>
        </div>

    </div>
</div>
<hr>    

{{-- STYLES --}}
<style>
/* PRODUCT IMAGE HOVER */
.product-image-container:hover { 
    transform: translateY(-5px); 
    box-shadow: 0 10px 25px rgba(255,42,149,0.3); 
}
.product-img:hover { transform: scale(1.05); }

/* BUTTONS */
.btn-outline-pink {
    border: 2px solid #ff2a95;
    color: #ff2a95;
    transition: all 0.3s;
}
.btn-outline-pink:hover {
    background-color: #ff2a95;
    color: #fff;
    box-shadow: 0 0 8px #ff2a95;
}

.btn-gradient-pink {
    background: linear-gradient(135deg,#ff2a95,#ff57b0);
    color: #fff;
    transition: all 0.3s;
    border-radius: 8px;
}
.btn-gradient-pink:hover {
    background: linear-gradient(135deg,#d31876,#ff2a95);
    box-shadow: 0 0 12px #ff2a95;
}

/* QUANTITY BOX BUTTONS */
.qty-box button { 
    transition: all 0.2s; 
    border-color: #ff2a95;
    color: #fff;
}
.qty-box button:hover { 
    transform: scale(1.1); 
    background-color: #ff2a95;
    border-color: #ff2a95;
    color: #fff;
}

/* CLOSE BUTTON */
.close-page:hover {
    background-color: #ff2a95;
    color: #fff;
    transition: 0.3s;
}

/* TEXT ACCENT */
.text-pink { color: #ff2a95 !important; }
</style>

{{-- SCRIPTS --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>

<script>
$(document).ready(function(){

    new WOW().init();

    // BACK / CLOSE BUTTON
    $('.close-page').click(function(){
        window.history.back();
    });

    // Plus button
    $('.plus').click(function(){
        let box = $(this).closest('.qty-box');
        let input = box.find('.qty-input');
        let sku = parseInt(box.data('sku'));
        let qty = parseInt(input.val());

        if(qty < sku){
            input.val(qty + 1);
            $('#stockStatus').text('In Stock').removeClass('text-danger').addClass('text-success');
        } else {
            input.val(sku);
            $('#stockStatus').text('Out of Stock').removeClass('text-success').addClass('text-danger');
        }
    });

    // Minus button
    $('.minus').click(function(){
        let box = $(this).closest('.qty-box');
        let input = box.find('.qty-input');
        let qty = parseInt(input.val());

        if(qty > 1){
            input.val(qty - 1);
            $('#stockStatus').text('In Stock').removeClass('text-danger').addClass('text-success');
        }
    });

    // Add to Cart
    $('.add-to-cart').click(function(){
        let box = $('.qty-box');
        let qty = parseInt(box.find('.qty-input').val());
        let product_id = box.data('product');

        $.post("{{ route('cart.add') }}", {
            _token: "{{ csrf_token() }}",
            product_id: product_id,
            quantity: qty
        })
        .done(function(res){
            alert('Added ' + res.added_qty + ' item(s) to cart');
        })
        .fail(function(){
            alert('Failed to add to cart!');
        });
    });

});
</script>

@endsection
