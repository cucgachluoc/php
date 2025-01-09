<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
{
    $search = $request->query('search');
    if ($search) {
        $products = Product::where('product_name', 'LIKE', "%{$search}%")->get();
    } else {
        $products = Product::all();
    }
    return view('products.index', compact('products'));
}

    public function create()
    {
        return view("products.create");

    }
    public function store(Request $request)
    {
        $product = new Product($request->all());
        $product->save();
        return redirect()->route('products.index');
    }
    public function show($id)
    {
         $product = Product::findOrFail($id);
          return view('products.show', compact('product'));
    }
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return redirect()->route('products.index');
    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id); $product->delete();
         return redirect()->route('products.index')->with('success', 'Sản phẩm đã được xóa thành công.');
    }

}
