<?php

namespace App\Http\Controllers\Pengunjung;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductCustomerController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->data['currentMenu'] = 'productCustomer';

        $this->data['q'] = null;
    }
    public function index(Request $request)
    {
        $products = Product::select(DB::raw('products.*,product_images.path'))
            ->join('product_images', 'product_images.product_id', '=', 'products.id')
            ->join('product_categories', 'product_categories.product_id', '=', 'products.id')
            ->groupBy('products.id')
            ->orderBy('products.name', 'ASC');
        if ($q = $request->query('q')) {
            $products = $products
                ->where('products.name', 'like', '%' . $q . '%');
            $this->data['q'] = $q;
        }
        if ($id = $request->query('id')) {
            $products = $products
                ->where('product_categories.category_id', 'like', '%' . $id . '%');
        }
        $this->data['products'] = $products->paginate(20);
        $categories = Category::orderBy('name', 'ASC');
        $this->data['categories'] = $categories->get();
        return view('/pengunjung/index', $this->data);
    }
    public function postproduk(Request $request)
    {
        $data = Product::select(DB::raw('products.*,product_images.path'))
        ->join('product_images', 'product_images.product_id', '=', 'products.id')
        ->where('products.id',$request->query('id'))
        ->groupBy('products.id')
        ->get();
        $this->data['produk'] = $data;
        return view('/pengunjung/postproduk', $this->data);
    }
}
