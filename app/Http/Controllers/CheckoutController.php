<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    // Hàm mở trang Giao diện Thanh toán
    public function index()
    {
        $cart = session()->get('cart', []);
        
        // Nếu giỏ hàng trống mà khách cố tình vào trang này thì đuổi về lại giỏ hàng
        if(empty($cart)) {
            return redirect('/cart')->with('success', 'Giỏ hàng của bạn đang trống!');
        }

        return view('checkout.index', compact('cart'));
    }
}