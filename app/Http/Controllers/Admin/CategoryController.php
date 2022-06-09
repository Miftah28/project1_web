<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->data['currentAdminMenu'] = 'category';
        $this->data['q'] = null;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::orderBy('name', 'ASC');
        if ($q = $request->query('q')) {
            $q = str_replace('-', '', Str::slug($q));
            $categories = $categories->whereRaw('MATCH(name,slug) AGAINST (? IN NATURAL LANGUAGE MODE)', [$q]);
            $this->data['q'] = $q;
        }
        $this->data['categories'] = $categories->paginate(10);
        return view('admin.categories.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $this->data['categories'] = $categories->toArray();
        $this->data['category'] = null;
        return view('admin.categories.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $params = $request->except('_token');
        $params['slug'] = Str::slug($params['name']);
        $params['parent_id'] = (int) $params['parent_id'];

        if ($request->has('image')) {
            $file = $request->file('image');
            $name =  Str::slug($params['name']) . '_' . time();
            $fileName = $name . '.' . $file->getClientOriginalExtension();
            $folder = '/uploads/images';
            $filePath = $file->storeAs($folder, $fileName, 'public');
            $params['path'] = $filePath;
            if (Category::create($params)) {
                Session::flash('success', 'Category has been saved');
            } else {
                Session::flash('error', 'Category could not be saved');
            }
            return redirect('admin/categories');
        }
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
        $category = Category::findOrFail($id);
        $categories = Category::orderBy('name', 'ASC')->get();
        $this->data['categories'] = $categories->toArray();
        $this->data['category'] = $category;
        return view('admin.categories.form', $this->data);
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
        $request->validate([
            'name' => 'required',
        ]);
        $params = $request->except('_token');
        $params['slug'] = Str::slug($params['name']);

        if ($request->has('image')) {
            $file = $request->file('image');
            $name =  Str::slug($params['name']) . '_' . time();
            $fileName = $name . '.' . $file->getClientOriginalExtension();
            $folder = '/uploads/kontrak';
            $filePath = $file->storeAs($folder, $fileName, 'public');
            $params['path'] = $filePath;
        } else {
            $params = $request->except('path');
        }

        $category = Category::findOrFail($id);
        if ($category->update($params)) {
            Session::flash('success', 'Category has been update');
        } else {
            Session::flash('error', 'Category could not be saved');
        }
        return redirect('admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if ($category->delete()) {
            Session::flash('success', 'Category has been delete');
        }
        return redirect('admin/categories');
    }
}
