<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mitra;
use Illuminate\Support\Facades\Session;

class MitraController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->data['currentAdminMenu'] = 'mitra';
        $this->data['q'] = null;
    }
    public function index(Request $request)
    {
        $data = Mitra::orderBy('name', 'ASC');
        if ($q = $request->query('q')) {
            $data = $data->whereRaw('MATCH(name,namaAdminPt) AGAINST (? IN NATURAL LANGUAGE MODE)', [$q]);
            $this->data['q'] = $q;
        }
        $this->data['data'] = $data->paginate(10);
        return view('datamitra', $this->data);
        // $data = Mitra::all();
        // return view('datamitra', compact('data'));
    }

    public function tambahmitra()
    {
        return view('tambahdata',$this->data);
    }

    public function insertdata(Request $request)
    {
        // dd($request->all());
        $saved = false;
        $saved = Mitra::create($request->all());
        if ($saved) {
            Session::flash('success', 'Mitra has been saved');
        } else {
            Session::flash('error', 'Mitra could not be saved');
        }
        return redirect()->route('mitra');
    }

    public function tampilkandata($id)
    {
        $data = Mitra::find($id);
        $this->data['data'] = $data;
        // dd($data);
        return view('tampildata', $this->data);
    }

    public function updatedata(Request $request, $id)
    {
        $saved = false;
        $data = Mitra::find($id);
        $saved = $data->update($request->all());
        if ($saved) {
            Session::flash('success', 'Mitra has been updated');
        } else {
            Session::flash('error', 'Mitra could not be update');
        }
        return redirect()->route('mitra');
    }

    public function delete($id)
    {
        $saved = false;
        $data = Mitra::find($id);
        $saved = $data->delete();
        if ($saved) {
            Session::flash('success', 'Mitra has been deleted');
        } else {
            Session::flash('error', 'Mitra could not be delete');
        }
        return redirect()->route('mitra');
    }
}
