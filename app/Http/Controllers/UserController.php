<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $inputs   = $request->input();
        if(!empty($request->password)) {$inputs['password'] = Hash::make(trim($request->password));}
        $response = User::create($inputs);
        return response()->json([
            'data'    => $response,
            'message' => 'User saved!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $u = User::find($id);
        if(!isset($u)) {
            return response()->json([
                'error'   => true,
                'message' => 'User not found!'
            ]);
        }
        return response()->json([
            'data'=>$u,
            'message'=> 'User found!'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id){
        $u = User::find($id);
        if (!isset($u)) {
            return response()->json([
                'error'   =>true,
                'message' => 'The user doenst exist'
            ]); 
        }
        if(!empty($request->name))      {$u->name      = $request->name;}
        if(!empty($request->email))     {$u->email     = $request->email;}
        if(!empty($request->password))  {$u->password  = Hash::make($request->password);}
        if(!empty($request->last_name)) {$u->last_name = $request->last_name;}
        return response()->json([
            'data'=>$u,
            'message'=> 'User updated!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        $u= User::find($id);
        if (!isset($u)) {
            return response()->json([
                'error'   =>true,
                'message' => 'User not found!'
            ]);
        }
        $resp = User::destroy($id);
        return response()->json([
            'data'    => $u,
            'message' => 'User removed!'
        ]);
    }
}
