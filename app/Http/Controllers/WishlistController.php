<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class WishlistController extends Controller
{
    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $wishlist = session()->get('wishlist', []);
        $wishlist[$product->id] = [
            "name" => $product->name,
            "price" => $product->price,
            "image" => asset('images/' . $product->thumb_image)
        ];
        session(['wishlist' => $wishlist]);
        return response()->json(['count' => count($wishlist)]);
    }

    public function count()
    {
        $wishlist = session()->get('wishlist', []);
        return response()->json(['count' => count($wishlist)]);
    }

    public function view()
    {
        $wishlist = session()->get('wishlist', []);
        return view('Wishlist', compact('wishlist'));
    }
}
