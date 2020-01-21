<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhotosController extends Controller
{
    //测试RESTful设计模式
    public function index()
    {
        //
        return response()->json([
            'This is Action of '.request()->route()->getActionName(),
        ]);
    }

    public function show()
    {
        //
        return response()->json([
            'This is Action of '.request()->route()->getActionName(),
        ]);
    }

    public function destroy()
    {
        //
        return response()->json([
            'This is Action of'.request()->method(),
        ]);
    }

    public function store()
    {
        //
        return response()->json([
            'This is Action of '.request()->route()->getActionName(),
        ]);
    }

    public function create()
    {
        //
        return response()->json([
            'This is Action of'.request()->method(),
        ]);
    }

    public function update(Request $request)
    {
        //
        return response()->json([
            'This is Action of '.request()->route()->getActionName(),
        ]);
    }

    public function edit()
    {
        //
        return response()->json([
            'This is Action of'.request()->method(),
        ]);
    }
}
