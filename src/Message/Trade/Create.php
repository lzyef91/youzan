<?php

namespace Nldou\Youzan\Message\Trade;

use Nldou\Youzan\Message\Message;

class Create extends Message
{
    /**
     * @var string
     */
    public $type = 'trade_TradeCreate';

    /**
     * Properties.
     *
     * @var array
     */
    protected $properties = [
        'tid' => 'full_order_info.order_info.tid',
        /* pay info */
        'total_fee' => 'full_order_info.pay_info.total_fee',
        'post_fee' => 'full_order_info.pay_info.post_fee',
        'payment' => 'full_order_info.pay_info.payment',
        /* buyer info */
        'fans_nickname' => 'full_order_info.buyer_info.fans_nickname',
        'fans_type' => 'full_order_info.buyer_info.fans_type',
        'fans_id' => 'full_order_info.buyer_info.fans_id',
        'buyer_id' => 'full_order_info.buyer_info.buyer_id',
        'outer_user_id' => 'full_order_info.buyer_info.outer_user_id',
        'buyer_phone' => 'full_order_info.buyer_info.buyer_phone',
        /* source info */
        'platform' => 'full_order_info.source_info.source.platform',
        'wx_entrance' => 'full_order_info.source_info.source.wx_entrance',
        /* orders */
        /* 消息api有，推送没有 is_pre_sale, pre_sale_type, sku_unique_code */
        /* 消息推送有，api没有 item_message,  */
        'orders' => 'full_order_info.orders',
        /* address info */
        'address_info' => 'full_order_info.address_info',
        /* order info */
        'order_type' => 'full_order_info.order_info.type',
        'pay_type' => 'full_order_info.order_info.pay_type',
        'express_type' => 'full_order_info.order_info.express_type',
        'status' => 'full_order_info.order_info.status',
        'close_type' => 'full_order_info.order_info.close_type',
        'created_time' => 'full_order_info.order_info.created',
        'update_time' => 'full_order_info.order_info.update_time',
        /* promo info */
        /* 订单优惠总金额 */
        'promo_order_discount_fee' => 'order_promotion.order_discount_fee',
        /* 商品优惠总金额 */
        'promo_item_discount_fee' => 'order_promotion.item_discount_fee',
        /* 订单改价金额 */
        'promo_adjust_fee' => 'order_promotion.adjust_fee'
    ];

    /**
     * @param array $msg
     */
    public function __construct($msg)
    {
        parent::__construct($msg);
    }
}