@extends('genie.genielayout')
@section('page-name', 'Product')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-8">

            <div class="card shadow border-0 rounded-4">
                <div class="card-header bg-primary text-black rounded-top-4">
                    <h5 class="mb-0 text-center text-white fw-bold text-uppercase">product uploading form</h5>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="/genie/product/store" enctype="multipart/form-data">
                        @csrf

<!-- Sub Category Dropdown -->
<div class="mb-3">
    <label class="form-label fw-semibold">Select Sub Category</label>
    <select name="sub_category_id" class="form-select" required>
        <option value="">-- Select Sub Category --</option>

        @foreach($subcategories as $subcategory)
            <option value="{{ $subcategory->id }}">
                {{ $subcategory->name }}
            </option>
        @endforeach

    </select>
</div>

                        <!-- Product Name -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Product Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter product name" required>
                        </div>

                        <!-- Product Image -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Product Image</label>
                            <input type="file" name="image" class="form-control" required>
                        </div>

                        <!-- Product Description -->
<div class="mb-3">
    <label class="form-label fw-semibold">Product Description</label>
    <textarea 
        name="description" 
        class="form-control" 
        rows="4"
        placeholder="Enter product description"
        required
    ></textarea>
</div>

                        <!-- Price -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Price</label>
                            <input type="number" name="price" id="price" class="form-control" placeholder="Enter price" required>
                        </div>

                        <!-- Sale Dates -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Sale Start Date</label>
                                <input type="date" name="sale_start" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Sale End Date</label>
                                <input type="date" name="sale_end" class="form-control">
                            </div>
                        </div>

                        <!-- Sale Info -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Sale Percentage (%)</label>
                                <input type="number" name="sale_percentage" id="sale_percentage"
                                       class="form-control" placeholder="e.g. 10">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Sale Amount</label>
                                <input type="number" name="sale_amount" id="sale_amount"
                                       class="form-control" placeholder="Auto calculated" readonly>
                            </div>
                        </div>

                        <!-- SKU -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">SKU</label>
                            <input type="text" name="sku" class="form-control" placeholder="Enter SKU" required>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Upload Product
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Auto Calculate Sale Amount -->
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const priceInput = document.getElementById('price');
        const percentageInput = document.getElementById('sale_percentage');
        const saleAmountInput = document.getElementById('sale_amount');

        function calculateSaleAmount() {
            let price = parseFloat(priceInput.value);
            let percentage = parseFloat(percentageInput.value);

            if (!isNaN(price) && !isNaN(percentage)) {
                let saleAmount = price - (price * percentage / 100) ;
                saleAmountInput.value = saleAmount.toFixed(2);
            } else {
                saleAmountInput.value = '';
            }
        }

        priceInput.addEventListener('input', calculateSaleAmount);
        percentageInput.addEventListener('input', calculateSaleAmount);
    });
</script>
@endsection
