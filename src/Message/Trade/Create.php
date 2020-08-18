<?php

/**
 * 交易创建
 */

namespace Nldou\Youzan\Message\Trade;

use Nldou\Youzan\Message\Message;

class Create extends Message
{
    /**
     * @var string
     */
    public $type = 'trade_TradeCreate';

    /**
     * Properties.
     *
     * @var array
     */
    protected $properties = [
        // 订单号
        'tid' => 'full_order_info.order_info.tid',

        /**
         * 买家信息
         */
        // 买家昵称
        'fans_nickname' => 'full_order_info.buyer_info.fans_nickname',
        // 粉丝类型 1:自有粉丝; 9:代销粉丝
        'fans_type' => 'full_order_info.buyer_info.fans_type',
        // 粉丝Id
        'fans_id' => 'full_order_info.buyer_info.fans_id',
        // 买家id
        'buyer_id' => 'full_order_info.buyer_info.buyer_id',
        // 外部用户id
        'outer_user_id' => 'full_order_info.buyer_info.outer_user_id',
        // 买家手机号
        'buyer_phone' => 'full_order_info.buyer_info.buyer_phone',
        // 有赞用户id，用户在有赞的唯一id
        'yz_open_id' => 'full_order_info.buyer_info.yz_open_id',

        /**
         * 订单明细
         * api有，消息推送没有 is_pre_sale, pre_sale_type, sku_unique_code
         * 消息推送有，api没有 item_message
         */
        'orders' => 'full_order_info.orders',

        /**
         * 地址信息
         * receiver_name string 收货人姓名
         * receiver_tel String 收货人手机号
         * delivery_province String 省
         * delivery_city String 市
         * delivery_district String 区
         * delivery_address string 详细地址
         * delivery_postal_code String 邮政编码
         * address_extra string 地址扩展信息（经纬度信息）{ln:23.43232,lat:9879.3443243}
         * self_fetch_info String 到店自提信息 json格式
         * delivery_end_time Date 同城送预计送达时间-结束时间 非同城送以及没有开启定时达的订单不返回 2018-01-01 00:00:00
         * delivery_start_time Date 同城送预计送达时间-开始时间 非同城送以及没有开启定时达的订单不返回 2018-01-01 00:00:00
         */
        'address_info' => 'full_order_info.address_info',

        /**
         * 订单信息
         */
        // 订单类型
        // 0:普通订单; 1:送礼订单; 2:代付; 3:分销采购单; 4:赠品; 5:心愿单; 6:二维码订单; 7:合并付货款;
        // 8:1分钱实名认证; 9:品鉴; 10:拼团; 15:返利; 35:酒店; 40:外卖; 41:堂食点餐; 46:外卖买单;
        // 51:全员开店; 52:保证金; 61:线下收银台订单; 71:美业预约单; 72:美业服务单; 75:知识付费; 81:礼品卡; 100:批发
        'order_type' => 'full_order_info.order_info.type',
        // 支付类型
        // 0:默认值,未支付; 1:微信自有支付; 2:支付宝wap; 3:支付宝wap; 5:财付通; 7:代付; 8:联动优势;
        // 9:货到付款; 10:大账号代销; 11:受理模式; 12:百付宝; 13:sdk支付; 14:合并付货款; 15:赠品;
        // 16:优惠兑换; 17:自动付货款; 18:爱学贷; 19:微信wap; 20:微信红包支付; 21:返利; 22:ump红包;
        // 24:易宝支付; 25:储值卡; 27:qq支付; 28:有赞E卡支付; 29:微信条码; 30:支付宝条码; 33:礼品卡支付;
        // 35:会员余额; 72:微信扫码二维码支付; 100:代收账户; 300:储值账户; 400:保证金账户; 101:收款码;
        // 102:微信; 103:支付宝; 104:刷卡; 105:二维码台卡; 106:储值卡; 107:有赞E卡; 110:标记收款-自有微信支付;
        // 111:标记收款-自有支付宝; 112:标记收款-自有POS刷卡; 113:通联刷卡支付; 200:记账账户; 201:现金
        'pay_type' => 'full_order_info.order_info.pay_type',
        // 物流类型 0:快递发货; 1:到店自提; 2:同城配送; 9:无需发货（虚拟商品订单）
        'express_type' => 'full_order_info.order_info.express_type',
        // 主订单状态
        // WAIT_BUYER_PAY （等待买家付款）； TRADE_PAID（订单已支付 ）；
        // WAIT_CONFIRM（待确认，包含待成团、待接单等等。即：买家已付款，等待成团或等待接单）；
        // WAIT_SELLER_SEND_GOODS（等待卖家发货，即：买家已付款）；
        // WAIT_BUYER_CONFIRM_GOODS (等待买家确认收货，即：卖家已发货) ；
        // TRADE_SUCCESS（买家已签收以及订单成功）；
        // TRADE_CLOSED（交易关闭）；
        // PS：TRADE_PAID状态仅代表当前订单已支付成功，表示瞬时状态，稍后会自动修改成后面的状态。如果不关心此状态请再次请求详情接口获取下一个状态。
        'status' => 'full_order_info.order_info.status',
        // 订单关闭类型
        //  0:未关闭; 1:过期关闭; 2:标记退款; 3:订单取消; 4:买家取消; 5:卖家取消; 6:部分退款;
        // 10:无法联系上买家; 11:买家误拍或重拍了; 12:买家无诚意完成交易; 13:已通过银行线下汇款;
        // 14:已通过同城见面交易; 15:已通过货到付款交易; 16:已通过网上银行直接汇款; 17:已经缺货无法交易
        'close_type' => 'full_order_info.order_info.close_type',
        // 订单创建时间，例2018-01-01 00:00:00
        'created_time' => 'full_order_info.order_info.created',
        // 订单更新时间，例2018-01-01 00:00:00
        'update_time' => 'full_order_info.order_info.update_time',

        /**
         * 订单优惠信息
         */
        // 订单优惠总金额
        'promo_order_discount_fee' => 'order_promotion.order_discount_fee',
        // 商品优惠总金额
        'promo_item_discount_fee' => 'order_promotion.item_discount_fee',
        // 订单改价金额
        'promo_adjust_fee' => 'order_promotion.adjust_fee',
        // 订单级优惠信息 array
        'promo_order' => 'order_promotion.order',
        // 商品级优惠信息 array
        'promo_item' => 'order_promotion.item'
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