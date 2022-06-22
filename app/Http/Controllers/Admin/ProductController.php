<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductImageRequest;
use App\Http\Requests\ProductRequest;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Mitra;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->data['currentAdminMenu'] = 'product';

        $this->data['statuses'] = Product::statuses();
        $this->data['q'] = null;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::orderBy('name', 'ASC');
        if ($q = $request->query('q')) {
            $q = str_replace('-', '', Str::slug($q));
            $products = $products->whereRaw('MATCH(name,slug,short_description,description) AGAINST (? IN NATURAL LANGUAGE MODE)', [$q]);
            $this->data['q'] = $q;
        }
        $this->data['products'] = $products->paginate(10);
        return view('admin.products.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $mitras = Mitra::orderBy('name', 'ASC')->get();

        $this->data['categories'] = $categories->toArray();
        $this->data['mitras'] = $mitras->toArray();
        $this->data['product'] = null;
        $this->data['productID'] = 0;
        $this->data['categoryIDs'] = [];
        $this->data['mitraID'] = null;

        return view('admin.products.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try{
            $params = $request->except('_token');
            $params['slug'] = Str::slug($params['name']);
            $params['user_id'] = Auth::user()->id;

            $saved = false;
            $saved = DB::transaction(function () use ($params) {
                $product = Product::create($params);
                $product->categories()->sync($params['category_ids']);
                // $product->mitras()->sync($params['mitra_ids']);

                return true;
            });

            if ($saved) {
                Session::flash('success', 'Product has been saved');
            } else {
                Session::flash('error', 'Product could not be saved');
            }
        }catch(QueryException $e){
            Session::flash('error', "Product could not be saved : SQL Error");
        }
        return redirect('admin/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (empty($id)) {
            return redirect('admin.products.create');
        }

        $product = Product::findOrFail($id);
        $categories = Category::orderBy('name', 'ASC')->get();
        $mitras = Mitra::orderBy('name', 'ASC')->get();

        $this->data['categories'] = $categories->toArray();
        $this->data['mitras'] = $mitras->toArray();
        $this->data['product'] = $product;
        $this->data['productID'] = $product->id;
        $this->data['categoryIDs'] = $product->categories->pluck('id')->toArray();
        $this->data['mitraID'] = $product->mitra_id;

        return view('admin.products.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $params = $request->except('_token');
        $params['slug'] = Str::slug($params['name']);

        $product = Product::findOrFail($id);

        $saved = false;
        $saved = DB::transaction(function () use ($product, $params) {
            $product->update($params);
            $product->categories()->sync($params['category_ids']);
            // $product->mitras()->sync($params['mitra_ids']);

            return true;
        });

        if ($saved) {
            Session::flash('success', 'Product has been updated');
        } else {
            Session::flash('error', 'Product could not be update');
        }

        return redirect('admin/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->delete()) {
            Session::flash('success', 'Product has been delete');
        }
        return redirect('admin/products');
    }

    public function images($id)
    {
        if (empty($id)) {
            return redirect('admin/products/create');
        }

        $product = Product::findOrFail($id);

        $this->data['productID'] = $product->id;
        $this->data['productImages'] = $product->productImages;

        return view('admin.products.images', $this->data);
    }

    public function add_image($id)
    {
        if (empty($id)) {
            return redirect('admin/products');
        }

        $product = Product::findOrFail($id);

        $this->data['productID'] = $product->id;
        $this->data['product'] = $product;

        return view('admin.products.image_form', $this->data);
    }

    public function upload_image(ProductImageRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($request->has('image')) {
            $image = $request->file('image');
            $name = $product->slug . '_' . time();
            $fileName = $name . '.' . $image->getClientOriginalExtension();

            // $folder = ProductImage::UPLOAD_DIR . '/images';
            $folder = '/uploads/images';

            // $filePath = $image->storeAs($folder . '/original', $fileName, 'public');
            $filePath = $image->storeAs($folder, $fileName, 'public');

            // $resizedImage = $this->_resizeImage($image, $fileName, $folder);

            $params = array_merge(
                [
                    'product_id' => $product->id,
                    'path' => $filePath,
                ],
                // $resizedImage
            );

            if (ProductImage::create($params)) {
                Session::flash('success', 'Image has been uploaded');
            } else {
                Session::flash('error', 'Image could not be uploaded');
            }

            return redirect('admin/products/' . $id . '/images');
        }
    }

    public function remove_image($id)
    {
        $image = ProductImage::findOrFail($id);
        if(File::exists($image->path)){
            File::delete(public_path('storage/'.$image->path));
        }else{
            Session::flash('error', $image->path);
        }

        Storage::delete($image->path);

        if ($image->delete()) {
            // Session::flash('success', 'Image has been deleted');
        }

        return redirect('admin/products/' . $image->product->id . '/images');
    }
}
