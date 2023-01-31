<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function create(Request $request){
        $array = ['error' => ''];

        // Validando
        $rules = [
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            $array['error'] = $validator->errors();
            return $array;
        }

        $email = $request->input('email');
        $password = $request->input('password');

        // Criando novo usuario
        $newUser = new User();
        $newUser->email = $email;
        $newUser->password = password_hash($password, PASSWORD_DEFAULT);
        $newUser->token = '';
        $newUser->save();

        return $array;
    }
}
