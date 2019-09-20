<?php

namespace Nldou\Youzan\Api;

use Nldou\Youzan\Token;

class OrdersApi extends YouzanApi
{
    public function __construct(Token $token)
    {
        parent::__construct($token);
    }

    public function tradeShow($params = [])
    {
        $method = 'youzan.trade.get';
        $version = '4.0.0';
        $paramsMap = [];
        $forceParamsMap = [
            'tid' // 订单号
        ];
        $params = $this->loadParams($params, $paramsMap, $forceParamsMap);
        return $this->request($method, $version, $params);
    }

    public function tradesIndex($params = [])
    {
        $method = 'youzan.trades.sold.get';
        $version = '4.0.0';
        $paramsMap = [
            'type', // 订单类型
            'status', // 订单状态
            'express_type', // 物流类型
            'tid', // 订单号
            'goods_id', // 商品id
            'fans_type',
            'fans_id',
            'buyer_id', // 买家ID
            'receiver_name', // 收获人昵称
            'receiver_phone', // 收货人电话
            'start_created', // DateTimeStr 跨度不能超过3个月
            'end_created',
            'start_update',
            'end_update',
            'page_no',
            'page_size',
            'need_order_url', // boolean 是否需要返回订单url
        ];
        $forceParamsMap = [];
        $params = $this->loadParams($params, $paramsMap, $forceParamsMap);
        return $this->request($method, $version, $params);
    }
}