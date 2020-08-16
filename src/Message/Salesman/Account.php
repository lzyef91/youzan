<?php

namespace Nldou\Youzan\Message\Salesman;

use Nldou\Youzan\Message\Message;

class Account extends Message
{
    /**
     * @var string
     */
    public $type = 'salesman_account_event';

    /**
     * Properties.
     *
     * @var array
     */
    protected $properties = [
        // 销售员状态：1：销售员，0:非销售员（清退）
        'state' => 'state',
        // 变更时间：时间戳，单位毫秒，例 1590981916123
        'event_time' => 'event_time',
        // INSERT:新增，UPDATE:修改
        'type' => 'type',
        // 业务ID：店铺Id+销售员userId拼接 ：kdtId_dsUid
        'biz_id' => 'biz_id',
        // 店铺ID
        'kdt_id' => 'kdt_id',
        // 有赞openId
        'yz_open_id' => 'yz_open_id',

        /**
         * 变更前销售员属性值，当type==INSERT时 null
         */
        // 连锁总部id
        'before_root_kdt_id' => 'before.root_kdt_id',
        // 店铺ID
        'before_kdt_id' => 'before.kdt_id',
        // 销售员 yzOpenId
        'before_yz_open_id' => 'before.yz_open_id',
        // 销售员上级 yzOpenId
        'before_from_yz_open_id' => 'before.from_yz_open_id',
        // 销售员等级
        'before_level' => 'before.level',
        // 清退时间，时间戳，单位毫秒，未清退时，fireAt == 0
        'before_fire_at' => 'before.fire_at',
        // 销售员组ID
        'before_group_id' => 'before.group_id',
        // 销售员店铺昵称
        'before_nickname' => 'before.nickname',

        /**
         * 变更后，销售员属性值
         */
        // 连锁总部id
        'after_root_kdt_id' => 'after.root_kdt_id',
        // 店铺ID
        'after_kdt_id' => 'after.kdt_id',
        // 销售员 yzOpenId
        'after_yz_open_id' => 'after.yz_open_id',
        // 销售员上级 yzOpenId
        'after_from_yz_open_id' => 'after.from_yz_open_id',
        // 销售员等级
        'after_level' => 'after.level',
        // 清退时间，时间戳，单位毫秒，未清退时，fireAt == 0
        'after_fire_at' => 'after.fire_at',
        // 销售员组ID
        'after_group_id' => 'after.group_id',
        // 销售员店铺昵称
        'after_nickname' => 'after.nickname',
    ];

    /**
     * @param array $msg
     */
    public function __construct($msg)
    {
        parent::__construct($msg);
    }
}