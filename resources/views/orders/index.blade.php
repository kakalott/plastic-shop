@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold mb-4"> Quản Lý Đơn Hàng</h2>

    @if(session('success'))
        <div class="alert alert-success fw-bold">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-hover table-bordered align-middle mb-0 text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Mã Đơn</th>
                        <th>Kênh Bán</th>
                        <th>Tổng Tiền</th>
                        <th>Ngày Đặt</th>
                        <th>Trạng Thái</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td class="fw-bold text-primary">#{{ $order->id }}</td>
                        <td>
                            @if($order->order_channel == 'WEB')
                                <span class="badge bg-info text-dark">Khách đặt WEB</span>
                            @else
                                <span class="badge bg-secondary">Tại quầy POS</span>
                            @endif
                        </td>
                        <td class="text-danger fw-bold">{{ number_format($order->total_amount, 0, ',', '.') }}đ</td>
                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <form action="/admin/orders/{{ $order->id }}/status" method="POST" class="d-flex justify-content-center">
                                @csrf
                                @method('PUT')
                                <select name="status" class="form-select form-select-sm w-auto me-2" onchange="this.form.submit()">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>⏳ Chờ xử lý</option>
                                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>📦 Đang đóng gói</option>
                                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>🚚 Đang giao</option>
                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>✅ Hoàn thành</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>❌ Đã hủy</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <a href="#" class="btn btn-sm btn-outline-primary"> Xem chi tiết</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-muted py-4">Chưa có đơn hàng nào trong hệ thống.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection