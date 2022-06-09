<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permintaan;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ContractController extends Controller
{
    public function showContract($id): JsonResponse
    {
        $sql = DB::table('requests')
            ->select(DB::raw('requests.*,products.name AS product,products.description,mitras.name as mitra,product_images.path as image'))
            ->join("products", 'products.id', '=', 'requests.product_id')
            ->join('mitras', 'mitras.id', '=', 'products.mitra_id')
            ->join('product_images', 'product_images.product_id', '=', 'products.id')
            ->where('requests.customer_id', '=', $id)
            ->groupBy('requests.id')
            ->get();
        return response()->json($sql);
        // return response()->json(Category::all()->where('parent_id', '=', $id));
    }
    public function editContract($id): JsonResponse
    {
        $req = Permintaan::findOrFail($id);
        $params['status'] = 3;
        if ($req->update($params)) {
            $sql = 'Success';
        } else {
            $sql = 'Failed';
        }
        return response()->json($sql);
    }

    public function cekKontrak($idc, $idp)
    {
        $sql = DB::table('requests')
            ->select(DB::raw('requests.id'))
            ->where('customer_id', '=', $idc)
            ->where('product_id', '=', $idp)
            ->get();
            if($sql=="[]"){
                return "OK";
            }else{
                return "Fail";
            }
    }
}
