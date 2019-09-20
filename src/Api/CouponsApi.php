<?php

namespace Nldou\Youzan\Api;

use Nldou\Youzan\Token;

class CouponsApi extends YouzanApi
{
    public function __construct(Token $token)
    {
        parent::__construct($token);
    }

    public function index($params = [])
    {
        $method = 'youzan.ump.coupon.search';
        $version = '3.0.0';
        $paramsMap = [];
        $forceParamsMap = [
            'group_type', // 活动类型。PROMOCARD：优惠券；PROMOCODE：优惠码
            'status', // 活动状态。FUTURE：未开始 ；END：已结束；ON：进行中 （默认查所有状态）
            'page_size',
            'page_no'
        ];
        $params = $this->loadParams($params, $paramsMap, $forceParamsMap);
        return $this->request($method, $version, $params);
    }
}