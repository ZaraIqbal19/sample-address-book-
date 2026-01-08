@extends('user.layout')

@section('content')

<div class="container py-5">

    {{-- INFO / INTRODUCTION --}}
  <div class="text-center mb-6 fadeInDown">
    <h1 class="fw-bold text-uppercase text-white m-2" style="letter-spacing: 1px; line-height: 1.2;">
        Where Style Meets Sophistication
    </h1>
    <h4 class="text-white m-4 fw-light" style="font-weight: 300; letter-spacing: 0.5px;">
        Highlights fashion, quality, and exclusivity
    </h4>
    <p class="text-white fs-5 mx-auto" style="max-width: 90ch; line-height:1.8; letter-spacing: 0.5px;">
        Discover elegance and beauty with our exclusive collection of premium cosmetics and handcrafted jewellery. 
        From timeless jewellery pieces to vibrant cosmetic essentials, we ensure quality, style, and sophistication 
        for every occasion. Explore, indulge, and add a touch of luxury to your lifestyle with us.
    </p>
    <hr class="mx-auto my-4" style="width:120px; border-top:4px solid #ff2a95; border-radius:2px;">
</div>


    {{-- Subcategory Filter --}}
    <div class="row mb-5 mt-4">
        <div class="col-md-4 ms-auto wow fadeInRight">
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
        @endphp

        <div class="col-lg-4 col-md-6 col-sm-6 wow fadeInUp">
            <div class="card position-relative shadow-sm overflow-hidden h-100 product-card">

     {{-- Diagonal Ribbons --}}
@if($onSale)
<div class="badge" 
     style="position:absolute; top:10px; left:-35px; width:170px; text-align:center; 
            background:#ff2a95; color:#fff; font-weight:bold; font-size:0.8rem; 
            padding:0.25rem 0; transform:rotate(-45deg); z-index:10; box-shadow:0 2px 5px rgba(0,0,0,0.2);">
    Sale
</div>
@endif

@if($bestSeller)
<div class="badge" 
     style="position:absolute; top:50px; left:-35px; width:170px; text-align:center; 
            background:#0d6efd; color:#fff; font-weight:bold; font-size:0.8rem; 
            padding:0.25rem 0; transform:rotate(-45deg); z-index:10; box-shadow:0 2px 5px rgba(0,0,0,0.2);">
    Best Seller
</div>
@endif

@if($newArrival)
<div class="badge" 
     style="position:absolute; top:90px; left:-35px; width:170px; text-align:center; 
            background:#198754; color:#fff; font-weight:bold; font-size:0.8rem; 
            padding:0.25rem 0; transform:rotate(-45deg); z-index:10; box-shadow:0 2px 5px rgba(0,0,0,0.2);">
    New Arrival
</div>
@endif


                <!-- <div class="position-absolute top-0 start-0 d-flex flex-column gap-1 p-2 z-10">
                    @if($onSale)
                        <div class="badge sale-badge">Sale</div>
                    @endif
                    @if($bestSeller)
                        <div class="badge best-badge">Best Seller</div>
                    @endif
                    @if($newArrival)
                        <div class="badge new-badge">New Arrival</div>
                    @endif
                </div> -->

                {{-- Out of Stock Overlay --}}
                @if($product->sku <= 0)
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center out-stock-overlay">
                        <span class="fw-bold text-white fs-5">Out of Stock</span>
                    </div>
                @endif

                {{-- Product Image --}}
                <img src="{{ asset('products/'.$product->image) }}" 
                     class="card-img-top product-img" 
                     style="height:250px; object-fit:cover;" 
                     alt="{{ $product->name }}">

                {{-- Card Body --}}
                <div class="card-body text-center d-flex flex-column justify-content-between">

                    {{-- Product Name --}}
                    <h5 class="card-title fw-bold text-dark mb-2">{{ ucfirst($product->name) }}</h5>

                    {{-- Price --}}
                    <p class="card-text mb-2">
                        @if($onSale)
                            <span class="text-muted text-decoration-line-through">${{ number_format($product->price,2) }}</span>
                            <span class="fw-bold text-danger ms-1">${{ number_format($product->sale_price,2) }}</span>
                        @else
                            <span class="fw-bold text-dark">${{ number_format($product->price,2) }}</span>
                        @endif
                    </p>

                    {{-- Quantity Selector --}}
                    <div class="d-flex justify-content-center align-items-center mb-2 qty-box" 
                        data-product="{{ $product->id }}" 
                        data-sku="{{ $product->sku }}">
                        <button class="btn btn-outline-accent btn-sm minus">−</button>
                        <input type="number" class="form-control text-center mx-1 qty-input" value="1" readonly style="width:60px;">
                        <button class="btn btn-outline-accent btn-sm plus">+</button>
                    </div>

                    {{-- Buttons --}}
                    <div class="d-flex flex-column gap-2">
                        <button class="btn btn-accent add-to-cart" data-product="{{ $product->id }}">Add to Cart</button>
                        <a href="{{ route('product.description', $product->id) }}" class="btn btn-outline-dark">View Details</a>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<hr>

