<?php

namespace Nldou\Youzan\Message;

use Nldou\Youzan\Message\Trade\Create;
use Nldou\Youzan\Message\Trade\BuyerPay;
use Nldou\Youzan\Message\Trade\SellerShip;
use Nldou\Youzan\Message\Trade\PartlySellerShip;
use Nldou\Youzan\Message\Trade\Success;
use Nldou\Youzan\Message\Trade\Close;
use Nldou\Youzan\Message\Trade\AddressChange;
use Nldou\Youzan\Message\Salesman\Account;
use Nldou\Youzan\Message\Salesman\OrderSettle;
use Illuminate\Support\Arr;

class Message
{
    const TRADE_CREATE = 'trade_TradeCreate';
    const TRADE_BUYER_PAY = 'trade_TradeBuyerPay';
    const TRADE_SELLER_SHIP = 'trade_TradeSellerShip';
    const TRADE_PARTLY_SELLER_SHIP = 'trade_TradePartlySellerShip';
    const TRADE_SUCCESS = 'trade_TradeSuccess';
    const TRADE_CLOSE = 'trade_TradeClose';
    const TRADE_ADDRESS_CHANGE = 'trade_MessagesTheChangeAddresses';
    const SALESMAN_ACCOUNT_EVENT = 'salesman_account_event';
    const SALESMAN_ORDER_SETTLE = 'salesman_order_settle_state_update';

    const MESSAGE_TYPE_MAP = [
        'trade_TradeCreate' => Create::class,
        'trade_TradeBuyerPay' => BuyerPay::class,
        'trade_TradeSellerShip' => SellerShip::class,
        'trade_TradePartlySellerShip' => PartlySellerShip::class,
        'trade_TradeSuccess' => Success::class,
        'trade_TradeClose' => Close::class,
        'trade_MessagesTheChangeAddresses' => AddressChange::class,
        'salesman_account_event' => Account::class,
        'salesman_order_settle_state_update' => OrderSettle::class
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