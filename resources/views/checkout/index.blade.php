@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold mb-4"> Thanh Toán Đơn Hàng</h2>

    <form action="/checkout/process" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-7">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white fw-bold fs-5 border-bottom-0 pt-3">
                         Thông Tin Nhận Hàng
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Họ và Tên</label>
                                <input type="text" name="customer_name" class="form-control" value="{{ auth()->check() ? auth()->user()->name : '' }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Số điện thoại</label>
                                <input type="text" name="customer_phone" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-4 p-3 bg-light rounded border">
                            <label class="form-label fw-bold text-primary mb-3"> Hình thức nhận hàng (BOPIS)</label>
                            
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="shipping_method" id="ship_delivery" value="delivery" checked onchange="toggleAddress()">
                                <label class="form-check-label" for="ship_delivery">
                                    Giao hàng tận nhà (Cần nhập địa chỉ)
                                </label>
                            </div>
                            
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shipping_method" id="ship_bopis" value="bopis" onchange="toggleAddress()">
                                <label class="form-check-label fw-bold text-success" for="ship_bopis">
                                     Đến cửa hàng lấy (Buy Online, Pick-up In Store)
                                </label>
                            </div>
                        </div>

                        <div class="mb-3" id="address_box">
                            <label class="form-label fw-bold">Địa chỉ giao hàng chi tiết</label>
                            <textarea name="shipping_address" class="form-control" rows="3" placeholder="Số nhà, tên đường, phường/xã..."></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Ghi chú đơn hàng (Tùy chọn)</label>
                            <textarea name="notes" class="form-control" rows="2" placeholder="Giao giờ hành chính, gọi trước khi giao..."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card shadow-sm border-0 sticky-top" style="top: 20px;">
                    <div class="card-header bg-dark text-white fw-bold">
                         Tóm Tắt Đơn Hàng
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @php $total = 0; @endphp
                            @foreach(session('cart') as $details)
                                @php $total += $details['price'] * $details['quantity']; @endphp
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="fw-bold">{{ $details['name'] }}</span>
                                        <br>
                                        <small class="text-muted">SL: {{ $details['quantity'] }} x {{ number_format($details['price'], 0, ',', '.') }}đ</small>
                                    </div>
                                    <span class="fw-bold text-danger">{{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}đ</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer bg-white mt-2">
                        <div class="d-flex justify-content-between fs-5 mb-3 mt-2">
                            <span class="fw-bold">Tổng Thanh Toán:</span>
                            <span class="fw-bold text-danger fs-4">{{ number_format($total, 0, ',', '.') }}đ</span>
                        </div>
                        
                        <input type="hidden" name="total_amount" value="{{ $total }}">
                        
                        <button type="submit" class="btn btn-danger w-100 fw-bold py-3 fs-5">CHỐT ĐƠN HÀNG MUA NGAY</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function toggleAddress() {
        var isBopis = document.getElementById('ship_bopis').checked;
        var addressBox = document.getElementById('address_box');
        var addressInput = document.querySelector('textarea[name="shipping_address"]');
        
        if (isBopis) {
            addressBox.style.display = 'none';
            addressInput.removeAttribute('required'); // Không bắt buộc nhập địa chỉ nữa
        } else {
            addressBox.style.display = 'block';
            addressInput.setAttribute('required', 'required'); // Bắt buộc nhập lại
        }
    }
</script>
@endsection