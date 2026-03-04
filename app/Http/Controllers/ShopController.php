<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    // Hàm hiển thị Trang chủ & Danh mục
    public function index()
    {
        // Chỉ lấy ra các sản phẩm còn hàng (stock > 0), sắp xếp mới nhất lên đầu
        $products = Product::where('stock_quantity', '>', 0)->orderBy('id', 'desc')->get();
        
        return view('home', compact('products'));
    }
}