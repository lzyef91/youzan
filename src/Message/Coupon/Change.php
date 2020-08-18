<?php

/**
 * 商家端和买家端优惠券/码信息
 */

namespace Nldou\Youzan\Message\Coupon;

use Nldou\Youzan\Message\Message;

class Change extends Message
{
    /**
     * @var string
     */
    public $type = 'COUPON_CUSTOMER_PROMOTION';

    /**
     * 消息体内的数据
     * @var array
     */
    protected $properties = [
        // fans_id 用户粉丝id，优先级低于mobile，当 mobile 有值时，fans_id 为0	1000000
        'fans_id' => 'fans_id',
        // 用户粉丝类型，有值时为1（店铺绑定了认证服务号的自有粉丝），优先级低于mobile，当 mobile 有值时，fans_type 为0
        'fans_type' => 'fans_type',
        // 用户手机号
        'mobile' => 'mobile',
        // 优惠券或优惠码ID，券或码的唯一标识 string
        'id' => 'id',
        // 优惠码码值 status=CARD_CONSUME时有值
        'code_value' => 'code_value',
        // 事件发生时间 2017-06-20 10:48:08
        'event_time' => 'event_time',
        /**
         * CARD_CREATED 商家创建优惠券活动
         * UPDATED_CARD 商家更新优惠券活动
         * UPDATED_CARD 商家更新优惠券活动
         * CARD_GROUP_INVALID 商家失效优惠券活动
         * CODE_CREATED 商家创建优惠码活动
         * CODE_UPDATED 商家更新优惠码活动
         * CODE_GROUP_INVALID 商家失效优惠码活动
         * CARD_TAKE 领取优惠券
         * 核销优惠券 CARD_TAKE
         * 收回优惠券 CARD_BACK
         * 领取优惠码 CODE_TAKE
         * 核销优惠码 CODE_CONSUME
         * 收回优惠码 CODE_BACK
         * 买家退回优惠券 CARD_REVERT
         */
        'status' => 'status'
    ];

    /**
     * 消息体外的数据
     * @var array
     */
    protected $extraProperties = [];

    /**
     * @param array $msg
     * @param array $httpData
     */
    public function __construct($msg, $httpData)
    {
        parent::__construct($msg, $httpData);
    }
}