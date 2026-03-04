<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{   
    // Hàm hiển thị Trang Chi tiết Giỏ hàng
    public function index()
    {
        // Lấy giỏ hàng từ Session ra (nếu không có thì trả về mảng rỗng)
        $cart = session()->get('cart', []);
        
        return view('cart.index', compact('cart'));
    }
    // Hàm xử lý khi khách bấm nút "Thêm Giỏ"
    public function add($id)
    {
        // 1. Tìm sản phẩm khách vừa bấm
        $product = Product::findOrFail($id);

        // 2. Lấy giỏ hàng hiện tại ra (nếu chưa có thì tạo giỏ rỗng [])
        $cart = session()->get('cart', []);

        // 3. Kiểm tra: Nếu món này đã có trong giỏ rồi thì cộng thêm 1
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } 
        // Nếu chưa có thì thêm mới vào giỏ
        else {
            // Lấy giá xả kho nếu có, không thì lấy giá gốc
            $price = $product->sale_price ? $product->sale_price : $product->price;

            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $price,
                "image" => $product->image
            ];
        }

        // 4. Cất giỏ hàng trở lại Session
        session()->put('cart', $cart);

        // 5. Đá khách về lại trang cũ kèm thông báo
        return back()->with('success', 'Đã nhặt ' . $product->name . ' vào giỏ hàng!');
    }
}