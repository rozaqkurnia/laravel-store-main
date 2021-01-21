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
		return $orderHeader;
	}
	
	public function increment($productId, Request $request)
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
	
	public function decrement($productId, Request $request)
	{
		$user_id = 1;
		if($user_id != null) {
			$cart = ShoppingCart::where('user_id', $user_id)
				->where('product_id', $productId)
				->first();
			if($cart == null){
				return response('You haven\'t add this item on your cart.', Response::HTTP_BAD_REQUEST);
			}
			if($cart->qty <= 1){
				$cart->delete();
				return response('an item removed from cart successfully', Response::HTTP_OK);
			}
			$cart->qty--;
			$cart->save();
		}
	}
	
	public function destroy($userId)
	{
		$user_id = $userId;
		if($user_id != null) {
			$carts = ShoppingCart::where('user_id', $user_id)->get();
			if($carts != null){
				foreach($carts as $item){
					$item->delete();
				}
				return response('items has been removed from cart successfully', Response::HTTP_NO_CONTENT);
			} else {
				return response('your cart is empty!', Response::HTTP_BAD_REQUEST);
			}
		}
	}
}
