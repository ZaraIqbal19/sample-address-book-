{{-- resources/views/user/cart.blade.php --}}
@extends('user.layout')

@section('content')
<div class="container py-5" style="min-height:70vh;">

    <h3 class="mb-4 text-dark">My Cart</h3>

    @if($cartItems->count() > 0)

    <div class="row">

        {{-- ================= CART ITEMS ================= --}}
        <div class="col-lg-8 col-12" id="cartItemsContainer">

            @php $subtotal = 0; @endphp

            @foreach($cartItems as $item)
                @php
                    $itemTotal = $item->product->price * $item->quantity;
                    $subtotal += $itemTotal;
                @endphp

                <div class="card mb-3 shadow-sm cart-item" data-cart="{{ $item->id }}">
                    <div class="card-body">

                        <div class="row align-items-center">

                            {{-- Product --}}
                            <div class="col-md-5 d-flex align-items-center">
                             <img src="{{ asset('products/' . $item->product->image) }}"
     class="rounded"
     style="width:80px;height:80px;object-fit:cover;">

                                <div class="ms-3">
                                    <h6 class="mb-1 text-dark">{{ $item->product->name }}</h6>
                                    <small class="text-muted">
                                        {{ $item->product->subcategory->name ?? '—' }}
                                    </small>
                                </div>
                            </div>

                            {{-- Price --}}
                            <div class="col-md-2 text-dark price" data-price="{{ $item->product->price }}">
                                Rs {{ number_format($item->product->price, 2) }}
                            </div>

                            {{-- Quantity --}}
                            <div class="col-md-3 d-flex align-items-center qty-box"
                                 data-cart="{{ $item->id }}"
                                 data-stock="{{ $item->product->stock ?? 10 }}">
                                
                                <button class="btn btn-outline-secondary btn-sm minus">−</button>

                                <input type="number" class="form-control text-center mx-2 qty-input"
                                       value="{{ $item->quantity }}" readonly
                                       style="width:70px;">

                                <button class="btn btn-outline-secondary btn-sm plus">+</button>
                            </div>

                            {{-- Total + Remove --}}
                            <div class="col-md-2 text-end">
                                <div class="fw-semibold text-dark item-total">
                                    Rs {{ number_format($itemTotal, 2) }}
                                </div>

                                <button class="btn btn-link text-danger p-0 remove-item mt-2"
                                        data-cart="{{ $item->id }}">
                                    Remove
                                </button>
                            </div>

                        </div>

                    </div>
                </div>

            @endforeach
        </div>

        {{-- ================= ORDER SUMMARY ================= --}}
        <div class="col-lg-4 col-12">

            @php
                $tax = 0;
                $shipping = 200;
                $discount = 0;
                $grandTotal = $subtotal + $tax + $shipping - $discount;
            @endphp

            <div class="card shadow-sm">
                <div class="card-body">

                    <h5 class="mb-3 text-dark">Order Summary</h5>

                    <div class="d-flex justify-content-between mb-2 text-dark">
                        <span>Subtotal</span>
                        <span id="subtotal">Rs {{ number_format($subtotal, 2) }}</span>
                    </div>

                    <div class="d-flex justify-content-between mb-2 text-dark">
                        <span>Tax</span>
                        <span id="tax">Rs {{ number_format($tax, 2) }}</span>
                    </div>

                    <div class="d-flex justify-content-between mb-2 text-dark">
                        <span>Shipping</span>
                        <span id="shipping">Rs {{ number_format($shipping, 2) }}</span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between fw-bold text-dark mb-3">
                        <span>Grand Total</span>
                        <span id="grandTotal">Rs {{ number_format($grandTotal, 2) }}</span>
                    </div>

                    {{-- Coupon (UI only) --}}
                    <input type="text" class="form-control mb-2" placeholder="Promo code">
                    <button class="btn btn-outline-dark w-100 mb-3" disabled>
                        Apply Coupon
                    </button>

                    <a href="{{ route('user.products') }}" class="btn btn-light w-100 mb-2">
                        Continue Shopping
                    </a>
<a id="checkoutBtn" href="{{ route('checkout.index') }}" class="btn btn-dark w-100 {{ $cartItems->count() == 0 ? 'disabled' : '' }}">
    Proceed to Checkout
</a>



                </div>
            </div>

        </div>

    </div>

    @else
        <p class="text-muted">Your cart is empty.</p>
    @endif

</div>

{{-- JS --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function(){

    // Function to update totals dynamically
    function updateTotals(){
        let subtotal = 0;
        $('.cart-item').each(function(){
            let total = parseFloat($(this).find('.item-total').data('total') || 0);
            subtotal += total;
        });

        let tax = 0;
        let shipping = 200;
        let discount = 0;
        let grandTotal = subtotal + tax + shipping - discount;

        $('#subtotal').text('Rs ' + subtotal.toFixed(2));
        $('#grandTotal').text('Rs ' + grandTotal.toFixed(2));
    }

    // Update cart quantity via AJAX
    function updateCart(cart_id, quantity, itemPrice, itemTotalElem){
        $.post("{{ route('cart.update') }}", {
            _token: "{{ csrf_token() }}",
            cart_id: cart_id,
            quantity: quantity
        }, function(res){
            if(res.success){
                let newTotal = itemPrice * quantity;
                itemTotalElem.text('Rs ' + newTotal.toFixed(2))
                             .data('total', newTotal);
                updateTotals();
            }
        });
    }

    // PLUS button
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
        } else {
            alert('Out of Stock!');
        }
    });

    // MINUS button
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

    // REMOVE ITEM
    $('.remove-item').click(function(){
        if(!confirm('Are you sure to remove this item?')) return;
        let cart_id = $(this).data('cart');
        let card = $(this).closest('.cart-item');

        $.ajax({
            url: "{{ route('cart.remove') }}",
            type: "POST",
            data: {_token: "{{ csrf_token() }}", cart_id: cart_id, _method: 'DELETE'},
            success: function(res){
                if(res.success){
                    card.remove();
                    updateTotals();
                    if($('#cartItemsContainer .cart-item').length === 0){
                        $('#cartItemsContainer').html('<p class="text-muted">Your cart is empty.</p>');
                    }
                } else {
                    alert('Failed to remove item!');
                }
            }
        });
    });

});
// Enable/disable checkout button based on cart items
function toggleCheckoutButton(){
    if($('#cartItemsContainer .cart-item').length > 0){
        $('#checkoutBtn').removeClass('disabled');
    } else {
        $('#checkoutBtn').addClass('disabled');
    }
}

// Call this on page load and after any remove/update
toggleCheckoutButton();
if(res.success){
    card.remove();
    updateTotals();
    toggleCheckoutButton(); // <-- update button
    if($('#cartItemsContainer .cart-item').length === 0){
        $('#cartItemsContainer').html('<p class="text-muted">Your cart is empty.</p>');
    }
}

</script>

@endsection
