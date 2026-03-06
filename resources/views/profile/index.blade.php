@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white fw-bold text-center py-3">
                    👤 THÔNG TIN TÀI KHOẢN
                </div>
                <div class="card-body text-center mt-3">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&color=fff&size=128" class="rounded-circle mb-3 shadow-sm border border-3 border-light">
                    
                    <h3 class="fw-bold text-primary">{{ $user->name }}</h3>
                    
                    <div class="mt-4 text-start px-md-5">
                        <p class="fs-5 border-bottom pb-2"><strong>📧 Email:</strong> {{ $user->email }}</p>
                        <p class="fs-5 border-bottom pb-2">
                            <strong>🏷️ Phân quyền:</strong> 
                            @if($user->role == 'admin') 
                                <span class="badge bg-danger fs-6">Quản trị viên (Admin)</span>
                            @elseif($user->role == 'employee')
                                <span class="badge bg-warning text-dark fs-6">Nhân viên cửa hàng</span>
                            @else 
                                <span class="badge bg-success fs-6">Khách hàng thành viên</span>
                            @endif
                        </p>
                        <p class="fs-5 pb-2"><strong>📅 Ngày tham gia:</strong> {{ $user->created_at->format('d/m/Y') }}</p>
                    </div>

                    <div class="mt-4">
                        <a href="/" class="btn btn-outline-primary fw-bold px-4">⬅️ Trở về Cửa Hàng</a>
                        <a href="#" class="btn btn-primary fw-bold px-4"> Đơn hàng của tôi </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection