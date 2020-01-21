<?php

namespace App\Logic;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

abstract class Logic
{

    use ResponseTrait;

    protected $model;

    //模型工具类

    /**
     * Logic constructor.
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct()
    {
        $this->makeModel();
    }

    /**
     * 构造模型
     * @return mixed
     */
    abstract public function orm();

    /**
     * 构造模型
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function makeModel()
    {
        //单例化当前模型
        $this->model = app()->make($this->orm());

        if(!$this->model instanceof Model){
            throw new ModelNotFoundException(
                "Class {$this->orm()} must be an instance of Illuminate\Database\Eloquent\Model"
            );
        }
    }

    /**
     * 模型新增数据
     * @param array $data
     * @return $this
     */
    public function create(array $data)
    {
        if($this->createValidator($data)){
            $this->model->create($data);
        }
        return $this;
    }

    abstract public function createValidator(array $data);

    /**
     * @param array $data 验证的数据
     * @param array $rule 验证规则
     * @param array $message 验证响应消息
     * @return bool
     */
    public function validator(array $data, array $rule, array $message = [])
    {
        $res = Validator::make($data, $rule, $message);

        if($res->fails()){
            //验证错误消息设置
            $this->setResponseMsg($res->errors()->first());
            $this->setResponseStatus(false);
            return false;
        }
        return true;
    }

}

