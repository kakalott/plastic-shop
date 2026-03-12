@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12 text-center bg-primary text-white p-5 rounded shadow-sm">
            <h1 class="fw-bold"> Tổng Kho Nhựa Gia Dụng</h1>
            <p class="fs-5">Chất lượng cao - Giá tận xưởng - Giao hàng toàn quốc</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white fw-bold">
                     Danh Mục Sản Phẩm
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="#" class="text-decoration-none text-dark">Rổ - Rá Nhựa</a></li>
                    <li class="list-group-item"><a href="#" class="text-decoration-none text-dark">Tủ Nhựa Đa Năng</a></li>
                    <li class="list-group-item"><a href="#" class="text-decoration-none text-dark">Ghế Nhựa</a></li>
                    <li class="list-group-item"><a href="#" class="text-decoration-none text-dark">Khay Đựng Tài Liệu</a></li>
                </ul>
            </div>
        </div>

        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold"> Sản Phẩm Nổi Bật</h4>
                <select class="form-select w-auto">
                    <option>Sắp xếp: Mới nhất</option>
                    <option>Giá: Thấp đến cao</option>
                    <option>Giá: Cao xuống thấp</option>
                </select>
            </div>

            <div class="row row-cols-1 row-cols-md-3 g-4">
                @forelse($products as $p)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0 product-card">
                        <img src="{{ $p->image ?? 'https://via.placeholder.com/300x300?text=No+Image' }}" class="card-img-top" alt="{{ $p->name }}" style="height: 220px; object-fit: cover;">
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold text-truncate" title="{{ $p->name }}">{{ $p->name }}</h5>
                            
                            <div class="mb-3">
                                @if($p->sale_price)
                                    <span class="text-danger fw-bold fs-5">{{ number_format($p->sale_price, 0, ',', '.') }}đ</span>
                                    <span class="text-muted text-decoration-line-through ms-2" style="font-size: 0.9rem;">{{ number_format($p->price, 0, ',', '.') }}đ</span>
                                @else
                                    <span class="text-danger fw-bold fs-5">{{ number_format($p->price, 0, ',', '.') }}đ</span>
                                @endif
                            </div>

                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <span class="text-muted" style="font-size: 0.85rem;">Kho: {{ $p->stock_quantity }}</span>
                                <a href="/cart/add/{{ $p->id }}" class="btn btn-outline-primary btn-sm fw-bold">🛒 Thêm Giỏ</a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-warning text-center">Hiện tại kho đang trống, chưa có sản phẩm nào để bán!</div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<style>
    .product-card { transition: transform 0.2s, box-shadow 0.2s; }
    .product-card:hover { transform: translateY(-5px); box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important; }
</style>
@endsection