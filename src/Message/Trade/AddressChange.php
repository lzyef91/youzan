<?php

/**
 * 卖家修改收货地址
 */

namespace Nldou\Youzan\Message\Trade;

use Nldou\Youzan\Message\Message;

class AddressChange extends Message
{
    /**
     * @var string
     */
    public $type = 'trade_MessagesTheChangeAddresses';

    /**
     * Properties.
     *
     * @var array
     */
    protected $properties = [
        // 订单号
        'tid' => 'tid',
        // 收货人
        'user_name' => 'user_name',
        // 收货手机
        'tel' => 'tel',
        // 完整地址，country+province+city+district+detail
        'address' => 'address',
        // 国家
        'country' => 'country',
        // 省
        'province' => 'province',
        // 城市
        'city' => 'city',
        // 区
        'district' => 'district',
        // 街道
        'detail' => 'detail',
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