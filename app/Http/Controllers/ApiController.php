<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function createTodo(Request $request) { 
        $array = ['error' => ''];

        // Validando
        $rules = [
            'title' => 'required|min:3'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            $array['error'] = $validator->errors();
            return $array;
        }

        $title = $request->input('title');

        // Criando o registro
        $todo = new Todo();
        $todo->title = $title;
        $todo->save();

        return $array;
    }
    
    public function readlAlltodos() { 
        $array = ['error' => ''];

        $array['list'] = Todo::all();

        return $array;
    }

    public function readTodo() { 

    }

    public function updateTodo() { 

    }

    public function deleteTodo() { 

    }
}
