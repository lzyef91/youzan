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

    public function show($params = [])
    {
        $method = 'youzan.ump.promocard.detail.get';
        $version = '3.0.1';
        $paramsMap = [];
        $forceParamsMap = [
            'id', // 优惠券id
        ];
        $params = $this->loadParams($params, $paramsMap, $forceParamsMap);
        return $this->request($method, $version, $params);
    }

    public function take($params = [])
    {
        $method = 'youzan.ump.coupon.take';
        $version = '3.0.0';
        $paramsMap = [];
        $forceParamsMap = [
            'coupon_group_id', // 优惠券/码活动ID
            'weixin_openid', // 微信服务号对应的openid
        ];
        $params = $this->loadParams($params, $paramsMap, $forceParamsMap);
        return $this->request($method, $version, $params);
    }

    public function fetchlogs($params = [])
    {
        $method = 'youzan.ump.coupon.consume.fetchlogs.get';
        $version = '3.0.0';
        $paramsMap = [
            'end_taked', // 领取时间结束，2019-03-29 16:40:00
            'start_taked'// 领取时间开始，2019-03-29 16:40:00
        ];
        $forceParamsMap = [
            'page_no',
            'page_size',
            'coupon_group_id', // 优惠券/码活动ID
        ];
        $params = $this->loadParams($params, $paramsMap, $forceParamsMap);
        return $this->request($method, $version, $params);
    }
}