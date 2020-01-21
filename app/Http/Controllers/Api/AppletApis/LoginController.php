<?php


namespace App\Http\Controllers\Api\AppletApis;

use App\Http\Controllers\Controller;
use App\Services\RsaServer;
use App\Services\TokenServer;
use GuzzleHttp\Client;

class LoginController extends Controller
{

    protected $appId;

    protected $appSecret;

    public $rsa;

    public function __construct($prefix='')
    {
        $this->appId = config($prefix ? $prefix.'appId' : 'wechat.default.appId');
        $this->appSecret = config($prefix ? $prefix.'appSecret' : 'wechat.default.appSecret');

        $this->rsa = new RsaServer();
    }

    //小程序用户登陆控制器
    public function index()
    {

        $code = request()->code;
        try {
            $info = $this->appletLogin($code);
            $sign = (new  TokenServer())->makeSign();

            $info['sign'] = $sign;
        }catch (\Exception $e){

            return response()->json($e->getMessage());
        }

        return response()->json($info);
    }

    /**
     * 小程序登陆
     * @param string $code
     * @return mixed
     * @throws \Exception
     */
    private function appletLogin($code = '')
    {
        try{
            $client = new Client();

            $response = $client->get("https://api.weixin.qq.com/sns/jscode2session?appid=$this->appId&secret=$this->appSecret&js_code=$code&grant_type=authorization_code");

            $contents = $response->getBody()->getContents();

            //请求成功，生成token返回
            $info =  json_decode($contents,true);

            if(isset($info['errcode']) && $info['errcode'] !==0){
                throw new \Exception( json_encode($info));
            }
        }catch (\Exception $e){
            throw new \Exception( $e->getMessage());
        }

        $info['token'] = $this->getToken(json_encode([
                'app_key'=>substr(env('APP_KEY'),7),
                'openid'=>$info['openid'],
                'expire'=>time()+24*60*60
            ])
        );

        return $info;
    }


    public function getToken($data)
    {
        return $this->rsa->publicEncrypt($data);
    }

}
