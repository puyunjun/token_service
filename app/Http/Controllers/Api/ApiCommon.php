<?php


namespace App\Http\Controllers\Api;

use App\Http\Api\ApiInterfaces\ApiInterface;

abstract class ApiCommon
{

    protected static $TOKEN;

    /**当前接口需要的所有参数
     * @var array
     */
    protected $needParams = [];

    public function __construct()
    {
        $this->__init();
    }

    abstract public function __init();

    public function getToken(object $call = null)
    {
        if($call instanceof ApiInterface){
            return $call::$key;
        }
        return 24234234;
    }

    public function getSign()
    {
        //
    }
}
