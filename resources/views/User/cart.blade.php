{{-- resources/views/user/cart.blade.php --}}
@extends('user.layout')

@section('content')
<div class="container py-5" style="min-height:70vh;">

    <h3 class="mb-4 text-center text-white" data-aos="fade-down" data-aos-delay="100" style="font-family:'Playfair Display', serif;">🛒 My Cart</h3>

    @if($cartItems->count() > 0)

    <div class="row g-4">

        {{-- CART ITEMS --}}
        <div class="col-lg-8 col-12" id="cartItemsContainer">
            @php $subtotal = 0; @endphp

            @foreach($cartItems as $item)
                @php
                    $itemTotal = $item->product->price * $item->quantity;
                    $subtotal += $itemTotal;
                @endphp

                <div class="card mb-3 shadow-sm cart-item position-relative" 
                     data-aos="fade-up" 
                     data-aos-delay="{{ $loop->index * 100 }}" 
                     data-cart="{{ $item->id }}">
                    <div class="card-body">

                        <div class="row align-items-center">

                            {{-- Product --}}
                            <div class="col-md-5 d-flex align-items-center">
                                <img src="{{ asset('products/' . $item->product->image) }}" 
                                     class="rounded me-3 product-img" 
                                     style="width:80px;height:80px;object-fit:cover;">
                                <div>
                                    <h6 class="mb-1 text-white">{{ $item->product->name }}</h6>
                                    <small class="text-white">{{ $item->product->subcategory->name ?? '—' }}</small>
                                </div>
                            </div>

                            {{-- Price --}}
                            <div class="col-md-2 text-white price" data-price="{{ $item->product->price }}">
                                Rs {{ number_format($item->product->price, 2) }}
                            </div>

                            {{-- Quantity --}}
                            <div class="col-md-3 d-flex align-items-center qty-box" data-cart="{{ $item->id }}" data-stock="{{ $item->product->stock ?? 10 }}">
                                <button class="btn btn-outline-light btn-sm minus">−</button>
                                <input type="number" class="form-control text-center mx-2 qty-input" value="{{ $item->quantity }}" readonly style="width:70px;">
                                <button class="btn btn-outline-light btn-sm plus">+</button>
                            </div>

                            {{-- Total + Remove --}}
                            <div class="col-md-2 text-end">
                                <div class="fw-semibold text-white item-total" data-total="{{ $itemTotal }}">
                                    Rs {{ number_format($itemTotal, 2) }}
                                </div>
                                <button class="btn btn-link text-danger p-3 mt-2 remove-item" data-cart="{{ $item->id }}">
                                    Remove
                                </button>
                            </div>

                        </div>

                    </div>
                </div>

            @endforeach
        </div>

        {{-- ORDER SUMMARY --}}
        <div class="col-lg-4 col-12">
            @php
                $tax = 0;
                $shipping = 200;
                $discount = 0;
                $grandTotal = $subtotal + $tax + $shipping - $discount;
            @endphp

            <div class="card shadow-sm" data-aos="fade-left" data-aos-delay="500">
                <div class="card-body bg-dark text-white rounded-3">

                    <h5 class="mb-4" style="font-family:'Playfair Display', serif;">Order Summary</h5>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span id="subtotal">Rs {{ number_format($subtotal, 2) }}</span>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Tax</span>
                        <span id="tax">Rs {{ number_format($tax, 2) }}</span>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Shipping</span>
                        <span id="shipping">Rs {{ number_format($shipping, 2) }}</span>
                    </div>

                    <hr class="bg-light">

                    <div class="d-flex justify-content-between fw-bold mb-3">
                        <span>Grand Total</span>
                        <span id="grandTotal">Rs {{ number_format($grandTotal, 2) }}</span>
                    </div>

                    {{-- Coupon --}}
                    <input type="text" class="form-control mb-2" placeholder="Promo code">
                    <button class="btn btn-outline-light w-100 mb-3" disabled>Apply Coupon</button>

                    <a href="{{ route('user.products') }}" class="btn btn-light w-100 mb-2">Continue Shopping</a>
                    <a id="checkoutBtn" href="{{ route('checkout.index') }}" class="btn btn-pink w-100 {{ $cartItems->count() == 0 ? 'disabled' : '' }}">Proceed to Checkout</a>

                </div>
            </div>
        </div>

    </div>

    @else
        <p class="text-white text-center mt-5">Your cart is empty.</p>
    @endif

</div>

