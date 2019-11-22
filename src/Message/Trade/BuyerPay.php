<?php

namespace Nldou\Youzan\Message\Trade;

use Nldou\Youzan\Message\Message;

class BuyerPay extends Message
{
    /**
     * @var string
     */
    public $type = 'trade_TradeBuyerPay';

    /**
     * Properties.
     *
     * @var array
     */
    protected $properties = [
        'tid' => 'full_order_info.order_info.tid',
        'created' => 'full_order_info.order_info.created',
        'promo_order' => 'order_promotion.order'
    ];

    /**
     * @param array $msg
     */
    public function __construct($msg)
    {
        parent::__construct($msg);
    }
}