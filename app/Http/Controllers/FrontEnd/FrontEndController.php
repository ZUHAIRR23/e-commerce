<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontEndController extends Controller
{
    //
    public function index()
    {
        $category = Category::select('id', 'name', 'slug')->latest()->get();
        $product = Product::with('product_galleries')->select('id', 'name', 'slug', 'price')->latest()->limit(8)->get();

        
        return view('pages.frontend.index', compact(
            'category',
            'product'
        ));
    }

    public function detailProduct($slug)
    {
        $category = Category::select('id', 'name', 'slug')->latest()->get();
        $product = Product::with('product_galleries')->where('slug', $slug)->first();
        $recomendation = Product::with('product_galleries')->select('id', 'name', 'slug', 'price')->inRandomOrder()->limit(4)->get();

        return view('pages.frontend.detail-product', compact(
            'product',
            'category',
            'recomendation'
        ));
    }

    public function detailCategory($slug)
    {
        $category = Category::select('id', 'name', 'slug')->latest()->get();
        $categories = Category::where('slug', $slug)->first();
        $product = Product::with('product_galleries')->where('category_id', $categories->id)->latest()->get();

        return view('pages.frontend.detail-category', compact(
            'category',
            'categories',
            'product'
        ));
    }

    public function cart()
    {
        $category = Category::select('id', 'name', 'slug')->latest()->get();
        $cart = Cart::with('product')->where('user_id', auth()->user()->id)->latest()->get();

        return view('pages.frontend.cart', compact(
            'category',
            'cart'
        ));
    }

    public function addToCart(Request $request, $id)
    {
        try {
            Cart::create([
                'product_id' => $id,
                'user_id' => auth()->user()->id
            ]);
            return redirect()->route('cart')->with('success', 'Berhasil Menambahkan Ke Cart');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi Kesalahan');
        }
    }

    public function deleteCart($id)
    {
        try {
            Cart::findOrFail($id)->delete();

            return redirect()->route('cart');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi Kesalahan');
        }
    }
}
