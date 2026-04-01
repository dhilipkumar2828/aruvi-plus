<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistItems = Wishlist::where('user_id', Auth::id())
            ->with('product')
            ->latest()
            ->get();
            
        return view('customer.wishlist', compact('wishlistItems'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['status' => 'error', 'message' => 'Please login to add to wishlist'], 401);
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $wishlist = Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id
        ]);

        if ($wishlist->wasRecentlyCreated) {
            return response()->json(['status' => 'success', 'message' => 'Product added to wishlist', 'action' => 'added']);
        } else {
            // Optional: Toggle removal if already exists, or just return exists message.
            // For now, let's keep it simple: if exists, maybe remove it? Or just say added.
            // The user asked for toggle behavior usually, but let's stick to "add". 
            // actually, toggle is better for UX.
            $wishlist->delete(); // Toggle off
            return response()->json(['status' => 'success', 'message' => 'Product removed from wishlist', 'action' => 'removed']);
        }
    }

    public function destroy($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        Wishlist::where('user_id', Auth::id())
            ->where('id', $id)
            ->delete();

        return back()->with('success', 'Item removed from wishlist');
    }
}
