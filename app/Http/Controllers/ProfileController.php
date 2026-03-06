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
}