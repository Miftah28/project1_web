<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function showAllCategory(): JsonResponse
    {

        return response()->json(Category::all());
    }

    public function showMainCategory(): JsonResponse
    {
        $sql = DB::table('product_categories')
            ->select(DB::raw('distinct categories.id,categories.name,categories.slug,categories.parent_id'))
            ->join('categories','categories.id','=','product_categories.category_id')
            ->where('parent_id', '=', 0)
            ->get();
        return response()->json($sql);
    }

    public function showSubCategory($id): JsonResponse
    {
        $sql = DB::table('product_categories')
            ->select(DB::raw('distinct categories.id,categories.name,categories.slug,categories.parent_id'))
            ->join('categories','categories.id','=','product_categories.category_id')
            ->where('parent_id', '=', $id)
            ->get();
        return response()->json($sql);
    }
}
