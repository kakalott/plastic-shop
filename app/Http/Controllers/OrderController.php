<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Hàm 1: Liệt kê toàn bộ đơn hàng
    public function index()
    {
        // Lấy đơn hàng mới nhất xếp lên đầu
        $orders = Order::orderBy('id', 'desc')->get();
        return view('orders.index', compact('orders'));
    }

    // Hàm 2: Cập nhật trạng thái đơn hàng (Đang xử lý -> Đã giao)
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return back()->with('success', 'Đã cập nhật trạng thái Đơn hàng #' . $id);
    }
}