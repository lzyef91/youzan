<?php

/**
 * 交易关闭
 */

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
        // 订单号
        'tid' => 'tid',

        // 订单关闭原因
        // 订单退款关单，refund, order closed!
        // 订单主动取消，close by buyer, order canceled!
        // 超时未付款系统关单，order expired closed by task, order canceled!
        'close_reson' => 'close_reson',

        // 关闭类型 0:未关闭;1:过期关闭;2:标记退款;3:订单取消;4:买家取消;5:卖家取消;6:部分退款;
        // 10:无法联系上买家;11:买家误拍或重拍了;12:买家无诚意完成交易;13:已通过银行线下汇款;
        // 14:已通过同城见面交易;15:已通过货到付款交易;16:已通过网上银行直接汇款;17:已经缺货无法交易;18:扣款失败;
        'close_type' => 'close_type',

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