<?php

namespace Nldou\Youzan\Api;

use Nldou\Youzan\Token;

class SalesmanApi extends YouzanApi
{
    public function __construct(Token $token)
    {
        parent::__construct($token);
    }

    /**
     * 账户信息
     */
    public function accountShow($params = [])
    {
        $method = 'youzan.salesman.account.get';
        $version = '3.0.1';

        $paramsMap = [];
        $forceParamsMap = [
            'mobile', // 手机号（mobile或fans_id选其一，另者置为0，当fans_id和mobile都传时，优先按mobile查询）
            'fans_type', // 粉丝类型（自有粉丝: fans_type = 1；当传mobile时，和fans_id一样传0）
            'fans_id' // 粉丝id（mobile或fans_id选其一，另者置为0，当fans_id和mobile都传时，优先按mobile查询
        ];
        $params = $this->loadParams($params, $paramsMap, $forceParamsMap);

        return $this->request($method, $version, $params);
    }

    /**
     * 业绩统计
     */
    public function accountScoreIndex($params)
    {
        $method = 'youzan.salesman.account.score.search';
        $version = '3.0.0';

        $paramsMap = [];
        $forceParamsMap = [
            'mobile', // 手机号（mobile或fans_id选其一，另者置为0，当fans_id和mobile都传时，优先按mobile查询）
            'fans_type', // 粉丝类型（自有粉丝: fans_type = 1；当传mobile时，和fans_id一样传0）
            'fans_id', // 粉丝id（mobile或fans_id选其一，另者置为0，当fans_id和mobile都传时，优先按mobile查询
            'start_time', // 查询开始时间（时间戳，单位秒)
            'end_time', // 查询结束时间（时间戳，单位秒）
            'page_no',
            'page_size'
        ];
        $params = $this->loadParams($params, $paramsMap, $forceParamsMap);

        return $this->request($method, $version, $params);
    }

    /**
     * 推广订单列表
     */
    public function tradesIndex($params)
    {
        $method = 'youzan.salesman.trades.get';
        $version = '3.0.1';

        $paramsMap = [
            'start_time', // 查询开始时间（时间戳，单位秒）
            'end_time', // 查询结束时间（时间戳，单位秒
            'order_no' // 订单号
        ];
        $forceParamsMap = [
            'mobile', // 手机号（mobile或fans_id选其一，另者置为0，当fans_id和mobile都传时，优先按mobile查询）
            'fans_type', // 粉丝类型（自有粉丝: fans_type = 1；当传mobile时，和fans_id一样传0）
            'fans_id', // 粉丝id（mobile或fans_id选其一，另者置为0，当fans_id和mobile都传时，优先按mobile查询
            'page_no',
            'page_size'
        ];
        $params = $this->loadParams($params, $paramsMap, $forceParamsMap);

        return $this->request($method, $version, $params);
    }

    /**
     * 新增销售员
     */
    public function create($params)
    {
        $method = 'youzan.salesman.account.add';
        $version = '3.0.1';

        $paramsMap = [
            'group_id' // 所属分组id
        ];
        $forceParamsMap = [
            'mobile', // 手机号（mobile或fans_id选其一，另者置为0，当fans_id和mobile都传时，优先按mobile查询）
            'fans_type', // 粉丝类型（自有粉丝: fans_type = 1；当传mobile时，和fans_id一样传0）
            'fans_id', // 粉丝id（mobile或fans_id选其一，另者置为0，当fans_id和mobile都传时，优先按mobile查询
            'level', // 需要设置的等级
            'from_mobile' // 上级分销员的手机号
        ];
        $params = $this->loadParams($params, $paramsMap, $forceParamsMap);

        return $this->request($method, $version, $params);
    }

    /**
     * 更新信息
     */
    public function update($params)
    {
        $method = 'youzan.salesman.account.update';
        $version = '3.0.0';

        $paramsMap = [
            'group_id', // 所属分组id
            'level', // 需要设置的等级
            'from_mobile' // 上级分销员的手机号
        ];
        $forceParamsMap = [
            'mobile', // 手机号（mobile或fans_id选其一，另者置为0，当fans_id和mobile都传时，优先按mobile查询）
            'fans_type', // 粉丝类型（自有粉丝: fans_type = 1；当传mobile时，和fans_id一样传0）
            'fans_id' // 粉丝id（mobile或fans_id选其一，另者置为0，当fans_id和mobile都传时，优先按mobile查询
        ];
        $params = $this->loadParams($params, $paramsMap, $forceParamsMap);

        return $this->request($method, $version, $params);
    }

    /**
     * 清退分销员
     */
    public function delete($params)
    {
        $method = 'youzan.salesman.account.fire';
        $version = '3.0.0';

        $paramsMap = [
            'target_mobile', // 转移邀请关系到目标分销员手机号
        ];
        $forceParamsMap = [
            'mobile', // 手机号（mobile或fans_id选其一，另者置为0，当fans_id和mobile都传时，优先按mobile查询）
            'fans_type', // 粉丝类型（自有粉丝: fans_type = 1；当传mobile时，和fans_id一样传0）
            'fans_id' // 粉丝id（mobile或fans_id选其一，另者置为0，当fans_id和mobile都传时，优先按mobile查询
        ];
        $params = $this->loadParams($params, $paramsMap, $forceParamsMap);

        return $this->request($method, $version, $params);
    }

    /**
     * 获取商品推广链接
     */
    public function shareLinkShow($params)
    {
        $method = 'youzan.salesman.item.share.get';
        $version = '3.0.0';

        $paramsMap = [];
        $forceParamsMap = [
            'mobile', // 手机号（mobile或fans_id选其一，另者置为0，当fans_id和mobile都传时，优先按mobile查询）
            'fans_type', // 粉丝类型（自有粉丝: fans_type = 1；当传mobile时，和fans_id一样传0）
            'fans_id', // 粉丝id（mobile或fans_id选其一，另者置为0，当fans_id和mobile都传时，优先按mobile查询,
            'item_id', // 商品id（item_id或item_alias选其一，不选置为0，都填以item_alias为准
            'item_alias' // 商品别名（item_id或item_alias选其一，不选置为''，都填以item_alias为准
        ];
        $params = $this->loadParams($params, $paramsMap, $forceParamsMap);

        return $this->request($method, $version, $params);
    }

    public function customerIndex($params)
    {
        $method = 'youzan.salesman.customers.get';
        $version = '3.0.0';

        $paramsMap = [];
        $forceParamsMap = [
            'mobile', // 手机号（mobile或fans_id选其一，另者置为0，当fans_id和mobile都传时，优先按mobile查询）
            'fans_type', // 粉丝类型（自有粉丝: fans_type = 1；当传mobile时，和fans_id一样传0）
            'fans_id', // 粉丝id（mobile或fans_id选其一，另者置为0，当fans_id和mobile都传时，优先按mobile查询
            'page_no',
            'page_size'
        ];
        $params = $this->loadParams($params, $paramsMap, $forceParamsMap);

        return $this->request($method, $version, $params);
    }
}