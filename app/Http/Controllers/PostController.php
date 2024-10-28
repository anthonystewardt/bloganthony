<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return "Posts";
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
