@if($products->count() > 0)
    @foreach($products as $product)
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="card h-100 shadow-sm border-0 rounded-4 product-card">
            <div class="position-relative">
                <img src="{{ asset('products/'.$product->image) }}" class="card-img-top rounded-top-4" style="height:200px; object-fit:cover;">
                @if($product->sale_percentage && $product->sale_start && $product->sale_end && now()->between($product->sale_start, $product->sale_end))
                <span class="badge bg-danger position-absolute top-0 start-0 m-2">On Sale</span>
                @endif
            </div>
            <div class="card-body text-center">
                <h6 class="card-title fw-bold">{{ $product->name }}</h6>
                <p class="text-muted mb-1">{{ $product->subCategory->name ?? '' }}</p>
                @php
                    $onSale = $product->sale_percentage && $product->sale_start && $product->sale_end && now()->between($product->sale_start, $product->sale_end);
                @endphp
                <p class="mb-0">
                    @if($onSale)
                        <span class="fw-bold text-success">${{ number_format($product->sale_amount, 2) }}</span>
                        <span class="text-muted text-decoration-line-through">${{ number_format($product->price, 2) }}</span>
                    @else
                        <span class="fw-bold">${{ number_format($product->price, 2) }}</span>
                    @endif
                </p>
            </div>
        </div>
    </div>
    @endforeach
@else
    <div class="col-12 text-center py-5 text-muted">
        No product is added in this subcategory yet.
    </div>
@endif

{{-- 🔹 Hover effect --}}
<style>
.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
}
</style>
