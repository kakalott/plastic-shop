<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Nhúng model Product vào
use App\Models\Category;
class ProductController extends Controller
{
    // Hàm 1: Hiển thị giao diện Form thêm mới
    public function create()
    {
        // Lấy toàn bộ danh mục từ Database ra
        $categories = Category::all();
        
        // Ném sang bên giao diện Form
        return view('products.create', compact('categories'));
    }
    // Hàm 2: Nhận dữ liệu từ Form và lưu vào Database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'category_id' => 'required|integer' // Bắt buộc phải chọn danh mục
        ]);

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'stock_quantity' => $request->stock_quantity,
            'image' => $request->image,
            'category_id' => $request->category_id, // Lưu ID danh mục vào DB
            'description' => $request->description,
        ]);

        return redirect('/admin/products')->with('success', '📦 Đã thêm sản phẩm mới thành công!');
    }
    // Bổ sung Hàm 3: Hiển thị danh sách sản phẩm
    public function index()
    {
        // Lấy tất cả sản phẩm, sắp xếp cái nào mới thêm lên đầu
        $products = Product::orderBy('id', 'desc')->get();
        return view('products.index', compact('products'));
    }
    // Bổ sung Hàm 4: Xóa sản phẩm
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        
        return back()->with('success', 'Đã xóa sản phẩm thành công!');
    }
    // Hàm 5: Hiển thị form Sửa (kèm dữ liệu cũ của sản phẩm)
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    // Hàm 6: Nhận dữ liệu mới và Lưu đè vào Database TiDB
    public function update(Request $request, $id)
    {
        // 1. Kiểm tra dữ liệu y như lúc Thêm mới
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'wholesale_price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
        ]);

        // 2. Tìm sản phẩm cũ và Cập nhật
        $product = Product::findOrFail($id);
        $product->update($request->all());

        // 3. Đá về trang Danh sách và báo thành công
        return redirect('/admin/products')->with('success', 'Đã cập nhật thông tin đồ nhựa thành công!');
    }
}
