@extends('genie.genielayout')
@section('page-name', 'Vendor Show')
@section('content')
<div class="container my-5">
    <h3 class="mb-4">Vendors & Stock Overview</h3>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Vendor</th>
                <th>Email</th>
                <th>WhatsApp</th>
                <th>Subcategory</th>
                <th>Product Name</th>
                <th>Pieces Required</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        @foreach($vendors as $vendor)
            @if($vendor->subcategory && $vendor->subcategory->products->count() > 0)
                @foreach($vendor->subcategory->products as $product)
                    <tr>
                        <td>{{ $vendor->name }}</td>
                        <td>{{ $vendor->email }}</td>
                        <td>{{ $vendor->whatsapp_number }}</td>
                        <td>{{ $vendor->subcategory->name }}</td>
                        <td><input type="text" class="form-control form-control-sm" value="{{ $product->name }}"></td>
                        <td><input type="number" class="form-control form-control-sm" value="{{ $product->pieces_required ?? 0 }}"></td>
                        <td>
                            <button 
                                class="btn btn-sm btn-warning notify-btn" 
                                data-vendor="{{ $vendor->name }}" 
                                data-product="{{ $product->name }}" 
                                data-quantity="{{ $product->pieces_required ?? 0 }}">
                                Notify {{ $vendor->name }}
                            </button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td>{{ $vendor->name }}</td>
                    <td>{{ $vendor->email }}</td>
                    <td>{{ $vendor->whatsapp_number }}</td>
                    <td colspan="4" class="text-center text-danger">
                        No Subcategory / Products
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
</div>

<!-- JS for Notify Vendor popup -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.notify-btn');
        buttons.forEach(button => {
            button.addEventListener('click', function () {
                const vendor = this.dataset.vendor;
                const product = this.dataset.product;
                const quantity = this.dataset.quantity;

                alert(`Successfully sent to vendor ${vendor}!\nProduct: ${product}\nQuantity: ${quantity}`);
            });
        });
    });
</script>
@endsection
