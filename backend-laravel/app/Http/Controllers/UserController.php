<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index($id){
        return User::all();
    }

    public function store(Request $request){
        $inputs = $request->input();
        $user = User::create($inputs);
        if(isset($user)){
            return response()->json([
                'data' => $user,
                'message' => 'User successfully stored'
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'There was not possible to store the desired user.'
            ]);
        }
    }

    public function show($id){
        $result = User::find($id);
        if(isset($result)){
            return response()->json([
                'data' => $result,
                'message' => 'Record found successfully'
            ]);
        } else{
            return response()->json([
                'error' => true,
                'message' => 'There was impossible to find the record with id'. $id,
            ]);
        }
    }
}
