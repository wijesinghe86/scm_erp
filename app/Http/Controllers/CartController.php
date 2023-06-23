<?php

namespace App\Http\Controllers;

use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartList()
    {
        $cartCollection =  Cart::session(request()->user()->id)->getContent();
        $sorted = $cartCollection->sortBy(function ($product, $key) {
            return $key;
        });
        $subTotal = Cart::session(request()->user()->id)->getSubTotal();
        $total = Cart::session(request()->user()->id)->getTotal();
        return [
            'cart' => $sorted->toArray(),
            'subTotal' => $subTotal,
            'total' => $total
        ];
    }

    public function addToCart(Request $request)
    {
        $data = $request->item_data;
        Cart::session(request()->user()->id)->add($data);
        return $this->cartList();
    }

    public function updateCart(Request $request)
    {
        Cart::session(request()->user()->id)->update(
            $request->id,
            $request->item_data
        );

        return $this->cartList();
    }

    public function removeCart(Request $request)
    {
        Cart::session(request()->user()->id)->remove($request->id);
        return $this->cartList();
    }

    public function clearAllCart(Request $request)
    {
        Cart::session(request()->user()->id)->clear();
        return [
            'success' => true,
            'message' => 'Cart Cleared'
        ];
    }
}
