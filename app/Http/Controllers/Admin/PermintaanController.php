<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permintaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\PermintaanRequest;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PermintaanController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->data['currentAdminMenu'] = 'request';
        $this->data['statuses'] = Permintaan::statuses();
        $this->data['q'] = null;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $requests = Permintaan::select(DB::raw('requests.*,products.name,customers.name'))
            ->join('customers', 'customers.id', '=', 'requests.customer_id')
            ->join('products', 'products.id', '=', 'requests.product_id')
            ->orderBy('requests.id', 'ASC');
        if ($q = $request->query('q')) {
            $requests = $requests
                ->where('customers.name', 'like', '%' . $q . '%')
                ->orWhere('products.name', 'like', '%' . $q . '%');
            $this->data['q'] = $q;
        }
        $this->data['requests'] = $requests->paginate(10);
        return view('admin.permintaan.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::orderBy('name', 'ASC')->get();
        $customers = Customer::orderBy('name', 'ASC')->get();

        $this->data['products'] = $products->toArray();
        $this->data['customers'] = $customers->toArray();
        $this->data['request'] = null;
        $this->data['requestID'] = 0;
        $this->data['productID'] = null;
        $this->data['customerID'] = null;

        return view('admin.permintaan.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermintaanRequest $request)
    {
        if ($request->has('file')) {
            $file = $request->file('file');
            $name = 'kontrak_' . time();
            $fileName = $name . '.' . $file->getClientOriginalExtension();
            $folder = '/uploads/kontrak';
            $filePath = $file->storeAs($folder, $fileName, 'public');

            $params = $request->except('_token');
            $params['name_file'] = $fileName;
            $params['path'] = $filePath;

            if (Permintaan::create($params)) {
                Session::flash('success', 'Request has been saved');
            } else {
                Session::flash('error', 'Request could not be saved');
            }
            return redirect('admin/permintaan');
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
        $request = Permintaan::findOrFail($id);
        $products = Product::orderBy('name', 'ASC')->get();
        $customers = Customer::orderBy('name', 'ASC')->get();

        $this->data['products'] = $products->toArray();
        $this->data['customers'] = $customers->toArray();
        $this->data['request'] = $request;
        $this->data['requestID'] = $request->id;
        $this->data['productID'] = $request->product_id;
        $this->data['customerID'] = $request->customer_id;

        return view('admin.permintaan.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermintaanRequest $request, $id)
    {
        $params = $request->except('_token');
        if ($request->has('file')) {
            $file = $request->file('file');
            $name = 'kontrak_' . time();
            $fileName = $name . '.' . $file->getClientOriginalExtension();
            $folder = '/uploads/kontrak';
            $filePath = $file->storeAs($folder, $fileName, 'public');

            $params['name_file'] = $fileName;
            $params['path'] = $filePath;
        } else {
            $params = $request->except('path');
            $params = $request->except('name_file');
        }
        $req = Permintaan::findOrFail($id);
        if ($req->update($params)) {
            Session::flash('success', 'Request has been update');
        } else {
            Session::flash('error', 'Request could not be saved');
        }
        return redirect('admin/permintaan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $req = Permintaan::findOrFail($id);
        if ($req->delete()) {
            Session::flash('success', 'Request has been delete');
        } else {
            Session::flash('error', 'Request could not be saved');
        }
        return redirect('admin/permintaan');
    }

    public function download($id)
    {
        $permintaan = Permintaan::findOrFail($id);
        if (Storage::disk('public')->exists('/' . $permintaan->path)) {
            return response()->download(storage_path('app/public/' . $permintaan->path), $permintaan->name_file);
            Session::flash('success', 'Download Success');
        } else {
            Session::flash('error', 'Download Failed');
        }
        return redirect('admin/permintaan');
    }
}
