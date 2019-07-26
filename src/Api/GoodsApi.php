<?php

namespace Nldou\Youzan\Api;

use Nldou\Youzan\Token;

class GoodsApi extends YouzanApi
{
    public function __construct(Token $token)
    {
        parent::__construct($token);
    }

    public function onSaleIndex($params = [])
    {
        $method = 'youzan.items.onsale.get';
        $version = '3.0.0';
        $paramsMap = [
            'q', // 搜索字段，搜索商品名称
            'tag_id', // 商品分组Id，通过youzan.itemcategories.tags.get接口获取商品Id进行筛选
            'order_by', // 排序方式，格式为column:asc/desc，目前排序字段：1—创建时间：created_time，2—更新时间：update_time，3—价格：price，4—销量：sold_num
            'page_no', // 页码，不传或为0时默认设置为1
            'page_size', // 每页条数，最大300个，不传或为0时默认设置为20
            'update_time_start', // 更新时间起始，Unix时间戳请求 时间单位:ms
            'update_time_end', // 更新时间止，Unix时间戳请求 时间单位:ms
        ];
        $params = $this->loadParams($params, $paramsMap);
        return $this->request($method, $version, $params);
    }
}