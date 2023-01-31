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

    public function readTodo($id) { 
        $array = ['error' => ''];

        $todo = Todo::find($id);

        if ($todo){
            $array['todo'] = $todo;
        } else {
            $array['error'] = 'A tarefa ' . $id . ' não existe!';
        }

        return $array;
    }

    public function updateTodo($id, Request $request) { 
        $array = ['error' => ''];

        // Validando
        $rules = [
            'title' => 'min:3',
            'done' => 'boolean' // true, false, 0, 1, '0', '1'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            $array['error'] = $validator->errors();
            return $array;
        }

        $title = $request->input('title');
        $done = $request->input('done');

        // Atualizando o item
        $todo = Todo::find($id);

        if ($todo){

            if ($title){
                $todo->title = $title;
            }
            if ($done !== NULL){
                $todo->done = $done;
            }

            $todo->save();

        } else {
            $array['error'] = 'Tarefa' . $id . ' não existe, logo, não pode ser atualizado.';
        }

        return $array;
    }

    public function deleteTodo() { 

    }
}
