@extends('genie.genielayout')
@section('content')

{{-- 🔹 SUBCATEGORY FILTER --}}
<form method="GET" class="mb-3">
    <div class="row justify-content-end">
        <div class="col-md-4">
            <select name="subcategory_name"
                    class="form-select"
                    onchange="this.form.submit()">
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
<table class="table table-bordered align-middle text-center">
    <thead class="table-dark">
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
                $onSale =
                    $product->sale_percentage &&
                    $product->sale_start &&
                    $product->sale_end &&
                    now()->between($product->sale_start, $product->sale_end);
            @endphp

            <tr>
                {{-- Image --}}
                <td>
                    <img src="{{ asset('products/'.$product->image) }}"
                         width="60" class="rounded">
                </td>

                {{-- Name --}}
                <td style="color:black;background-color:black">
                    <p>{{ $product->product_name }}</p>
                </td>

                {{-- SKU --}}
                <td>{{ $product->sku }}</td>

                {{-- Price --}}
                <td>
                    @if($onSale)
                        <span class="fw-bold text-success">
                            {{ number_format($product->sale_amount, 2) }}
                        </span>
                        <br>
                        <span class="text-muted text-decoration-line-through">
                            {{ number_format($product->price, 2) }}
                        </span>
                    @else
                        <span class="fw-bold">
                            {{ number_format($product->price, 2) }}
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
                <td>
                    {{ $product->subCategory->name ?? 'N/A' }}
                </td>

                {{-- Actions --}}
                <td>
                    {{-- ✅ NEW ARRIVAL --}}
                    <button
                        class="btn btn-sm btn-info mb-1 toggle-new-arrival"
                        data-id="{{ $product->id }}">
                        {{ $product->newArrival ? 'Remove New Arrival' : 'Add New Arrival' }}
                    </button>

                    {{-- ✅ BEST SELLER --}}
                    <button
                        class="btn btn-sm btn-warning toggle-best-seller"
                        data-id="{{ $product->id }}">
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

{{-- 🔹 AJAX --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).on('click', '.toggle-new-arrival', function () {
    let btn = $(this);

    $.ajax({
        url: '/genie/new-arrival/toggle',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            product_id: btn.data('id')
        },
        success: function (res) {
            btn.text(
                res.status === 'added'
                    ? 'Remove New Arrival'
                    : 'Add New Arrival'
            );
        }
    });
});

$(document).on('click', '.toggle-best-seller', function () {
    let btn = $(this);

    $.ajax({
        url: '/genie/best-seller/toggle',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            product_id: btn.data('id')
        },
        success: function (res) {
            btn.text(
                res.status === 'added'
                    ? 'Remove Best Seller'
                    : 'Add Best Seller'
            );
        }
    });
});
</script>

@endsection
