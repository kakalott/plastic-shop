<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category; // Gọi Model Category
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        // 1. Lấy toàn bộ danh mục từ bảng categories để đổ ra Cột trái
        $categories = Category::all();
        
        // 2. Chuẩn bị câu lệnh lấy Sản phẩm
        $query = Product::where('stock_quantity', '>', 0);

        // 3. Xử lý TÌM KIẾM (Nếu khách có gõ vào ô tìm kiếm)
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Thực thi câu lệnh và lấy dữ liệu
        $products = $query->orderBy('id', 'desc')->get();
        
        // Gửi cả 2 biến $products và $categories ra ngoài Giao diện
        return view('home', compact('products', 'categories'));
    }
}