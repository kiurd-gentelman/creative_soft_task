<?php

namespace App\Http\Controllers;
use App\models\Task;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::with('user')->get();
        return  response()->json($tasks , 200);
    }
    public function store(Request $request)
    {
        $request =$request ->merge(['password' => 'password']);
//        dd($request);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required'],
            'employee_id' => ['required'],
            'description' => ['required'],
        ]);

        $data =Task::create([
            'task_name' => $request['name'],
            'status' => $request['status'],
            'user_id' => $request['employee_id'],
            'description' => $request['description'],
        ]);
        return  response()->json($data , 200);
    }
    public function update(Request $request,$id)
    {
        $request =$request ->merge(['password' => 'password']);
//        dd($request);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required'],
            'employee_id' => ['required'],
            'description' => ['required'],
        ]);

        $data = Task::find($id);
        $data->task_name=$request['name'];
        $data->status=$request['status'];
        $data->user_id=$request['employee_id'];
        $data->description=$request['description'];
        $data->save();

        return  response()->json($data , 200);
    }
    public function delete($id){
//        return $id;
        $data = Task :: find($id);
        $data->delete();
        return  response()->json($data , 200);
    }
}
