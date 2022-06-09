<?php

namespace App\Http\Controllers\Pengunjung;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mitra;
use App\Models\Categories;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->data['currentMenu'] = 'pengunjung';
    }
    public function index()
    {
        $this->data['mitras'] = Mitra::orderBy('name', 'ASC')->paginate(2);
        $this->data['categories'] = Category::where('parent_id', '=', '')->orderBy('name', 'ASC')->paginate(5);
        $products = Product::
            // ->select(DB::raw('products.*,product_images.*'))
            join('product_images', 'product_images.product_id', '=', 'products.id')
            ->where('products.parent_id', '=', '')
            ->groupBy('products.id')
            ->orderBy('products.name', 'ASC');
        $this->data['products'] = $products->paginate(3);
        return view('/pengunjung/tampilanpengunjung', $this->data);
    }

    public function post()
    {
        return view('postproduk');
    }
    public function permintaan()
    {
        return view('ajukanpermintaan');
    }
}