{{-- JS --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>

<script>
$(document).ready(function(){

    new WOW().init();

    // Quantity plus
    $(document).on('click','.plus',function(){
        let box = $(this).closest('.qty-box');
        let input = box.find('.qty-input');
        let sku = parseInt(box.data('sku'));
        let qty = parseInt(input.val());

        if(qty < sku){
            input.val(qty + 1);
            box.closest('.card').find('.out-stock-overlay').fadeOut();
        } else {
            input.val(sku);
            box.closest('.card').find('.out-stock-overlay').fadeIn();
        }
    });

    // Quantity minus
    $(document).on('click','.minus',function(){
        let box = $(this).closest('.qty-box');
        let input = box.find('.qty-input');
        let qty = parseInt(input.val());

        if(qty > 1){
            input.val(qty - 1);
            box.closest('.card').find('.out-stock-overlay').fadeOut();
        }
    });

    // Add to Cart
    $(document).on('click','.add-to-cart',function(){
        let box = $(this).closest('.card').find('.qty-box');
        let qty = parseInt(box.find('.qty-input').val());
        let product_id = box.data('product');

        $.post("{{ route('cart.add') }}",{
            _token: "{{ csrf_token() }}",
            product_id: product_id,
            quantity: qty
        }, function(res){
            // Use alert instead of modal
            alert('Added ' + res.added_qty + ' item(s) to cart');
            if(res.remaining_qty <= 0){
                box.closest('.card').find('.out-stock-overlay').fadeIn();
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

{{-- CSS --}}
<style>
/* Product Card Hover */
.product-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 25px rgba(0,0,0,0.15);
}
.product-img {
    transition: transform 0.3s ease;
}
.product-card:hover .product-img {
    transform: scale(1.05);
}

/* Buttons */
.btn-outline-accent {
    color: #ff2a95;
    border-color: #ff2a95;
    transition: all 0.3s;
}
.btn-outline-accent:hover {
    color: #fff;
    background-color: #ff2a95;
    border-color: #ff2a95;
}
.btn-accent {
    background-color: #ff2a95;
    color: #fff;
    transition: 0.3s;
}
.btn-accent:hover {
    background-color: #d31876;
    color: #fff;
}

/* Badges */
.sale-badge, .best-badge, .new-badge {
    display: inline-block;
    padding: 0.4rem 0.8rem;
    font-size: 0.75rem;
    font-weight: 700;
    border-radius: 0.35rem;
    text-align: center;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    color: #fff;
}
.sale-badge { background: #ff2a95; transform: rotate(-10deg); }
.best-badge { background: #0d6efd; transform: rotate(-10deg); }
.new-badge { background: #198754; transform: rotate(-10deg); }

/* Out of Stock Overlay */
.out-stock-overlay {
    background: rgba(0,0,0,0.6);
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 0.25rem;
    z-index: 9;
    font-size: 1rem;
}

/* Quantity Input */
.qty-input {
    font-weight: 500;
    border-radius: 5px;
    padding: 5px;
}

/* Responsive */
@media (max-width:767px){
    .product-img { height:200px; }
}
</style>

@endsection
