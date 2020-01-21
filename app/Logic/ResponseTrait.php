<?php


namespace App\Logic;


trait ResponseTrait
{
    /**
     * 验证结果状态  true验证成功，false 验证失败
     * @var bool
     */
    protected $responseStatus = true;

    /**
     * 响应消息
     * @var string
     */
    protected $responseMsg;

    /**
     * 设置响应消息
     * @param string $message
     */
    public function setResponseMsg($message = '')
    {
        $this->responseMsg = $message;
    }

    /**
     * @return string
     */
    public function getResponseMsg()
    {
        return $this->responseMsg;
    }

    /**
     * 设置状态
     * @param bool $status
     */
    public function setResponseStatus(bool $status)
    {
        $this->responseStatus = $status;
    }

    /**
     * @return bool
     */
    public function getResponseStatus()
    {
        return $this->responseStatus;
    }
}
