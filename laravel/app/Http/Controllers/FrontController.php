<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderBy('id', 'DESC')->take(6)->get();
        $categories = Category::all();
        $user = Auth::user();


        return view('front.index', [
            'products' => $products,
            'categories' => $categories,
            'user' => $user,
        ]);
    }
    public function details(Product $product)
    {
        return view('front.details', [
            'product' => $product,

        ]);
    }

    // PRODUCT SEARCH, KENAPA PAKAI REQUEST, KARENA MENGAMBIL DATA DARI INPUTAN USER
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $products = Product::where('name', 'LIKE', '%' . $keyword . '%')->get();

        return view('front.search', [
            'products' => $products,
            'keyword' => $keyword,
        ]);
    }
    public function category(Category $category)
    {
        $products = Product::where('category_id', $category->id)->with('category')->get();

        return view('front.category', [
            'products' => $products,
            'category' => $category,
        ]);
    }
}
