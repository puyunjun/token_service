<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index()
    {
        //测试请求RESTful页面
        return response()->view(
            'index.index',[]
        );
    }
}
