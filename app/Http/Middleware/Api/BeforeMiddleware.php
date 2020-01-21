<?php


namespace App\Http\Middleware\Api;

use App\Models\ApisInfo;
use Closure;

class BeforeMiddleware
{

    protected $apiType;

    protected $params = array();

    protected $typeInfo;

    const OPEN_API = 'OPEN';

    const SAFE_API = 'SAFE';


    public function __construct()
    {
    }

    /**
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {
        logger('api-request:' . $request->path(), $request->all());
        logger('api-request:' .request()->getClientIp().':' . $request->route()->getName());

        $this->isProtect();
        logger($this->typeInfo);

        if($this->apiType === self::SAFE_API){
            try {
                $this->checkSafeParams($this->params);
            }catch (\Exception $e){
                return response($e->getMessage());
            }
        }
        //request()->offsetSet('params',json_encode($this->params));
        //request()->offsetSet('api_type',$this->apiType);

        return $next($request);
    }

    /**
     * @param array $params 接口参数值
     * @throws \Exception
     */
   final public function checkSafeParams(array $params = [])
    {

        foreach ($params as $item){
            if(!request()->$item){
                throw new \Exception(
                    json_encode([
                        'code'=>40001,
                        'msg'=>"Parameter {$item} value missing",
                    ])
                );
            }
        }
    }

    /**
     * 接口类型判断并设置相关的值
     */
   final public function isProtect()
    {
        $routeName = request()->route()->getName();

        $apiType = ApisInfo::where('api_route','=',$routeName)->first();

        $this->params = $apiType->params ? explode(',',$apiType->params) : [];

        if($apiType->api_type === 1){
            //开放接口
            $this->apiType = self::OPEN_API;

            $this->typeInfo = '开放类接口';
        }else{

            //非开放接口，使用token验证机制
            app()->singleton('token.server',function (){
                return new \App\Services\Api\CheckTools();
            });

            $this->apiType = self::SAFE_API;

            $this->typeInfo = '非开放类接口';
        }

    }
}
