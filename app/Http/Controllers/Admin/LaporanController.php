<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mitra;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->data['currentAdminMenu'] = 'laporan';
        
        $this->data['q'] = null;
    }
    public function index(Request $request){
        $data = Mitra::orderBy('name', 'ASC');
        if ($q = $request->query('q')) {
            $data = $data->whereRaw('MATCH(name,namaAdminPt) AGAINST (? IN NATURAL LANGUAGE MODE)', [$q]);
            $this->data['q'] = $q;
        }
        $this->data['data'] = $data->paginate(10);
        return view('admin.laporan.index', $this->data);
    }
    public function cetak(){
        $mitra = Mitra::all();

    	// $pdf = PDF::loadview('cetak_pdf',['pegawai'=>$pegawai]);
    	// $pdf = PDF::loadview('cetak_pdf',['mitra'=>$mitra]);
    	// return $pdf->download('laporan-pdf');
        // $excel = Excel::loadview('cetak_pdf',['mitra'=>$mitra]);
        return Excel::download(new $mitra, 'laporan.xlsx');
    }
}
