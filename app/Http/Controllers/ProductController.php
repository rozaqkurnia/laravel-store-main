<?php

namespace App\Http\Controllers;

use App\Jobs\ProductLiked;
use App\Models\Product;
use App\Models\ProductLike;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return $products;
    }

    public function show($id)
    {
        $product = Product::find($id);
        if(!$product || empty($product)){
            return response(null, Response::HTTP_NOT_FOUND);
        }
        return $product;
    }

    public function like($id, Request $request)
    {
        $response = \Http::get('http://localhost:8000/api/user');
        $user = $response->json();
		
		try {
			$productLiked = ProductLike::create([
				'user_id' => $user['id'],
				'product_id' => $id
			]);
			
			ProductLiked::dispatch($productLiked->toArray())->onQueue('admin_queue');
			
			$message = array('message' => 'success');
			return response($message, Response::HTTP_OK);
		} catch (\Exception $exception) {
			$error = array('error' => 'you already liked this product');
			return response($error, Response::HTTP_BAD_REQUEST);
		}
		
    }

    
}
