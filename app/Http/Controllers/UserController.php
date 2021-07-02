<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(array $data)
    {
        $data =array_merge($data , ['password' => 'password']);
//        dd($data);
        $data =User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'type' => $data['type'],
            'password' => Hash::make($data['password']),
        ]);
        return  response()->json($data , 200);
    }
}
