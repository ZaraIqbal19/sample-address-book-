@extends('user.layout')

@section('content')

<div class="container py-5 product-detail">

    {{-- CLOSE / BACK BUTTON --}}
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-outline-dark close-page rounded-circle"
                style="width:40px; height:40px; font-size:22px; line-height:1;">
            &times;
        </button>
    </div>

    <div class="row">
        {{-- Product Image --}}
        <div class="col-md-6">
            <img src="{{ asset('products/'.$product->image) }}"
                 class="img-fluid border p-2"
                 style="width:100%; max-height:400px; object-fit:contain;">
        </div>

        {{-- Product Info --}}
        <div class="col-md-6">
            <h2 class="fw-bold">{{ ucfirst($product->name) }}</h2>

            {{-- Price --}}
            <h4 class="mb-3">Rs {{ number_format($product->price, 2) }}</h4>

            {{-- Stock Status --}}
            <p id="stockStatus" class="fw-bold text-success">In Stock</p>

            {{-- Quantity Box --}}
            <div class="d-flex align-items-center mb-3 qty-box"
                 data-product="{{ $product->id }}"
                 data-sku="{{ $product->sku }}">
                <button class="btn btn-outline-dark btn-sm minus">−</button>
                <input type="number"
                       class="form-control text-center mx-2 qty-input"
                       value="1"
                       readonly
                       style="width:70px;">
                <button class="btn btn-outline-dark btn-sm plus">+</button>
            </div>

            {{-- Buttons --}}
            <div class="d-flex flex-column gap-2 mb-3">
                <button class="btn btn-dark add-to-cart">Add to Cart</button>

                {{-- Wishlist --}}
                @php $inWishlist = $product->isInWishlist(); @endphp
                <button class="btn {{ $inWishlist ? 'btn-danger' : 'btn-outline-secondary' }} wishlist-btn"
                        data-product="{{ $product->id }}">
                    {{ $inWishlist ? 'Remove from Wishlist' : 'Add to Wishlist' }}
                </button>
            </div>

            {{-- Description --}}
            <div class="mt-4">
                <h5 class="fw-bold">Product Description</h5>
                <p class="text-muted">{{ $product->description }}</p>
            </div>
        </div>
    </div>
</div>

{{-- CART MODAL --}}
<div class="modal fade" id="cartModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cart Update</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="cartModalBody"></div>
        </div>
    </div>
</div>

{{-- SCRIPTS --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function(){

    function showModal(msg){
        $('#cartModalBody').text(msg);
        new bootstrap.Modal(document.getElementById('cartModal')).show();
    }

    // BACK BUTTON
    $('.close-page').click(function(){
        window.history.back();
    });

    // PLUS
    $('.plus').click(function(){
        let box = $('.qty-box');
        let input = box.find('.qty-input');
        let sku = parseInt(box.data('sku'));
        let product_id = box.data('product');
        let qty = parseInt(input.val());

        if(qty < sku){
            input.val(qty + 1);

            $.post("{{ route('cart.increase') }}", {
                _token: "{{ csrf_token() }}",
                product_id: product_id
            });

            $('#stockStatus').text('In Stock')
                             .removeClass('text-danger')
                             .addClass('text-success');
        } else {
            input.val(sku);
            $('#stockStatus').text('Out of Stock')
                             .removeClass('text-success')
                             .addClass('text-danger');
        }
    });

    // MINUS
    $('.minus').click(function(){
        let box = $('.qty-box');
        let input = box.find('.qty-input');
        let product_id = box.data('product');
        let qty = parseInt(input.val());

        if(qty > 1){
            input.val(qty - 1);

            $.post("{{ route('cart.decrease') }}", {
                _token: "{{ csrf_token() }}",
                product_id: product_id
            });

            $('#stockStatus').text('In Stock')
                             .removeClass('text-danger')
                             .addClass('text-success');
        }
    });

    // ADD TO CART
    $('.add-to-cart').click(function(){
        let qty = parseInt($('.qty-input').val());
        let product_id = $('.qty-box').data('product');

        $.post("{{ route('cart.add') }}", {
            _token: "{{ csrf_token() }}",
            product_id: product_id,
            quantity: qty
        }, function(res){
            showModal('Added ' + res.added_qty + ' item(s) to cart');
        });
    });

    // WISHLIST TOGGLE
    $('.wishlist-btn').click(function(){
        let btn = $(this);
        let product_id = btn.data('product');

        $.post("{{ url('/wishlist/toggle') }}", {
            _token: "{{ csrf_token() }}",
            product_id: product_id
        }, function(res){
            if(res.added){
                btn.text('Remove from Wishlist')
                   .removeClass('btn-outline-secondary')
                   .addClass('btn-danger');
            } else {
                btn.text('Add to Wishlist')
                   .removeClass('btn-danger')
                   .addClass('btn-outline-secondary');
            }
        });
    });

});
</script>

@endsection
