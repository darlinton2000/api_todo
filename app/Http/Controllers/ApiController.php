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
            $array['error'] = $validator->messages();
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

    }

    public function readTodo() { 

    }

    public function updateTodo() { 

    }

    public function deleteTodo() { 

    }
}
