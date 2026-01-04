@extends('genie.genielayout')
@section('content')

<div class="container py-5">

    {{-- 🔹 SUBCATEGORY FILTER --}}
    <form method="GET" class="mb-4">
        <div class="row justify-content-end">
            <div class="col-md-4">
                <select name="subcategory_name" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Filter by Sub Category --</option>
                    @foreach($subcategories as $subcategory)
                        <option value="{{ $subcategory->name }}"
                            {{ request('subcategory_name') == $subcategory->name ? 'selected' : '' }}>
                            {{ $subcategory->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    {{-- 🔹 PRODUCT TABLE --}}
    <div class="table-responsive shadow-sm rounded">
        <table class="table align-middle text-center mb-0" style="background-color:#f8f9fa;">
            <thead style="background-color:#343a40; color:#fff;">
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>SKU</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Sub Category</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
            @if($products->count() > 0)
                @foreach($products as $product)
                    @php
                        $onSale = $product->sale_percentage &&
                                  $product->sale_start &&
                                  $product->sale_end &&
                                  now()->between($product->sale_start, $product->sale_end);
                    @endphp
                    <tr>
                        {{-- Image --}}
                        <td>
                            <img src="{{ asset('products/'.$product->image) }}" width="60" class="rounded">
                        </td>

                        {{-- Name --}}
                        <td style="color:#343a40; font-weight:500;">
                            {{ $product->product_name }}
                        </td>

                        {{-- SKU --}}
                        <td>{{ $product->sku }}</td>

                        {{-- Price --}}
                        <td>
                            @if($onSale)
                                <span class="fw-bold text-success">
                                    ${{ number_format($product->sale_amount, 2) }}
                                </span>
                                <br>
                                <span class="text-muted text-decoration-line-through">
                                    ${{ number_format($product->price, 2) }}
                                </span>
                            @else
                                <span class="fw-bold">
                                    ${{ number_format($product->price, 2) }}
                                </span>
                            @endif
                        </td>

                        {{-- Status --}}
                        <td>
                            @if($onSale)
                                <span class="badge bg-success">On Sale</span>
                            @else
                                <span class="badge bg-secondary">Out of Sale</span>
                            @endif
                        </td>

                        {{-- Sub Category --}}
                        <td>{{ $product->subCategory->name ?? 'N/A' }}</td>

                        {{-- Actions --}}
                        <td class="d-flex justify-content-center gap-2">
                            <button type="button"
                                    class="btn btn-sm"
                                    style="background:#ff2f92; color:white; font-weight:500; transition:0.3s;"
                                    onmouseover="this.style.background='#e0267f'"
                                    onmouseout="this.style.background='#ff2f92'"
                                    data-id="{{ $product->id }}"
                                    onclick="toggleNewArrival(this)">
                                {{ $product->newArrival ? 'Remove New Arrival' : 'Add New Arrival' }}
                            </button>

                            <button type="button"
                                    class="btn btn-sm"
                                    style="background:#ff2f92; color:white; font-weight:500; transition:0.3s;"
                                    onmouseover="this.style.background='#e0267f'"
                                    onmouseout="this.style.background='#ff2f92'"
                                    data-id="{{ $product->id }}"
                                    onclick="toggleBestSeller(this)">
                                {{ $product->bestSeller ? 'Remove Best Seller' : 'Add Best Seller' }}
                            </button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        No product is added in this subcategory yet.
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>

</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
function toggleNewArrival(btn) {
    let productId = btn.getAttribute('data-id');
    $.post('/genie/new-arrival/toggle', {_token: '{{ csrf_token() }}', product_id: productId}, function(res){
        btn.textContent = res.status === 'added' ? 'Remove New Arrival' : 'Add New Arrival';
    });
}

function toggleBestSeller(btn) {
    let productId = btn.getAttribute('data-id');
    $.post('/genie/best-seller/toggle', {_token: '{{ csrf_token() }}', product_id: productId}, function(res){
        btn.textContent = res.status === 'added' ? 'Remove Best Seller' : 'Add Best Seller';
    });
}
</script>
@endpush

@endsection
