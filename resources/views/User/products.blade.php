@extends('user.layout')
@section('content')

<div class="container my-5">

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
        @if($products->count() > 0)
            @foreach($products as $product)

            @php
                $onSale = $product->sale_percentage 
                          && $product->sale_start 
                          && $product->sale_end 
                          && now()->between($product->sale_start, $product->sale_end);

                $isNew = $product->newArrival;
                $isBest = $product->bestSeller;
            @endphp

            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product-card position-relative">

                    {{-- 🔹 Ribbon Badges --}}
                    @if($onSale)
                        <div class="ribbon sale">SALE</div>
                    @elseif($isBest)
                        <div class="ribbon best">BEST</div>
                    @elseif($isNew)
                        <div class="ribbon new">NEW</div>
                    @endif

                    <img src="{{ asset('products/'.$product->image) }}" alt="{{ $product->name }}">

                    <div class="p-3 text-center">
                        <h6 class="product-name">{{ ucfirst($product->name) }}</h6>
                        <p class="subcategory-name">{{ $product->subCategory->name ?? '' }}</p>

                        <div class="price">
                            @if($onSale)
                                <span class="sale-price">${{ number_format($product->sale_amount,2) }}</span>
                                <span class="old-price">${{ number_format($product->price,2) }}</span>
                            @else
                                <span class="normal-price">${{ number_format($product->price,2) }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
        @else
            <div class="col-12 text-center py-5 text-muted fs-5">
                No products available.
            </div>
        @endif
    </div>
</div>

{{-- 🔹 AJAX Subcategory Filter --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#subcategoryFilter').change(function() {
        let selected = $(this).val();

        $.ajax({
            url: "{{ route('user.products') }}",
            type: "GET",
            data: { subcategory_name: selected },
            success: function(res) {
                let newGrid = $(res).find('#productGrid').html();
                $('#productGrid').html(newGrid ?? '<div class="text-center py-5">No products found</div>');
            }
        });
    });
});
</script>

{{-- 🔹 Styling --}}
<style>
/* Card */
.product-card {
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.08);
    overflow: hidden;
    transition: all .3s ease;
}
.product-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 40px rgba(0,0,0,0.15);
}

/* Image */
.product-card img {
    width: 100%;
    height: 260px;
    object-fit: cover;
}

/* Text */
.product-name {
    font-size: 1.05rem;
    font-weight: 600;
    margin-bottom: 4px;
}
.subcategory-name {
    font-size: .85rem;
    color: #888;
    margin-bottom: 10px;
}

/* Price */
.price {
    font-size: 1.1rem;
}
.normal-price {
    font-weight: 700;
}
.sale-price {
    color: #198754;
    font-weight: 800;
    margin-right: 8px;
}
.old-price {
    color: #999;
    text-decoration: line-through;
}

/* Ribbon */
.ribbon {
    position: absolute;
    top: 16px;
    left: -40px;
    width: 140px;
    text-align: center;
    transform: rotate(-45deg);
    color: #fff;
    font-weight: 700;
    padding: 6px 0;
    font-size: .8rem;
}
.ribbon.sale { background: #dc3545; }
.ribbon.best { background: #0d6efd; }
.ribbon.new  { background: #198754; }
</style>

@endsection
