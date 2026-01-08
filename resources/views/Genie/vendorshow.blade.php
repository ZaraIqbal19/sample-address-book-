@extends('genie.genielayout')
@section('page-name', 'Vendor Show')

@section('content')
<div class="container-fluid py-5" style="background:#f7f8fc; min-height:100vh;">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-semibold mb-0" style="color:#2b2b2b;">
            Vendors & Stock Overview
        </h3>
        <span class="badge rounded-pill bg-dark px-3 py-2">
            Live Stock Status
        </span>
    </div>

    <!-- Card Wrapper -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">

            <div class="table-responsive">
                <table class="table align-middle table-hover mb-0">
                    <thead class="shiny-black text-white">
                        <tr>
                            <th>Vendor</th>
                            <th>Email</th>
                            <th>WhatsApp</th>
                            <th>Subcategory</th>
                            <th>Product</th>
                            <th width="140">Qty Required</th>
                            <th width="180">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($vendors as $vendor)
                        @if($vendor->subcategory && $vendor->subcategory->products->count())
                            @foreach($vendor->subcategory->products as $product)
                                <tr class="vendor-row">

                                    <td class="fw-semibold text-uppercase">
                                        {{ $vendor->name }}
                                    </td>

                                    <td class="text-muted small">
                                        {{ $vendor->email }}
                                    </td>

                                    <td class="text-muted">
                                        {{ $vendor->whatsapp_number }}
                                    </td>

                                    <td>
                                        <span class="badge bg-light text-dark border">
                                            {{ $vendor->subcategory->name }}
                                        </span>
                                    </td>

                                    <td>
                                        <input type="text"
                                               class="form-control form-control-sm"
                                               value="{{ $product->name }}"
                                               readonly>
                                    </td>

                                    <td>
                                        <input type="number"
                                               class="form-control form-control-sm quantity-input text-center"
                                               value="{{ $product->pieces_required ?? 0 }}">
                                    </td>

                                    <td>
                                        <button
                                            class="btn btn-outline-success btn-sm notify-btn w-100"
                                            data-vendor="{{ $vendor->name }}"
                                            data-phone="92{{ ltrim($vendor->whatsapp_number, '0') }}"
                                            data-subcategory="{{ $vendor->subcategory->name }}"
                                            data-product="{{ $product->name }}">
                                            <i class="bi bi-whatsapp me-1"></i>
                                            Notify
                                        </button>
                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <tr class="table-warning">
                                <td class="fw-semibold text-uppercase">{{ $vendor->name }}</td>
                                <td>{{ $vendor->email }}</td>
                                <td>{{ $vendor->whatsapp_number }}</td>
                                <td colspan="4" class="text-center text-danger">
                                    No Subcategory / Products Found
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<!-- Animations + Notify Logic -->
<script>
$(document).ready(function () {

    // Row fade-in animation
    $('.vendor-row').each(function (i) {
        $(this).delay(i * 40).animate({ opacity: 1 }, 250);
    });

    // Hover highlight
    $('.vendor-row').hover(
        function () {
            $(this).addClass('table-active');
        },
        function () {
            $(this).removeClass('table-active');
        }
    );

    // Notify vendor
    $('.notify-btn').on('click', function () {

        const row = $(this).closest('tr');
        const quantity = row.find('.quantity-input').val();

        const vendor = $(this).data('vendor');
        const phone = $(this).data('phone');
        const subcategory = $(this).data('subcategory');
        const product = $(this).data('product');

        const message = `
Hello ${vendor},

Subcategory: ${subcategory}
Product: ${product}
Required Quantity: ${quantity} pieces

Please arrange this as soon as possible.
Thank you.
        `.trim();

        const whatsappUrl = `https://wa.me/${phone}?text=${encodeURIComponent(message)}`;
        window.open(whatsappUrl, '_blank');
    });

});
</script>

<style>
    .shiny-black {
    background: linear-gradient(
        180deg,
        #2a2a2a 0%,
        #000000 50%,
        #1a1a1a 100%
    );
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.15),
                inset 0 -1px 0 rgba(0,0,0,0.8);
}

.shiny-black th {
    border-color: rgba(255,255,255,0.08);
    padding: 14px 12px;
    font-weight: 600;
    letter-spacing: 0.5px;
}

.vendor-row {
    opacity: 0;
}

.quantity-input {
    border-radius: 8px;
    font-weight: 500;
}

.notify-btn {
    border-radius: 10px;
    transition: all .25s ease;
}

.notify-btn:hover {
    transform: translateY(-2px);
}
</style>

@endsection
