<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShoppingCartController extends Controller
{
    public function index()
	{
		$orderDetails = new \App\Models\OrderDetail;
		$orderHeader = new \App\Models\OrderHeader;
		$cart = [];
		
		$orderHeader['order_total'] = 0;
		$user_id = 1;
		if($user_id != null) {
			$cart = ShoppingCart::where('user_id', $user_id)->get();
			if($cart != null) {
				foreach($cart as $item) {
					$orderHeader['order_total'] += ($item->product->price * $item->qty);
				}
			}
		}
	}
	
	public function addItem($productId, Request $request)
	{
		$user_id = 1;
		if($user_id != null) {
			$cart = ShoppingCart::where('user_id', $user_id)
				->where('product_id', $productId)
				->firstOrNew([
					'user_id' => $user_id,
					'product_id' => $productId
				]);
			$cart->qty++;
			$cart->save(); 
		}
	}
	
	public function removeItem($productId, Request $request)
	{
		$user_id = 1;
		if($user_id != null) {
			$cart = ShoppingCart::where('user_id', $user_id)
				->where('product_id', $productId)
				->first();
			if($cart == null){
				return response('anda belum menambahkan product ini.', Response::HTTP_BAD_REQUEST);
			}
			if($cart->qty <= 1){
				$cart->delete();
				return response('cart updated', Response::HTTP_OK);
			}
			$cart->qty--;
			$cart->save();
		}
	}
}
