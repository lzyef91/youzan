<?php

/**
 * 客户创建和信息更新
 */

namespace Nldou\Youzan\Message\Customer;

use Nldou\Youzan\Message\Message;

class Change extends Message
{
    /**
     * @var string
     */
    public $type = 'SCRM_CUSTOMER_EVENT';

    /**
     * 消息体内的数据
     * @var array
     */
    protected $properties = [
        // 帐号ID
        'account_id' => 'account_id',
        // 帐号类型 YouZanAccount:有赞账号
        'account_type' => 'account_type',
        /**
         * 客户来源
         * 100	关注公众号
         * 200	普通下单客户
         * 300	店铺后批量导入客户
         * 400	店铺后台新建客户或接口创建客户
         * 0	未知来源
         */
        'src' => 'src',
        // 备注
        'remark' => 'remark',
        // 姓名
        'name' => 'name',
        // 手机号
        'mobile' => 'mobile',
        // 是否会员 1：是；0：否
        'is_member' => 'is_member',
        // 性别 0：未知；1：男；2：女
        'gender' => 'gender',
        // 客户创建时间（时间戳 秒）
        'created_at' => 'created_at',
        // 联系地址（即：常住地）array
        'contact_address' => 'contact_address',
        // 生日 1997-07-31
        'birthday' => 'birthday'
    ];

    /**
     * 消息体外的数据
     * @var array
     */
    protected $extraProperties = [
        // CUSTOMER_CREATED 创建客户
        // CUSTOMER_UPDATED 更新客户
        'status' => 'status'
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