<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController2 extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return view('test.index', ['name' => 'Carlos Devia', 'age' => 31, 'html' => '<h1>Hola mundo</h1>', 'array' => [1,2,3,4,5,6]]); // Muestra un array hacia una vista
        $posts = [1,2,3,4,5,6];
        $name = 'Andrés';
        return view('dashboard.test.index', compact('posts', 'name'));
    }

    /**
     * 
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
