<?php

namespace App\Http\Controllers;

use App\Models\Product;
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

    
}
