<?php

/**
 * 订单发货
 */

namespace Nldou\Youzan\Message\Trade;

use Nldou\Youzan\Message\Message;

class SellerShip extends Message
{
    /**
     * @var string
     */
    public $type = 'trade_TradeSellerShip';

    /**
     * Properties.
     *
     * @var array
     */
    protected $properties = [
        // 订单号
        'tid' => 'tid',
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