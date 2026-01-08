@extends('user.layout')
@section('page-name', 'My Orders')

@section('content')
<div class="container py-5">

    {{-- Page Heading --}}
    <div class="mb-4 text-center">
        <h2 class="fw-bold text-white mb-2">My Orders</h2>
        <p class="text-white mb-0">
            Review your past purchases, payment details, and order status.
        </p>
    </div>

    <div class="table-responsive wow fadeInUp">
        <table class="table align-middle order-table shadow-sm rounded">

            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Items</th>
                    <th>Subtotal</th>
                    <th>Discount</th>
                    <th>Tax</th>
                    <th>Total</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>
            @forelse ($orders as $order)
                <tr class="order-row">

                    {{-- Order Number --}}
                    <td class="fw-semibold text-dark">
                        {{ $order->order_number }}
                    </td>

                    {{-- Items --}}
                    <td>
                        <ul class="mb-0 ps-3 small">
                            @forelse (($orderItems[$order->id] ?? collect()) as $item)
                                <li class="mb-1">
                                    <span class="fw-medium text-dark">
                                        {{ $item->product_name }}
                                    </span>
                                    × {{ $item->quantity }}
                                    <span class="text-muted">
                                        ({{ number_format($item->price, 2) }} PKR)
                                    </span>
                                </li>
                            @empty
                                <li class="text-muted fst-italic">No items found</li>
                            @endforelse
                        </ul>
                    </td>

                    {{-- Pricing --}}
                    <td>{{ number_format($order->subtotal, 2) }} PKR</td>

                    <td class="text-danger">
                        -{{ number_format($order->discount, 2) }} PKR
                    </td>

                    <td>{{ number_format($order->tax, 2) }} PKR</td>

                    <td class="fw-bold text-dark">
                        {{ number_format($order->total_amount, 2) }} PKR
                    </td>

                    {{-- Payment --}}
                    <td>
                        <span class="badge badge-payment">
                            {{ strtoupper($order->payment_method ?? 'N/A') }}
                        </span>
                    </td>

                    {{-- Status --}}
                    <td>
                        @php
                            $statusStyles = [
                                'pending' => ['Order Placed', 'badge-pending'],
                                'processing' => ['Processing', 'badge-processing'],
                                'completed' => ['Delivered', 'badge-completed'],
                                'cancelled' => ['Cancelled', 'badge-cancelled'],
                            ];
                            [$label, $class] = $statusStyles[$order->status] ?? ['Unknown', 'badge-secondary'];
                        @endphp

                        <span class="badge {{ $class }}">
                            {{ $label }}
                        </span>
                    </td>

                    {{-- Date --}}
                    <td class="small text-muted">
                        {{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}<br>
                        {{ \Carbon\Carbon::parse($order->created_at)->format('h:i A') }}
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center py-5 text-muted">
                        You haven’t placed any orders yet.
                    </td>
                </tr>
            @endforelse
            </tbody>

        </table>
    </div>
</div>

{{-- ================= STYLES ================= --}}
<style>
.order-table {
    border-collapse: separate;
    border-spacing: 0 10px;
}

.order-table thead th {
    background: #111;
    color: #fff;
    font-weight: 500;
    font-size: 1.05rem;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    border: none;
    padding: 14px;
    align-items: center;
    text-align: center;
}

.order-table tbody tr {
    background: #fff;
    transition: 0.3s ease;
}

.order-table tbody tr:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

.order-table td {
    padding: 14px;
    font-size: 0.9rem;
    border-top: none;
}

/* Payment Badge */
.badge-payment {
    background: #f1f1f1;
    color: #333;
    padding: 6px 10px;
    font-size: 1.05rem;
    border-radius: 30px;
}

/* Status Badges */
.badge {
    padding: 6px 12px;
    font-size: 0.7rem;
    border-radius: 30px;
}

.badge-pending {
    background: linear-gradient(135deg, #f6d365, #fda085);
    color: #000;
}

.badge-processing {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: #fff;
}

.badge-completed {
    background: linear-gradient(135deg, #11998e, #38ef7d);
    color: #fff;
}

.badge-cancelled {
    background: linear-gradient(135deg, #ff512f, #dd2476);
    color: #fff;
}
</style>

{{-- ================= ANIMATION ================= --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script>
    new WOW().init();

    // subtle row fade on load
    $(document).ready(function () {
        $('.order-row').each(function (i) {
            $(this).delay(80 * i).fadeIn(400);
        });
    });
</script>
@endsection
