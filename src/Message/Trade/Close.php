<?php

namespace Nldou\Youzan\Message\Trade;

use Nldou\Youzan\Message\Message;

class Close extends Message
{
    /**
     * @var string
     */
    public $type = 'trade_TradeClose';

    /**
     * Properties.
     *
     * @var array
     */
    protected $properties = [
        'tid' => 'tid',
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