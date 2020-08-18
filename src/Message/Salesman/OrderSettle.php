<?php

/**
 * 销售员订单结算状态变更
 */

namespace Nldou\Youzan\Message\Salesman;

use Nldou\Youzan\Message\Message;

class OrderSettle extends Message
{
    /**
     * @var string
     */
    public $type = 'salesman_order_settle_state_update';

    /**
     * Properties.
     *
     * @var array
     */
    protected $properties = [
        // 订单号
        'tid' => 'tid',

        // 订单结算状态
        // -1 错误状态 0 人工结算 1 待自动结算  2 已自动结算
        // 3 未结算,余额不足 4 分润失败，系统次日结算
        // 5 货到付款订单不参与结算 6 使用会员折扣,不结算
        // 11 待人工结算 12 已人工结算
        'settle_state' => 'settleState',

        // 订单佣金，单位分
        'cps_money' => 'cpsMoney',

        // 更新时间
        'update_time' => 'update_time'
    ];

    /**
     * @param array $msg
     * @param array $httpData
     */
    public function __construct($msg, $httpData)
    {
        parent::__construct($msg, $httpData);
    }
}