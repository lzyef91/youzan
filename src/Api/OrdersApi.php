<?php

namespace Nldou\Youzan\Api;

use Nldou\Youzan\Token;

class OrdersApi extends YouzanApi
{
    public function __construct(Token $token)
    {
        parent::__construct($token);
    }

    /**
     * 订单详情
     */
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

    /**
     * 订单列表（包含所有类型和状态的订单）
     */
    public function tradesIndex($params = [])
    {
        $method = 'youzan.trades.sold.get';
        $version = '4.0.1';
        $paramsMap = [
            'page_no',
            'page_size',
            'tid', // 订单号
            'fans_id', // 粉丝id
            'buyer_id', // 买家ID
            'yz_open_id', // 有赞对外统一openId
            'keywords', // 通用搜索字段，使用底层符合条件查询搜索
            'goods_id', // 商品id
            'goods_title', // 商品标题
            'receiver_name', // 收获人昵称
            'receiver_phone', // 收货人电话

            // 粉丝类型
            // 0:未知，1:微信自有粉丝，2:微博，9:代销粉丝，105:知乎,
            // 128:有赞精选app, 188:QQ，312:腾讯云，736:支付宝，
            // 1180:百度，1181:今日头条，1590:微信广告，56473:陌陌
            // 59011:线下微信支付产生的粉丝，59465:线下支付宝支付，4591:有人,
            // 16940:快手，26879:上鱼，6227:精选小程序，61489:虎牙
            'fans_type',

            /**
             * 订单类型
             * NORMAL：普通订单
             * PEERPAY：代付
             * GIFT：我要送人
             * FX_CAIGOUDAN：分销采购单
             * PRESENT：赠品
             * WISH：心愿单
             * QRCODE：二维码订单
             * QRCODE_3RD：线下收银台订单
             * FX_MERGED：合并付货款
             * VERIFIED：1分钱实名认证
             * PINJIAN：品鉴
             * REBATE：返利
             * FX_QUANYUANDIAN：全员开店
             * FX_DEPOSIT：保证金
             * PF：批发
             * GROUP：拼团
             * KNOWLEDGE_PAY：知识付费
             * GIFT_CARD：礼品卡（参照微商城模块）
             */
            'type',

            /**
             * 订单状态，一次只能查询一种状态
             * 待付款：WAIT_BUYER_PAY
             * 待发货：WAIT_SELLER_SEND_GOODS
             * 等待买家确认：WAIT_BUYER_CONFIRM_GOODS
             * 订单完成：TRADE_SUCCESS
             * 订单关闭：TRADE_CLOSE（新增-参照微商城模块）
             * 退款中：TRADE_REFUND
             */
            'status',

            /**
             * 物流类型搜索
             * 同城送订单：LOCAL_DELIVERY
             * 自提订单：SELF_FETCH
             * 快递配送：EXPRESS
             */
            'express_type',

            /**
             * 按订单创建时间，例:2017-01-01 12:00:00;
             * 开始时间和结束时间的跨度不能大于3个月;
             * 结束时间必须大于开始时间;
             * 开始时间和结束时间必须成对出现
             */
            'start_created',
            'end_created',

            /**
             * 按订单更新时间，例:2017-01-01 12:00:00;
             * 开始时间和结束时间的跨度不能大于3个月;
             * 结束时间必须大于开始时间;
             * 开始时间和结束时间必须成对出现
             */
            'start_update',
            'end_update',

            // boolean 是否需要返回订单url
            'need_order_url',
        ];
        $forceParamsMap = [];
        $params = $this->loadParams($params, $paramsMap, $forceParamsMap);
        return $this->request($method, $version, $params);
    }
}