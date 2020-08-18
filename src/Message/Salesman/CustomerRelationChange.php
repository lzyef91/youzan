<?php

/**
 * 销售员客户关系变更
 */

namespace Nldou\Youzan\Message\Salesman;

use Nldou\Youzan\Message\Message;

class CustomerRelationChange extends Message
{
    /**
     * @var string
     */
    public $type = 'salesman_customer_relation_change_biz';

    /**
     * Properties.
     *
     * @var array
     */
    protected $properties = [
        // 变更类型
        // 1:新增客户关系；
        // 2:合并客户关系；
        // 3:解除客户关系;
        // 4:更新客户关系；
        'state_action' => 'stateAction',
        // 变更描述详情
        'state_desc' => 'stateDesc',
        // 店铺id
        'kdt_id' => 'kdtId',
        // 业务id
        'biz_id' => 'bizId',
        // 用户最新uid
        'ct_uid' => 'ctUid',
        // 变更前用户的uid
        'old_ct_uid' => 'oldCtUid',
        // 有效的分销员id
        'valid_ds_uid' => 'validDsUid',
        // 失效的分销员id
        'invalid_ds_uid' => 'inValidDsUid',
        // 有效的分销员所属的店铺id
        'valid_ds_kdt_id' => 'validDsKdtId',
        // 现有的可支持的渠道 String 例，微信公众号
        'channel' => 'channel',
        // 之前支持的渠道
        'old_channel' => 'oldChannel'
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