@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold mb-4">🛒 Giỏ Hàng Của Bạn</h2>

    @if(session('cart') && count(session('cart')) > 0)
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-0">
                        <table class="table table-hover align-middle mb-0 text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th class="text-start">Tên món đồ</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach(session('cart') as $id => $details)
                                    @php $total += $details['price'] * $details['quantity']; @endphp
                                    <tr>
                                        <td>
                                            <img src="{{ $details['image'] ?? 'https://via.placeholder.com/150' }}" width="60" class="rounded shadow-sm">
                                        </td>
                                        <td class="text-start fw-bold text-primary">{{ $details['name'] }}</td>
                                        <td>{{ number_format($details['price'], 0, ',', '.') }}đ</td>
                                        
                                        <td>
                                            <form action="/cart/update" method="POST" class="d-flex align-items-center justify-content-center">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="id" value="{{ $id }}">
                                                <input type="number" name="quantity" value="{{ $details['quantity'] }}" class="form-control form-control-sm text-center me-1" style="width: 70px;" min="1">
                                                <button type="submit" class="btn btn-sm btn-info text-white" title="Cập nhật">🔄</button>
                                            </form>
                                        </td>
                                        
                                        <td class="text-danger fw-bold">
                                            {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}đ
                                        </td>
                                        
                                        <td>
                                            <form action="/cart/remove" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{ $id }}">
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Xóa món này">🗑️</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-4 mt-md-0">
                <div class="card shadow-sm border-0 bg-light">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">🧾 Hóa Đơn Tạm Tính</h5>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tạm tính:</span>
                            <span class="fw-bold">{{ number_format($total, 0, ',', '.') }}đ</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3 text-success">
                            <span>Giảm giá:</span>
                            <span>0đ</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4 fs-5">
                            <span class="fw-bold">Tổng cộng:</span>
                            <span class="fw-bold text-danger">{{ number_format($total, 0, ',', '.') }}đ</span>
                        </div>
                        <a href="/checkout" class="btn btn-primary w-100 fw-bold py-2 text-uppercase">Tiến Hành Thanh Toán 🚀</a>
                        <a href="/" class="btn btn-link w-100 text-decoration-none mt-2">⬅️ Tiếp tục mua sắm</a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <h1 class="text-muted" style="font-size: 5rem;">🛒</h1>
            <h4 class="text-muted mt-3">Giỏ hàng của bạn đang trống!</h4>
            <p>Vẻ như bạn chưa nhặt món đồ nhựa nào vào giỏ.</p>
            <a href="/" class="btn btn-primary fw-bold mt-2">Quay lại Cửa Hàng</a>
        </div>
    @endif
</div>
@endsection