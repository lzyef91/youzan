<?php

namespace Nldou\Youzan\Message;

use Nldou\Youzan\Message\Trade\Create;
use Nldou\Youzan\Message\Trade\BuyerPay;
use Nldou\Youzan\Message\Trade\SellerShip;
use Nldou\Youzan\Message\Trade\Success;
use Nldou\Youzan\Message\Trade\Close;
use Nldou\Youzan\Message\Salesman\Account;
use Illuminate\Support\Arr;

class Message
{
    const TRADE_CREATE = 'trade_TradeCreate';
    const TRADE_BUYER_PAY = 'trade_TradeBuyerPay';
    const TRADE_SELLER_SHIP = 'trade_TradeSellerShip';
    const TRADE_SUCCESS = 'trade_TradeSuccess';
    const TRADE_CLOSE = 'trade_TradeClose';

    const MESSAGE_TYPE_MAP = [
        'trade_TradeCreate' => Create::class,
        'trade_TradeBuyerPay' => BuyerPay::class,
        'trade_TradeSellerShip' => SellerShip::class,
        'trade_TradeSuccess' => Success::class,
        'trade_TradeClose' => Close::class,
        'salesman_account_event' => Account::class
    ];

    /**
     * 消息体
     * @var array
     */
    protected $msg;

    /**
     * Properties.
     *
     * @var array
     */
    protected $properties = [];

    /**
     * @param array $msg
     */
    public function __construct($msg)
    {
        $this->msg = $msg;
    }

    public function getProperty($name)
    {
        if (array_key_exists($name, $this->properties)) {
            $key = $this->properties[$name];
            return Arr::get($this->msg, $key);
        } else {
            return NULL;
        }
    }

    public function getAllProperties()
    {
        return $this->msg;
    }

    public function __get($prop)
    {
        return $this->getProperty($prop);
    }
}