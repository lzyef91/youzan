<?php

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
        'tid' => 'tid',
        'close_reson' => 'close_reson',
        'close_type' => 'close_type',
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