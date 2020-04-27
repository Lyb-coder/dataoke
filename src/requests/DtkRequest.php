<?php
declare (strict_types=1);

namespace DaTaoKe\Requests;

use DaTaoKe\Util\ArrayObject;

abstract class DtkRequest
{
    use ArrayObject;

    /**
     * 接口版本号
     */
    public $version = '';
    /**
     * 接口版本号
     */
    public $requestMethod = 'GET';
    /**
     * 接口地址
     */
    protected $gateway = 'https://openapi.dataoke.com/api';
    /**
     * 接口链接
     */
    public $api = '';
    /**
     * 公共参数
     */
    public $apiParas = [];
    /**
     * 额外参数
     */
    public $extraParas = [];
    /**
     * 接口返回数据
     */
    public $apiData = [];
    /**
     * 额外参数字段
     */
    public $extraParasField = [];

    /**
     * 设置公共参数
     * @param array $apiParas
     */
    public function setApiParas(array $apiParas): self
    {
        $this->apiParas = $apiParas;
        return $this;
    }

    /**
     * 设置额外参数
     * @param array $extraParas
     */
    public function setExtraParas(array $extraParas)
    {
        $this->extraParas = array_intersect(array_flip(array_values($this->extraParasField)), $extraParas);
        return $this;
    }

    /**
     * 获取接口请求参数
     * @return array
     */
    public function getRequestParas(): array
    {
        return array_merge((array)$this->apiParas, (array)$this->extraParas);
    }

    /**
     * 请求到的数据处理
     */
    public function DataProcessing($data)
    {
        $data = (object)json_decode($data, true);
        //错误码检查
        if (!$this->ErrorCode((int)$data->code)) {
            throw new \InvalidArgumentException((string)$data->msg);
        }
        $this->apiData = $data->data;
    }

    /**
     * 错误码检查
     */
    protected function ErrorCode(int $code)
    {
        if ($code == 0) {
            return true;
        } else {
            return false;
        }
    }
}