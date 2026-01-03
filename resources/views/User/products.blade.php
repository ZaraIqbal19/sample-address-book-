{{-- resources/views/user/product-grid.blade.php --}}
@extends('user.layout')
@section('content')

<div class="container py-5">

    {{-- 🔹 Subcategory Filter --}}
    <div class="row mb-5 mt-4">
        <div class="col-md-4 ms-auto">
            <select id="subcategoryFilter" class="form-select form-select-lg shadow-sm mt-4">
                <option value="">— Filter by Subcategory —</option>
                @foreach($subcategories as $subcategory)
                    <option value="{{ $subcategory->name }}" 
                        {{ request('subcategory_name') == $subcategory->name ? 'selected' : '' }}>
                        {{ ucfirst($subcategory->name) }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- 🔹 Product Grid --}}
    <div id="productGrid" class="row g-4">
        @foreach($products as $product)

        @php
            $onSale = $product->sale_percentage 
                      && $product->sale_start 
                      && $product->sale_end 
                      && now()->between($product->sale_start, $product->sale_end);
            $isNewArrival = $product->new_arrival ?? false;
            $isBestSeller = $product->best_seller ?? false;
        @endphp

        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="product-card position-relative bg-white rounded-4 shadow-sm overflow-hidden">

                {{-- 🔹 Diagonal Hotpink Badges --}}
                <div class="position-absolute top-0 start-0 d-flex flex-column p-0">
                    @if($onSale)
                        <div class="ribbon">SALE</div>
                    @endif
                    @if($isNewArrival)
                        <div class="ribbon">NEW ARRIVAL</div>
                    @endif
                    @if($isBestSeller)
                        <div class="ribbon">BEST SELLER</div>
                    @endif
                </div>

                {{-- 🔴 OUT OF STOCK badge --}}
                <span class="out-stock d-none position-absolute top-0 end-0 m-2 px-2 py-1 rounded-2">OUT OF STOCK</span>

                {{-- 🔹 Product Image --}}
                <img src="{{ asset('products/'.$product->image) }}" 
                     alt="{{ $product->name }}" 
                     class="w-100" style="height:300px; object-fit:cover;">

                {{-- 🔹 Product Info --}}
                <div class="p-3 text-center">
                    <h5 class="product-name text-dark fw-bold">{{ ucfirst($product->name) }}</h5>
                    <p class="subcategory-name text-muted mb-1">{{ $product->subCategory->name ?? '' }}</p>

                    {{-- 🔹 Description --}}
                    <p class="product-desc text-secondary mb-2">{{ Str::limit($product->description, 60) }}</p>

                    {{-- 🔹 Price --}}
                    <div class="mb-2">
                        @if($onSale)
                            <span class="text-danger fw-bold">${{ number_format($product->sale_amount,2) }}</span>
                            <span class="text-muted text-decoration-line-through ms-2">${{ number_format($product->price,2) }}</span>
                        @else
                            <span class="fw-bold">${{ number_format($product->price,2) }}</span>
                        @endif
                    </div>

                    {{-- 🔹 Initial Quantity Box (UI-only) --}}
                    <div class="qty-box mb-2 d-flex justify-content-center align-items-center" 
                         data-sku="{{ $product->sku }}" data-product="{{ $product->id }}">
                        <button class="qty-btn minus btn btn-dark btn-sm">−</button>
                        <input type="number" class="qty-input form-control text-center mx-1" 
                               value="1" min="1" style="width:60px;" readonly>
                        <button class="qty-btn plus btn btn-dark btn-sm">+</button>
                    </div>

                    {{-- 🔹 Add to Cart + View Details + Inline Backend Quantity --}}
                    <div class="d-flex justify-content-center gap-2 align-items-center mt-2 flex-wrap">
                        <button class="btn btn-dark add-to-cart" data-id="{{ $product->id }}" data-sku="{{ $product->sku }}">
                            Add to Cart
                        </button>

                        <a href="{{ route('product.description',$product->id) }}" 
                           class="btn btn-outline-secondary">
                            View Details
                        </a>

                        {{-- New inline quantity box after Add to Cart --}}
                        <div class="cart-qty d-none d-flex align-items-center gap-1">
                            <button class="btn btn-outline-dark btn-sm cart-minus">−</button>
                            <input type="number" class="form-control w-25 cart-qty-input text-center" 
                                   value="1" min="1" style="width:55px;">
                            <button class="btn btn-outline-dark btn-sm cart-plus">+</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @endforeach
    </div>
