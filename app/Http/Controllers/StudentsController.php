<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Student;

class StudentsController extends Controller {
    public function index() {
        return Student::all();
    }

    public function store(Request $request){
        $inputs = $request->input(); // data injected on url
        $response = Student::create($inputs);
        return response()->json([
            'data'=>$response,
            'message'=> 'Student saved!'
        ]);
    }

    public function update(Request $request, $id){
        $e = Student::find($id);
        if (!isset($e)) {
            return response()->json([
                'error'=>true,
                'message'=> 'The student doenst exist'
            ]); 
        }
        if(!empty($request->name))      {$e->name = $request->name;}
        if(!empty($request->photo))     {$e->photo = $request->photo;}
        if(!empty($request->last_name)) {$e->last_name = $request->last_name;}
        return response()->json([
            'data'=>$e,
            'message'=> 'Student updated!'
        ]);
    }
    public function show($id){
        $e = Student::find($id);
        if(!isset($e)) {
            return response()->json([
                'error'=>true,
                'message'=> 'Student not found!'
            ]);
        }
        return response()->json([
            'data'=>$e,
            'message'=> 'Student found!'
        ]);
    }
    public function destroy($id){
        $e = Student::find($id);
        if (!isset($e)) {
            return response()->json([
                'error'=>true,
                'message'=> 'Student not found!'
            ]);
        }
        $resp = Student::destroy($id);
        return response()->json([
            'data'=>$e,
            'message'=> 'Student removed!'
        ]);
    }
}