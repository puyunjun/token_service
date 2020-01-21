<?php


namespace App\Services\Api;


use App\Http\Api\ApiInterfaces\ApiInterface;

use Illuminate\Support\Facades\Redis;


class CheckTools implements ApiInterface
{

    public $rsa;

    public $redis;

    //token超时状态码
    const TOKEN_OVERTIME_STATUS = 40003;

    const TOKEN_OVERTIME_MSG = 'token过期';

    const TOKEN_ILLEGAL_STATUS = 40004;

    const TOKEN_ILLEGAL_MSG = '非法token,APP_KEY不匹配';

    public $token;

    public function __construct()
    {
        $this->rsa = new RsaServer();

        $this->redis = Redis::connection();

        $this->token = '';
    }



    /**检查token是否正确
     * @param string $token
     * @return bool
     * @throws \Exception
     */
    public function checkToken($token = '')
    {
        $decry = $this->rsa->privateDecrypt($token);

        $decry_arr = json_decode($decry,true);

        $app_key = $decry_arr['app_key'];

        $expire = $decry_arr['expire'] ?? 0;

        if($expire < time()){
            throw new \Exception(json_encode(['code'=>self::TOKEN_OVERTIME_STATUS,'msg'=>self::TOKEN_OVERTIME_MSG]));
        }
        if($app_key !== substr(env('APP_KEY'),7)){
            throw new \Exception(json_encode(['code'=>self::TOKEN_ILLEGAL_STATUS,'msg'=>self::TOKEN_ILLEGAL_MSG]));
        }
        return  true;
    }

    public function checkSign($sortStr = ''){

        $timestamp = request()->timestamp;

        $nonce = request()->nonce;

        $sign = request()->sign;

        $token = $this->token;

    }

}
