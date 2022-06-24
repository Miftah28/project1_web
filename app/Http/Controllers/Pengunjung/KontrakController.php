<?php

namespace App\Http\Controllers\Pengunjung;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermintaanRequest;
use App\Models\Permintaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Customer;

class KontrakController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->data['currentMenu'] = 'kontrak';

        $this->data['q'] = null;
    }
    public function index(Request $request)
    {
        $requests = Permintaan::select(DB::raw('requests.*'))
            ->join('customers', 'customers.id', '=', 'requests.customer_id')
            ->join('products', 'products.id', '=', 'requests.product_id')
            ->where('customers.id', '=', Auth::user()->customers->id)
            ->orderBy('requests.id', 'ASC');
        if ($q = $request->query('q')) {
            $requests = $requests
                ->where('products.name', 'like', '%' . $q . '%');
            $this->data['q'] = $q;
        }
        $this->data['requests'] = $requests->paginate(10);
        return view('pengunjung.kontrak', $this->data);
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
        return redirect('pengunjung.kontrak');
    }
    public function edit($id)
    {
        $req = Permintaan::findOrFail($id);
        $params['status'] = 2;
        if ($req->update($params)) {
            Session::flash('success', 'Action Success');
        } else {
            Session::flash('error', 'Action Failed');
        }
        return redirect('/kontrakSaya');
    }

    public function create(Request $request){
        $this->validate($request,[
            'product_id' => 'required',
            'file' =>'required|max:4096',
        ]);

        if ($request->has('file')) {
            $file = $request->file('file');
            $name = 'kontrak_' . time();
            $fileName = $name . '.' . $file->getClientOriginalExtension();
            $folder = '/uploads/kontrak';
            $filePath = $file->storeAs($folder, $fileName, 'public');

            $params = $request->except('_token');
            $params['name_file'] = $fileName;
            $params['path'] = $filePath;
            $params['status'] = "0";
            $params['customer_id'] = Auth::user()->customers->id;

            if (Permintaan::create($params)) {
                Session::flash('success', 'Request has been saved');
            } else {
                Session::flash('error', 'Request could not be saved');
            }
            return redirect('/kontrakSaya');
        }
    }
}
