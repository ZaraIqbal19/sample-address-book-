@extends('genie.genielayout')

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
                <th>Product</th>
                <th>Stock (SKU)</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        @foreach($vendors as $vendor)

            @forelse(optional($vendor->subcategory)->products ?? [] as $product)
                <tr>
                    <td>{{ $vendor->name }}</td>
                    <td>{{ $vendor->email }}</td>
                    <td>{{ $vendor->whatsapp_number }}</td>
                    <td>{{ ucfirst($vendor->subcategory->name) }}</td>
                    <td>{{ $product->name }}</td>

                    <td>
                        @if($product->sku > 0)
                            <span class="badge bg-success">{{ $product->sku }} Available</span>
                        @else
                            <span class="badge bg-danger">Out of Stock</span>
                        @endif
                    </td>

                    <td>
                        @if($product->sku <= 0)
                            <button class="btn btn-sm btn-warning">Notify Vendor</button>
                        @else
                            <button class="btn btn-sm btn-secondary" disabled>Stock OK</button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td>{{ $vendor->name }}</td>
                    <td>{{ $vendor->email }}</td>
                    <td>{{ $vendor->whatsapp_number }}</td>
                    <td colspan="4" class="text-center text-danger">
                        No Subcategory / Products
                    </td>
                </tr>
            @endforelse

        @endforeach
        </tbody>
    </table>

</div>
@endsection
