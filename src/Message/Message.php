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
use Nldou\Youzan\Message\Salesman\CustomerRelationChange;
use Nldou\Youzan\Message\Coupon\Change as CouponChange;
use Nldou\Youzan\Message\Customer\Change as CustomerChange;
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
    const SALESMAN_CUSTOMER_RELATION_CHANGE = 'salesman_customer_relation_change_biz';

    const COUPON_CHANGE = 'COUPON_CUSTOMER_PROMOTION';

    const CUSTOMER_CHANGE = 'SCRM_CUSTOMER_EVENT';

    const MESSAGE_TYPE_MAP = [
        'trade_TradeCreate' => Create::class,
        'trade_TradeBuyerPay' => BuyerPay::class,
        'trade_TradeSellerShip' => SellerShip::class,
        'trade_TradePartlySellerShip' => PartlySellerShip::class,
        'trade_TradeSuccess' => Success::class,
        'trade_TradeClose' => Close::class,
        'trade_MessagesTheChangeAddresses' => AddressChange::class,
        'salesman_account_event' => Account::class,
        'salesman_order_settle_state_update' => OrderSettle::class,
        'salesman_customer_relation_change_biz' => CustomerRelationChange::class,
        'COUPON_CUSTOMER_PROMOTION' => CouponChange::class,
        'SCRM_CUSTOMER_EVENT' => CustomerChange::class
    ];

    /**
     * 推送消息
     * @var array
     */
    protected $httpData;

    /**
     * 消息体
     * 推送消息内msg字段内的数据
     * 没有msg字段则包含全部推送消息内的数据
     * @var array
     */
    protected $msg;

    /**
     * 消息体内的数据
     * @var array
     */
    protected $properties = [];

    /**
     * 消息体外的数据
     * @var array
     */
    protected $extraProperties = [];


    /**
     * @param array $msg
     */
    public function __construct($msg, $httpData)
    {
        $this->msg = $msg;
        $this->httpData = $httpData;
    }

    public function getProperty($name)
    {
        if (\array_key_exists($name, $this->properties)) return Arr::get($this->msg, $this->properties[$name]);

        if (\array_key_exists($name, $this->extraProperties)) return Arr::get($this->httpData, $this->extraProperties[$name]);

        return NULL;
    }

    public function getAllProperties()
    {
        $ret = [];

        foreach ($this->properties as $k => $p) {
            $ret[$k] = Arr::get($this->msg, $p);
        }

        foreach ($this->extraProperties as $k => $p) {
            $ret[$k] = Arr::get($this->httpData, $p);
        }

        return $ret;
    }

    public function __get($prop)
    {
        return $this->getProperty($prop);
    }
}