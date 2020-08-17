<?php

/**
 * 订单部分发货
 */

namespace Nldou\Youzan\Message\Trade;

use Nldou\Youzan\Message\Message;

class PartlySellerShip extends Message
{
    /**
     * @var string
     */
    public $type = 'trade_TradePartlySellerShip';

    /**
     * Properties.
     *
     * @var array
     */
    protected $properties = [
        // 订单号
        'tid' => 'tid',
        // 订单明细号 string 例123456,234567,124343243
        'oids' => 'oids',
        // 更新时间
        'update_time' => 'update_time'
    ];

    /**
     * @param array $msg
     */
    public function __construct($msg)
    {
        parent::__construct($msg);
    }
}