{{-- Interactive CSS --}}
<style>
    .btn-pink { background-color: #ff2a95; color: #fff; font-weight:600; }
    .btn-pink:hover { background-color: #d31876; color:#fff; }
    .cart-item { 
        background-color: #1b1b1b; 
        border-radius: 12px;
        transition: transform 0.3s, box-shadow 0.3s, border 0.3s;
        border: 1px solid transparent;
    }
    .cart-item:hover { 
        transform: translateY(-5px); 
        box-shadow: 0 10px 25px rgba(255,42,149,0.3); 
        border: 1px solid #ff2a95; 
    }
    .product-img { transition: transform 0.3s; }
    .product-img:hover { transform: scale(1.05); }

    .btn-pink { 
        background: linear-gradient(135deg,#ff2a95,#ff57b0); 
        color: #fff; 
        transition: all 0.3s;
    }
    .btn-pink:hover { 
        background: linear-gradient(135deg,#d31876,#ff2a95);
        box-shadow: 0 0 12px #ff2a95;
    }

    .text-pink { color: #ff2a95 !important; }

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

    input.form-control:focus { 
        border-color: #ff2a95;
        box-shadow: 0 0 6px #ff2a95;
        outline: none;
        background-color: #1b1b1b;
        color: #fff;
    }

    .remove-item:hover { text-decoration: underline; cursor: pointer; }

    .card-body.bg-dark { 
        background-color: #1b1b1b !important; 
        border-radius: 12px;
    }
</style>

{{-- JS --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('User/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>
$(document).ready(function(){
    AOS.init({ duration: 800, once: true });

    function updateTotals(){
        let subtotal = 0;
        $('.cart-item').each(function(){
            let total = parseFloat($(this).find('.item-total').data('total') || 0);
            subtotal += total;
        });
        let tax = 0, shipping = 200, discount = 0;
        let grandTotal = subtotal + tax + shipping - discount;
        $('#subtotal').text('Rs ' + subtotal.toFixed(2));
        $('#grandTotal').text('Rs ' + grandTotal.toFixed(2));

        if($('.cart-item').length > 0) $('#checkoutBtn').removeClass('disabled');
        else $('#checkoutBtn').addClass('disabled');
    }

    function updateCart(cart_id, quantity, itemPrice, itemTotalElem){
        $.post("{{ route('cart.update') }}", {
            _token: "{{ csrf_token() }}",
            cart_id: cart_id,
            quantity: quantity
        }, function(res){
            if(res.success){
                let newTotal = itemPrice * quantity;
                itemTotalElem.text('Rs ' + newTotal.toFixed(2)).data('total', newTotal);
                updateTotals();
            }
        });
    }

    $('.plus').click(function(){
        let box = $(this).closest('.qty-box');
        let input = box.find('.qty-input');
        let qty = parseInt(input.val());
        let stock = parseInt(box.data('stock'));
        let cart_id = box.data('cart');
        let itemTotalElem = box.closest('.row').find('.item-total');
        let itemPrice = parseFloat(box.closest('.row').find('.price').data('price'));

        if(qty < stock){
            qty++;
            input.val(qty);
            updateCart(cart_id, qty, itemPrice, itemTotalElem);
        } else alert('Out of Stock!');
    });

    $('.minus').click(function(){
        let box = $(this).closest('.qty-box');
        let input = box.find('.qty-input');
        let qty = parseInt(input.val());
        let cart_id = box.data('cart');
        let itemTotalElem = box.closest('.row').find('.item-total');
        let itemPrice = parseFloat(box.closest('.row').find('.price').data('price'));

        if(qty > 1){
            qty--;
            input.val(qty);
            updateCart(cart_id, qty, itemPrice, itemTotalElem);
        }
    });

    $('.remove-item').click(function(){
        let removeCardElem = $(this).closest('.cart-item');
        let cart_id = $(this).data('cart');

        if(confirm('Are you sure you want to remove this item from your cart?')) {
            $.ajax({
                url: "{{ route('cart.remove') }}",
                type: "POST",
                data: {_token: "{{ csrf_token() }}", cart_id: cart_id, _method: 'DELETE'},
                success: function(res){
                    if(res.success){
                        removeCardElem.fadeOut(300, function(){
                            $(this).remove();
                            updateTotals();
                        });
                    } else {
                        alert('Failed to remove item!');
                    }
                },
                error: function(){
                    alert('Error occurred while removing the item.');
                }
            });
        }
    });

});
</script>

@endsection
