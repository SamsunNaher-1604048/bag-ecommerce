<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WishlistController extends Controller
{
    protected $wishlist;
    public function __construct(wishlist $wishlist)
    {
        $this->wishlist = $wishlist;
    }
    public function showWishlist():View
    {
        $session_id = session()->get('session_id');

        $data['wishlists'] = $this->wishlist->with('product')->where(function($query) use($session_id){
            $query->where('session_id', $session_id)->orWhere('user_id', auth()->id());
        })->get();

        return view('pages.wishlist', $data);
    }

    public function wishlistAdd(Request $request):JsonResponse
    {
        $session_id = session()->get('session_id');
        $product_id = $request->get('product_id');

        if($session_id == null)
        {
            session()->put('session_id',uniqid());
            $session_id = session()->get('session_id');
        }

        $wishlist = $this->wishlist->where(function($query) use ($session_id) {
            $query->where('session_id', $session_id)
                ->orWhere('user_id', auth()->id());
        })->where('product_id', $product_id)->first();

        if($wishlist) {
            return response()->json(['status'=>'danger', 'message'=>'Already added to your wishlist']);
        }

        $wishlist = new Wishlist();
        $wishlist->user_id = auth()->id()??0;
        $wishlist->session_id = $session_id;
        $wishlist->product_id = $product_id;
        $wishlist->save();

        return response()->json(['status'=>'success', 'message'=>'product added to wishlist']);

    }

    public function wishlistRemove(Request $request):JsonResponse
    {
        $wishlist_id = $request->get('wishlist_id');
        $wishlist = $this->wishlist->find($wishlist_id);

        if ($wishlist) {
            $wishlist->delete();
            return response()->json(['status'=>'success', 'message'=>'product removed from cart']);
        } else {
            return response()->json(['status'=>'danger', 'message'=>'Item not found in cart!']);
        }
    }

}
