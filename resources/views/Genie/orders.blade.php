@extends('genie.genielayout')
@section('page-name', 'Orders')
@section('content')
<div class="container-fluid py-5">
    <h2 class="mb-4 text-primary">All Orders</h2>
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle shadow-sm rounded">
            <thead class="table-dark">
                <tr>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Email</th>
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
                <tr>
                    <td class="fw-bold text-primary">{{ $order->order_number }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->customer_email }}</td>
                    <td>
                        <ul class="mb-0 ps-3">
                            @foreach (($orderItems[$order->order_id] ?? collect())->all() as $item)
                                <li>
                                    <strong>{{ $item->product_name }}</strong> x {{ $item->quantity }} 
                                    (<span class="text-success">{{ number_format($item->price, 2) }} PKR</span>)
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ number_format($order->subtotal, 2) }}</td>
                    <td>{{ number_format($order->discount, 2) }}</td>
                    <td>{{ number_format($order->tax, 2) }}</td>
                    <td class="fw-bold text-success">{{ number_format($order->total_amount, 2) }}</td>
                    <td>
                        @if($order->payment_method)
                            <span class="badge bg-info text-dark">{{ strtoupper($order->payment_method) }}</span>
                        @else
                            <span class="badge bg-secondary">N/A</span>
                        @endif
                    </td>
                    <td>
                        @php
                            $statusClass = match($order->status) {
                                'pending' => 'bg-warning text-dark',
                                'processing' => 'bg-primary text-white',
                                'completed' => 'bg-success text-white',
                                'cancelled' => 'bg-danger text-white',
                                default => 'bg-secondary text-white',
                            };
                        @endphp
                        <span class="badge {{ $statusClass }}">{{ ucfirst($order->status) }}</span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y, h:i A') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="11" class="text-center text-muted">No orders found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Optional: Add hover tooltip for each item --}}
@push('scripts')
<script>
document.querySelectorAll('td ul li').forEach(item => {
    item.setAttribute('title', item.textContent);
});
</script>
@endpush
@endsection
