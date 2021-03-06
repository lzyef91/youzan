<?php

namespace Nldou\Youzan\Api;

use Nldou\Youzan\Token;

class SalesmanApi extends YouzanApi
{
    public static $ERRCODE_SALESMAN_NOT_EXIST = '341007204';

    public function __construct(Token $token)
    {
        parent::__construct($token);
    }

    /**
     * 分销员列表
     */
    public function accountIndex($params)
    {
        $method = 'youzan.salesman.accounts.get';
        $version = '3.0.0';

        $paramsMap = [
            /**
             * 加入时间，时间戳（秒）
             */
            'start_time',
            'end_time',
            // 分组id
            'group_id'
        ];
        $forceParamsMap = [
            // 页码，从1~100开始，分页数不能超过100页。page_size 和page_no相乘总条数不能大于3200条。
            'page_no',
            // 每页条数。默认20条，最大不能超过100，建议使用默认分页。page_size 和page_no相乘总条数不能大于3200条。
            'page_size'
        ];
        $params = $this->loadParams($params, $paramsMap, $forceParamsMap);

        return $this->request($method, $version, $params);
    }

    /**
     * 账户信息
     * [
     *       "seller" => "2cAhDI",
     *       "from_buyer_mobile" => "",
     *       "kdt_id" => 18168297,
     *       "money" => "555.30",
     *       "level" => 1,
     *       "mobile" => "18321136597",
     *       "nickname" => "路兆洋",
     *       "created_at" => "2017-12-27 15:34:01",
     *       "order_num" => 9,
     *       "shop_name" => "能量逗",
     *       "fans_id" => 2377545783,
     *       // 注意：分组没有设置则不返回
     *       "group_id" => 1,
     *       "group_name" => "分组1"
     *  ]
     */
    public function accountShow($params)
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
     * 订单归属
     */
    public function tradeAccount($params)
    {
        $method = 'youzan.salesman.trades.account.get';
        $version = '3.0.0';

        $paramsMap = [];
        $forceParamsMap = [
            'order_no' // 订单号
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
            // 查询开始时间（时间戳，单位秒）
            'start_time',
            // 查询结束时间（时间戳，单位秒
            'end_time',
            // 订单号
            'order_no',
            // 手机号
            'mobile',
            // 粉丝类型
            // 1:代表微信自有粉丝；2：代表[微博平台]产生的粉丝；
            // 9：代表粉丝类型为微信大账号粉丝；
            // 188：代表[qq平台]产生的粉丝；736:代表[支付宝平台]产生的粉丝；
            // 1181:代表[今日头条]产生的粉丝；
            // 非上述fans_type：代表其他平台或小程序粉丝或者三方sdk产生的粉丝；
            'fans_type',
            // 粉丝id
            // 有赞不同的合作渠道会生成不同渠道对应在有赞平台下的fans_id。
            // fans_id和fans_type组成一个唯一的有赞用户标识。
            // 从浏览器过来的下单的是拿不到fans_id。
            // 大账号fans_id：通过微信去访问有赞店铺的商品等，系统会给用户生成fansid。
            // 用户自有fans_id（从三方过来的）：关注任意一个公众号(包括有赞大账号)后生成ID。
            'fans_id', // 粉丝id（mobile或fans_id选其一，另者置为0，当fans_id和mobile都传时，优先按mobile查询
            'group_id', // 销售员所属分组id
        ];
        $forceParamsMap = [
            // 每页条数。默认20条，最大不能超过100，建议使用默认分页。
            // 如果订单较多请使用时间参数分割。
            // page_size 和page_no相乘总条数不能大于3200条
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

    public function itemsShow($params)
    {
        $method = 'youzan.salesman.items.get';
        $version = '3.0.1';

        $paramsMap = [];
        $forceParamsMap = [
            'item_ids', // string 商品id列表，逗号分隔
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

    public function customerIndex($params, $version = '3.0.1')
    {
        $method = 'youzan.salesman.customers.get';

        $paramsMap = [
            'ds_uid', // 分销员userId，当dsUid和mobile都传时，优先按mobile查询
            'mobile', // 分销员手机号,
            'fans_id',
            'fans_type'
        ];
        $forceParamsMap = [
            'page_no',
            'page_size'
        ];
        $params = $this->loadParams($params, $paramsMap, $forceParamsMap);

        return $this->request($method, $version, $params);
    }
}