</div>

{{-- 🔔 Toasts --}}
<div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="stockToast" class="toast text-bg-danger">
        <div class="toast-body">Remaining quantity requested from vendor</div>
    </div>
</div>

{{-- 🔹 Confirmation Modal for Last Item Removed --}}
<div class="modal fade" id="removedModal" tabindex="-1" aria-labelledby="removedModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="removedModalLabel">Cart Update</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Last item removed, quantity box enabled.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

{{-- 🔹 jQuery + Ajax --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){

    // Initial UI-only Quantity Box
    $(document).on('click','.plus',function(){
        let box = $(this).closest('.qty-box');
        let input = box.find('.qty-input');
        let qty = parseInt(input.val());
        let sku = parseInt(box.data('sku'));
        if(qty < sku){
            input.val(qty+1);
            box.closest('.product-card').find('.out-stock').addClass('d-none');
        } else {
            input.val(qty);
            box.closest('.product-card').find('.out-stock').removeClass('d-none');
            new bootstrap.Toast($('#stockToast')).show();
        }
    });

    $(document).on('click','.minus',function(){
        let box = $(this).closest('.qty-box');
        let input = box.find('.qty-input');
        let qty = parseInt(input.val());
        if(qty>1) input.val(qty-1);
        box.closest('.product-card').find('.out-stock').addClass('d-none');
    });

    // Add to Cart
    $('.add-to-cart').click(function(){
        let btn = $(this);
        let card = btn.closest('.product-card');
        let qtyBox = card.find('.qty-box');
        let qty = parseInt(qtyBox.find('.qty-input').val());
        let product_id = btn.data('id');

        $.post("{{ route('cart.add') }}",{
            _token:"{{ csrf_token() }}",
            product_id: product_id,
            quantity: qty
        }, function(res){
            if(res.remaining_qty>0){
                new bootstrap.Toast($('#stockToast')).show();
            }

            // Disable initial quantity box
            qtyBox.find('.qty-input').prop('readonly',true);
            qtyBox.find('.plus, .minus').prop('disabled',true);

            // Show backend inline cart quantity
            let cartBox = card.find('.cart-qty');
            cartBox.removeClass('d-none');
            cartBox.find('.cart-qty-input').val(res.added_qty);
        });
    });

    // Inline Cart Quantity Controls
    $(document).on('click','.cart-plus',function(){
        let box = $(this).closest('.cart-qty');
        let input = box.find('.cart-qty-input');
        let product_id = $(this).closest('.product-card').find('.add-to-cart').data('id');

        $.post("{{ route('cart.increase') }}",{
            _token:"{{ csrf_token() }}",
            product_id: product_id
        },function(res){
            input.val(res.added_qty);
            if(res.remaining_qty>0) new bootstrap.Toast($('#stockToast')).show();
        });
    });

    $(document).on('click','.cart-minus',function(){
        let box = $(this).closest('.cart-qty');
        let input = box.find('.cart-qty-input');
        let product_id = $(this).closest('.product-card').find('.add-to-cart').data('id');

        $.post("{{ route('cart.decrease') }}",{
            _token:"{{ csrf_token() }}",
            product_id: product_id
        },function(res){
            input.val(res.added_qty);

            if(res.added_qty <= 0){
                // Hide cart box & enable initial quantity
                let card = box.closest('.product-card');
                box.addClass('d-none');
                let qtyBox = card.find('.qty-box');
                qtyBox.find('.qty-input').prop('readonly',false).val(1);
                qtyBox.find('.plus, .minus').prop('disabled',false);

                // Show modal confirmation
                let removedModal = new bootstrap.Modal($('#removedModal'));
                removedModal.show();
            }
        });
    });

});
</script>
<style>
.product-card{transition:all .3s ease; padding-bottom:20px;}
.product-card:hover{transform:translateY(-6px);}
.ribbon{
    position:relative;
    display:inline-block;
    color:#fff;
    font-weight:700;
    background:hotpink;
    padding:5px 15px;
    transform:rotate(-45deg);
    box-shadow:0 0 8px rgba(0,0,0,.2);
    margin:5px 0;
    font-size:.75rem;
}
.out-stock{
    background:#dc3545;
    color:#fff;
    font-size:.75rem;
    font-weight:700;
}
.qty-input{width:60px;}
.cart-qty-input{width:55px;}
</style>

@endsection
