<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function showAllProduct(): JsonResponse
    {
        $sql = DB::table('products')
            ->select(DB::raw('products.*,mitras.name AS mitra,product_images.path, requests.customer_id as kontrak'))
            ->join('mitras', 'mitras.id', '=', 'products.mitra_id')
            ->leftJoin('requests', 'requests.product_id', '=', 'products.id')
            ->join('product_images', 'product_images.product_id', '=', 'products.id')
            ->groupBy('products.id')
            ->get();
        return response()->json($sql);
    }

    public function showOneProduct($id): JsonResponse
    {
        $sql = DB::table('products')
            ->select(DB::raw('products.*,mitras.name AS mitra,product_images.path, requests.customer_id as kontrak'))
            ->join('mitras', 'mitras.id', '=', 'products.mitra_id')
            ->join('product_images', 'product_images.product_id', '=', 'products.id')
            ->leftJoin('requests', 'requests.product_id', '=', 'products.id')
            ->where('products.id', '=', $id)
            ->groupBy('products.id')
            ->get();
        return response()->json($sql);
    }

    public function showProductbyCategory($id): JsonResponse
    {
        $sql = DB::table('products')
            ->select(DB::raw('products.*,mitras.name AS mitra,product_images.path, requests.customer_id as kontrak'))
            ->join('mitras', 'mitras.id', '=', 'products.mitra_id')
            ->join('product_categories', 'product_categories.product_id', '=', 'products.id')
            ->join('product_images', 'product_images.product_id', '=', 'products.id')
            ->leftJoin('requests', 'requests.product_id', '=', 'products.id')
            ->where('product_categories.category_id', '=', $id)
            ->groupBy('products.id')
            ->get();
        return response()->json($sql);
    }

    public function showProductImage($id): JsonResponse
    {
        $sql = DB::table('product_images')
            ->select(DB::raw('product_images.*'))
            ->where('product_images.product_id', '=', $id)
            ->get();
        return response()->json($sql);
    }

    
}
