<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = [
            [
                "title" => "Post 1",
                "content" => "Este es el contenido del Post 1"
            ],
            [
                "title" => "Post 2",
                "content" => "Este es el contenido del Post 2"
            ],
            [
                "title" => "Post 3",
                "content" => "Este es el contenido del Post 3"
            ]
        ];

        $value = 123;
        $value_empty = null;

        return view('posts.index', compact('posts', 'value', 'value_empty'));
    }

    public function store()
    {
        return "Para procesar y crear un Post";
    }

    public function create()
    {
        return "Crear un Post - formulario";
    }

    public function show($id)
    {
        return "Viendo el Post: {$id}";
    }

    public function edit($post)
    {
        return "Editando el Post: {$post}";
    }

    public function destroy($post)
    {
        return "Eliminando el Post: {$post}";
    }

    public function update($post)
    {
        return "Actualizando el Post: {$post}";
    }

}
