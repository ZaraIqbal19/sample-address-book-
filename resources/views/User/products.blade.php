{{-- resources/views/user/product.blade.php --}}
@extends('user.layout')

@section('content')

<div class="container py-5">

    {{-- Subcategory Filter --}}
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

    {{-- Product Grid --}}
    <div id="productGrid" class="row g-4">
        @foreach($products as $product)
        @php
            $today = \Carbon\Carbon::now();
            $onSale = $product->sale_start_date && $product->sale_end_date && 
                      $today->between($product->sale_start_date, $product->sale_end_date);
            $bestSeller = $product->bestSeller()->exists();
            $newArrival = $product->newArrival()->exists();
            $inWishlist = $product->isInWishlist(); // You can define this in Product model
        @endphp

        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card position-relative shadow-sm overflow-hidden h-100">

                {{-- Badges --}}
                <div class="position-absolute top-0 start-0 d-flex flex-column">
                    @if($onSale)
                        <div class="badge text-white fw-bold mb-1 sale-badge">Sale</div>
                    @endif
                    @if($bestSeller)
                        <div class="badge text-white fw-bold mb-1 best-badge">Best Seller</div>
                    @endif
                    @if($newArrival)
                        <div class="badge text-white fw-bold new-badge">New Arrival</div>
                    @endif
                </div>

                {{-- Out of Stock Badge --}}
                <div class="position-absolute top-0 end-0 m-2 out-stock d-none px-2 py-1 rounded fw-bold text-white bg-danger">Out of Stock</div>

                {{-- Product Image --}}
                <img src="{{ asset('products/'.$product->image) }}" class="card-img-top" style="height:250px; object-fit:cover;">

                {{-- Card Body --}}
                <div class="card-body text-center d-flex flex-column">

                    {{-- Product Name --}}
                    <h5 class="card-title fw-bold text-dark">{{ ucfirst($product->name) }}</h5>

                    {{-- Price --}}
                    <p class="card-text mb-2">
                        @if($onSale)
                            <span class="text-muted text-decoration-line-through">${{ number_format($product->price, 2) }}</span>
                            <span class="fw-bold text-danger ms-1">${{ number_format($product->sale_price, 2) }}</span>
                        @else
                            <span class="fw-bold">${{ number_format($product->price, 2) }}</span>
                        @endif
                    </p>

                    {{-- Quantity Selector --}}
                    <div class="d-flex justify-content-center align-items-center mb-2 qty-box" 
                        data-product="{{ $product->id }}" 
                        data-sku="{{ $product->sku }}">
                        <button class="btn btn-outline-dark btn-sm minus">−</button>
                        <input type="number" class="form-control text-center mx-1 qty-input" value="1" readonly style="width:60px;">
                        <button class="btn btn-outline-dark btn-sm plus">+</button>
                    </div>

                    {{-- Buttons --}}
                    <div class="d-flex flex-column gap-2">
                        <button class="btn btn-dark add-to-cart" data-product="{{ $product->id }}">Add to Cart</button>
                        <button class="btn btn-outline-secondary wishlist-btn" data-product="{{ $product->id }}">
                            {{ $inWishlist ? 'Remove from Wishlist' : 'Add to Wishlist' }}
                        </button>
                        <a href="{{ route('product.description', $product->id) }}" class="btn btn-outline-primary">View Details</a>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- Modal for messages --}}
<div class="modal fade" id="cartModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cart Update</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="cartModalBody"></div>
    </div>
  </div>
</div>

{{-- JS --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function(){

    function showModal(message){
        $('#cartModalBody').text(message);
        var modal = new bootstrap.Modal(document.getElementById('cartModal'));
        modal.show();
    }

    // Quantity plus
    $(document).on('click','.plus',function(){
        let box = $(this).closest('.qty-box');
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
            box.closest('.card').find('.out-stock').addClass('d-none'); 
        } else {
            input.val(sku);
            box.closest('.card').find('.out-stock').removeClass('d-none');
        }
    });

    // Quantity minus
    $(document).on('click','.minus',function(){
        let box = $(this).closest('.qty-box');
        let input = box.find('.qty-input');
        let product_id = box.data('product');
        let qty = parseInt(input.val());

        if(qty > 1){
            input.val(qty - 1);
            $.post("{{ route('cart.decrease') }}", {
                _token: "{{ csrf_token() }}",
                product_id: product_id
            });
            box.closest('.card').find('.out-stock').addClass('d-none');
        }
    });

    // Add to Cart button only triggers modal
    $(document).on('click','.add-to-cart',function(){
        let box = $(this).closest('.card').find('.qty-box');
        let qty = parseInt(box.find('.qty-input').val());
        let product_id = box.data('product');

        $.post("{{ route('cart.add') }}",{
            _token: "{{ csrf_token() }}",
            product_id: product_id,
            quantity: qty
        }, function(res){
            showModal('Added ' + res.added_qty + ' item(s) to cart');
            if(res.remaining_qty <= 0){
                box.closest('.card').find('.out-stock').addClass('d-none');
            }
        });
    });

    // Wishlist toggle
    $(document).on('click','.wishlist-btn',function(){
        let btn = $(this);
        let product_id = btn.data('product');

        $.post("{{ url('/wishlist/toggle') }}", {
            _token: "{{ csrf_token() }}",
            product_id: product_id
        }, function(res){
            if(res.added){
                btn.text('Remove from Wishlist').removeClass('btn-outline-secondary').addClass('btn-danger');
            } else {
                btn.text('Add to Wishlist').removeClass('btn-danger').addClass('btn-outline-secondary');
            }
        });
    });

    // Subcategory Filter
    $('#subcategoryFilter').change(function(){
        let val = $(this).val();
        let url = "{{ route('user.products') }}";
        if(val) url += '?subcategory_name=' + encodeURIComponent(val);
        window.location.href = url;
    });

});
</script>

{{-- CSS for badges --}}
<style>
/* Badge container */
.position-absolute.top-0.start-0 {
    display: flex;
    flex-direction: column;
    gap: 0.25rem; /* spacing between badges */
    padding: 0.5rem; /* some padding from top-left corner */
    z-index: 10;
}

/* Common badge styles */
.sale-badge,
.best-badge,
.new-badge {
    display: inline-block;
    padding: 0.25rem 0.6rem;
    font-size: 0.7rem;
    font-weight: 700;
    color: #fff;
    border-radius: 0.25rem;
    text-align: center;
    transform: rotate(-15deg);
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

/* Specific badge colors */
.sale-badge {
    background: #ff2a95;
}

.best-badge {
    background: #0d6efd;
}

.new-badge {
    background: #198754;
}

</style>

@endsection
