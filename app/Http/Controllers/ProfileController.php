<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Hiển thị trang thông tin cá nhân
    public function index()
    {
        // auth()->user() là ma thuật của Laravel giúp lấy ra toàn bộ thông tin của người đang đăng nhập
        $user = auth()->user(); 
        
        return view('profile.index', compact('user'));
    }
    // Mở Form chỉnh sửa thông tin
    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    // Nhận dữ liệu từ Form và lưu đè vào Database
    public function update(Request $request)
    {
        // 1. Kiểm tra dữ liệu khách nhập vào
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        // 2. Tìm tài khoản đang đăng nhập và Cập nhật
        $user = auth()->user();
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        // 3. Quay về trang Profile và báo thành công
        return redirect('/profile')->with('success', '🎉 Đã cập nhật thông tin cá nhân thành công!');
    }
}