<?php


namespace App\Http\Controllers\Api\AppletApis;


use App\Facades\TokenServerFacade;
use App\Http\Controllers\Api\ApiCommon;
use App\Models\ApisInfo;
use App\Services\Api\RsaServer;
use App\Services\Api\CheckTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;

class TestApiController extends  ApiCommon
{


    public function __init()
    {

    }


    public function index()
    {
        //
        $rsa = new RsaServer();

       // $appKey = $rsa->privateDecrypt('N74MH4BGMGLKEeaxVndHGKAx87xYJfmA3PkaY+R98uDh0eKO1u1I6DKBANdUUpS5SCgsx1RpMt1Azect/FpwL89b3IyP+R8M2npbZ333daAfMwcQwayoqnLgPpR4znJM6SjUbAZ7OKEAminZ3398I9W/RNPmy/pvjriRRnqTmNo=');
        $appKey = $rsa->publicDecrypt("hSTpPlnuU4/vW8UxDP8zRmHfLXKFMh5eRiM3ShT4XwTdyBQXrXr4mhL/nelftQ7xUBUjB3Gy1/1KbFaJNF+oKIHbohUHpegBsO2FOKwqP/meDojWjxMHhbMrPvpOwVyoKGDXtULBIHhWdEVYAR9DCCkcXeCk3xEqRMLhUOecq3k=");
        return $appKey;
        $token = request()->token;
        $sign = request()->sign;
        $timestamp = request()->timestamp;

        //$test = TokenServerFacade::checkParams($this->needParams);
        $code = request()->code;

        try {
            $test = TokenServerFacade::appletLogin($code);

            TokenServerFacade::openId();
            TokenServerFacade::sessionKey();

        }catch (\Exception $e){

            return response()->json($e->getMessage());
        }

        return response()->json($test);


    }

    public function show(Request $request, $arg)
    {

        $a = new CheckTools();

        $test = $this->getToken($a);

        return response()->json($test);
        //$arg 为路由第一个参数

        //id为路由指定参数名
        $id = $request->route('id');
        $id = $request->id;
        $id = Route::input('id');
        //$id =  request('id');;
        //
        return response()->json([
            $arg,
            $id,
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
