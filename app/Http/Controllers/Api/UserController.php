<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Customer;
use App\Models\Permintaan;

class UserController extends Controller
{
    public function login($email, $password): JsonResponse
    {
        $sql = DB::table('users')
            ->select(DB::raw('users.*'))
            ->get();
        $id = "";
        foreach ($sql as $d) {
            if ($email == $d->email && Hash::check($password, $d->password) && $d->role == '0' ) {
                $result = true;
                $id = $d->id;
                break;
            } else {
                $result = false;
            }
        }
        if ($result) {
            $sql = DB::table('users')
                ->select(DB::raw('users.id as user_id,customers.id as customer_id'))
                ->join('customers', 'customers.user_id', '=', 'users.id')
                ->where('users.id', '=', $id)
                ->get();
        } else {
            $sql = "Failed";
        }
        return response()->json($sql);
    }

    public function showUser($id): JsonResponse
    {
        $sql = DB::table('users')
            ->select(DB::raw('users.*,customers.*'))
            ->join('customers', 'customers.user_id', '=', 'users.id')
            ->where('users.id', '=', $id)
            ->get();
        return response()->json($sql);
    }
    public function register(Request $request): JsonResponse
    {
        $params['name'] = $request->input('name');
        $params['email'] = $request->input('email');
        $params['password'] = bcrypt($request->input('password'));
        $params['role'] = $request->input('role');

        $params1['name'] = $request->input('name');
        $params1['email'] = $request->input('email');
        $params1['address'] = $request->input('address');
        $params1['telp'] = $request->input('telp');
        $params1['instansi'] = $request->input('instansi');

        $saved1 = User::create($params);
        if ($saved1) {
            $sql = User::where('email', '=', $request->input('email'))
                ->get();
            foreach ($sql as $row) {
                if ($request->input('email') == $row->email && Hash::check($request->input('password'), $row->password)) {
                    $params1['user_id'] = $row->id;
                    break;
                }
            }
            $saved2 = Customer::create($params1);
        }
        return response()->json($saved2, Response::HTTP_CREATED);
    }
    public function update($id, Request $request): JsonResponse
    {
        $saved1 = User::findOrFail($id);
        $param['name'] = $request->input('name');
        $param['email'] = $request->input('email');
        $saved1->update($param);

        $params['name'] = $request->input('name');
        $params['email'] = $request->input('email');
        $params['telp'] = $request->input('telp');
        $params['address'] = $request->input('address');
        $params['instansi'] = $request->input('instansi');
        $saved2 = DB::table('customers')->where('user_id', $id)->update($params);

        if ($saved1 && $saved2) {
        }
        return response()->json($saved2, Response::HTTP_OK);
    }

    public function ubahPassword($id, Request $request): JsonResponse
    {
        $param = $request->except('_token');
        $pass = $request->input('opass');
        $saved1 = User::findOrFail($id);
        if (Hash::check($pass, $saved1->password)) {
            $param['password'] = bcrypt($request->input('npass'));
            $saved1->update($param);
        } else {
            $saved1 = "Fail";
        }
        return response()->json($saved1, Response::HTTP_OK);
    }

    public function makeContract(Request $request): JsonResponse
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

            $saved = Permintaan::create($params);
        }
        return response()->json($saved, Response::HTTP_CREATED);
    }
}
