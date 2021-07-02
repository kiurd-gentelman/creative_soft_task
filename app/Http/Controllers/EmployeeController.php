<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\models\User;

class EmployeeController extends Controller
{
    public function employees(){
        $employees = User::where('type' , 'employee')->get();
//        return ($employees);
        return  response()->json($employees , 200);
    }
    public function store(Request $request)
    {
        $request =$request ->merge(['password' => 'password']);
//        dd($request);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $data =User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'type' => $request['type'],
            'password' => Hash::make($request['password']),
        ]);
        return  response()->json($data , 200);
    }
    public function update(Request $request ,$id)
    {
        $request =$request ->merge(['password' => 'password']);
//        dd($request);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $data = User :: find($id);
        $data->name = $request['name'];
        $data->email = $request['email'];
        $data->save();

        return  response()->json($data , 200);
    }

    public function delete($id){
//        return $id;
        $data = User :: find($id);
        $data->delete();
        return  response()->json($data , 200);
    }
}
