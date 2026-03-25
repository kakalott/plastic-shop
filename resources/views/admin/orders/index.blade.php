@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">📦 Quản Lý Đơn Hàng</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success fw-bold">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0 table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="px-3">Mã Đơn</th>
                        <th>Khách Hàng</th>
                        <th>Thanh Toán</th>
                        <th>Tổng Tiền</th>
                        <th>Ngày Đặt</th>
                        <th width="200">Trạng Thái</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td class="px-3 fw-bold text-primary">#{{ $order->id }}</td>
                        <td>
                            <strong>{{ $order->customer_name }}</strong><br>
                            <small class="text-muted">SĐT {{ $order->customer_phone }}</small>
                        </td>
                        <td>
                            @if($order->payment_method == 'ONLINE')
                                <span class="badge bg-primary">ONLINE (Chuyển khoản)</span>
                            @else
                                <span class="badge bg-secondary"> COD (Nhận hàng)</span>
                            @endif
                        </td>
                        <td class="fw-bold text-danger fs-5">{{ number_format($order->total_amount, 0, ',', '.') }}đ</td>
                        <td><small class="text-muted">{{ $order->created_at->format('d/m/Y H:i') }}</small></td>
                        
                        <td>
                            <form action="/admin/orders/{{ $order->id }}/status" method="POST" class="d-flex">
                                @csrf
                                <select name="status" class="form-select form-select-sm fw-bold shadow-sm 
                                    {{ $order->status == 'unpaid' ? 'border-danger text-danger' : 
                                      ($order->status == 'pending' ? 'border-warning text-dark' : 
                                      ($order->status == 'completed' ? 'border-success text-success' : '')) }}" 
                                    onchange="this.form.submit()">
                                    
                                    <option value="unpaid" {{ $order->status == 'unpaid' ? 'selected' : '' }}>Chưa thanh toán</option>
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}> Chờ xử lý (COD)</option>
                                    <option value="shipping" {{ $order->status == 'shipping' ? 'selected' : '' }}> Đang giao hàng</option>
                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}> Đã hoàn thành</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}> Đã hủy</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted fst-italic">Chưa có đơn hàng nào trong hệ thống!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection