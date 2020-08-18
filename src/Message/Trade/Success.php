<?php

/**
 * 交易成功
 */

namespace Nldou\Youzan\Message\Trade;

use Nldou\Youzan\Message\Message;

class Success extends Message
{
    /**
     * @var string
     */
    public $type = 'trade_TradeSuccess';

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