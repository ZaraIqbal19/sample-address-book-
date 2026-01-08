@extends('genie.genielayout')
@section('page-name', 'Orders')

@section('content')
<div class="container-fluid py-5" style="min-height:100vh; background:#f7f8fc;">

    {{-- Page Heading --}}
    <div class="text-center mb-4 wow fadeInDown">
        <h2 class="fw-bold" style="color:#0a0a0aff;">All Orders</h2>
        <p class="text-dark fw-bold text-large">Overview of all customer orders with details and status tracking</p>
    </div>

    {{-- Orders Table --}}
    <div class="table-responsive wow fadeInUp">
        <table class="table table-striped table-hover align-middle shadow-sm rounded border-0 bg-white">
            <thead class="text-uppercase" style="background:#1f1f1f; color:#fff;">
                <tr>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Email</th>
                    <th>Items</th>
                    <th>Subtotal</th>
                    <th>Discount</th>
                    <th>Tax</th>
                    <th>Total</th>
                    <th class="text-center">Payment</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                <tr class="align-middle m-3 p-2" style="border-bottom:2px solid #f0f0f0;">
                    <td class="fw-bold text-pink">{{ $order->order_number }}</td>
                    <td class="fw-bold text-uppercase text-dark">{{ $order->customer_name }}</td>
                    <td>{{ $order->customer_email }}</td>
                    <td>
                        <ul class="mb-0 ps-3 small">
                            @foreach (($orderItems[$order->order_id] ?? collect())->all() as $item)
                                <li title="{{ $item->product_name }}">
                                    <strong>{{ $item->product_name }}</strong> × {{ $item->quantity }} 
                                    (<span class="text-success">{{ number_format($item->price, 2) }} PKR</span>)
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ number_format($order->subtotal, 2) }} PKR</td>
                    <td class="text-danger">-{{ number_format($order->discount, 2) }} PKR</td>
                    <td>{{ number_format($order->tax, 2) }} PKR</td>
                    <td class="fw-bold text-pink">{{ number_format($order->total_amount, 2) }} PKR</td>
                    <td class="text-center">
                        @if($order->payment_method)
                            <span class="badge badge-payment bg-dark align-middle text-center text-white text-uppercase">{{ $order->payment_method }}</span>
                        @else
                            <span class="badge bg-secondary">N/A</span>
                        @endif
                    </td>
                    <td>
                        @php
                            $statusClass = match($order->status) {
                                'pending' => 'bg-warning text-dark px-3 py-2',
                                'processing' => 'bg-primary text-white px-3 py-2',
                                'completed' => 'bg-success text-white px-3 py-2',
                                'cancelled' => 'bg-danger text-white px-3 py-2',
                                default => 'bg-secondary text-white px-3 py-2',
                            };
                        @endphp
                        <span class="badge {{ $statusClass }} rounded-pill">{{ ucfirst($order->status) }}</span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y, h:i A') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="11" class="text-center text-muted py-4">No orders found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

{{-- STYLES --}}
<style>
/* Theme Colors */
.text-pink { color:#ff4f9a !important; }
.bg-pink { background-color:#ff4f9a !important; }

/* Table Styling */
.table th {
    font-size:0.95rem;
    letter-spacing:0.5px;
    padding:12px 10px;
}
.table td {
    font-size:0.9rem;
    padding:12px 8px;
}

/* Table header */
.table thead th {
    background:#1f1f1f !important;
    color:#fff !important;
}

/* Badge Payment */
.badge-payment {
    background: #010101ff;
    color: #fff;
    padding: 6px 12px;
    font-size: 0.9rem;
    border-radius: 30px;
    display:inline-block;
    min-width:70px;
}

/* Status Badges */
.badge {
    font-weight:600;
    font-size:0.85rem;
    text-transform:capitalize;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    transition: 0.3s;
}
.badge:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.12);
}

/* Table hover */
.table-hover tbody tr:hover {
    background-color: #fff0f7; /* subtle pink highlight */
    transition:0.3s;
}

/* Margin between rows */
.table tbody tr { margin-bottom:12px; display:table-row; }

/* Center text for payment method */
td.text-center { text-align:center; }

/* Responsive tweaks */
@media(max-width:768px){
    .table th, .table td { font-size:0.75rem; padding:8px 5px; }
}
</style>

{{-- SCRIPTS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
new WOW().init();

// Optional: tooltip for each item
$(function(){
    $('td ul li').tooltip({placement:'top'});
});
</script>

@endsection
