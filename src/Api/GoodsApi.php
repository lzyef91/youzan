<?php

namespace Nldou\Youzan\Api;

use Nldou\Youzan\Token;

class GoodsApi extends YouzanApi
{
    public function __construct(Token $token)
    {
        parent::__construct($token);
    }

    public function itemShow($params)
    {
        $method = 'youzan.item.get';
        $version = '3.0.0';
        $paramsMap = [
            'item_id', // 商品ID，与alias两者二选一
            'alias' // 商品别名，与item_id两者二选一
        ];
        $params = $this->loadParams($params, $paramsMap);
        return $this->request($method, $version, $params);
    }

    /**
     * 在售商品列表
     */
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

    /**
     * 仓库商品列表
     */
    public function inventoryIndex($params = [])
    {
        $method = 'youzan.items.inventory.get';
        $version = '3.0.0';
        $paramsMap = [
            'q', // 搜索字段，搜索商品名称
            'tag_id', // 商品分组Id，通过youzan.itemcategories.tags.get接口获取商品Id进行筛选
            'banner', // 分类字段，可选值：for_shelved（已下架的）/ sold_out（已售罄的）
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