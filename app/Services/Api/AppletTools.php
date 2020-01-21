<?php


namespace App\Services\Api;


use Illuminate\Support\Facades\Redis;

class AppletTools
{

    public $rsa;

    public $redis;

    public $token;

    public $sign;

    public function __construct()
    {
        $this->rsa = new RsaServer();

        $this->redis = Redis::connection();
    }

    /**
     * @param string $openid
     * @return $this
     */
    public function makeToken($openid = '')
    {
        $this->token = $this->rsa->publicEncrypt(json_encode([
                'app_key'=>substr(env('APP_KEY'),7),
                'openid'=>$openid,
                'expire'=>time()+2*60*60
            ])
        );

        return $this;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return mixed
     */
    public function getSign()
    {
        return $this->sign;
    }

    /**
     * 生成签名
     * @param string $str
     * @return array
     */
    public function makeSign($str = '')
    {
        //使用token数据的openid
        $openid = json_decode($this->rsa->privateDecrypt(request()->token),true)['openid'];

        $timestamp = time();

        $nonce = $this->createNoncestr();

        $token  = request()->token;

        $tmpArr = array($token, $timestamp, $nonce, $str);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $sign = sha1($tmpStr);

        //redis记录sign
        $this->redis->set($openid.'sign', $sign);

        //设置签名生存期
        $this->redis->expire($openid.'sign', 20);

        $this->sign = $sign;

        return  ['time'=>$timestamp,'nonceStr'=>$nonce,'sign'=>$sign];
    }

    /**创建随机字符串
     * @param int $length
     * @return string
     */
    public function createNoncestr($length = 8){
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for($i = 0; $i < $length; $i ++) {
            $str .= substr ( $chars, mt_rand ( 0, strlen ( $chars ) - 1 ), 1 );
        }
        return $str;
    }
}
