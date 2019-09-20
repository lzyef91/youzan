<?php

namespace Nldou\Youzan\Api;

use Nldou\Youzan\Token;

class UserApi extends YouzanApi
{
    public function __construct(Token $token)
    {
        parent::__construct($token);
    }

    public function check($params = [])
    {
        $method = 'youzan.users.account.check';
        $version = '1.0.0';
        $paramsMap = [];
        $forceParamsMap = [
            'account_type', // 帐号类型。目前支持以下选项（只支持传一种）： Mobile：手机号， UnionId：微信 UnionId
            'account_id' // 账号ID
        ];
        $params = $this->loadParams($params, $paramsMap, $forceParamsMap);
        return $this->request($method, $version, $params);
    }

    public function customCreate($params = [])
    {
        $method = 'youzan.scrm.customer.create';
        $version = '3.0.0';
        $paramsMap = [
            'customer_create' => [
                'remark', // 备注
                'birthday', // string 生日
                'name', // 姓名
                'contact_address' => [
                    'address', // string 详细地址
                    'area_code' // int 地域编码
                ],
                'gender' // 性别，0：未知；1：男；2：女
            ]
        ];
        $forceParamsMap = [
            'mobile' // 注册手机号
        ];
        $params = $this->loadParams($params, $paramsMap, $forceParamsMap, false);
        return $this->request($method, $version, $params);
    }

    public function show($params)
    {
        $method = 'youzan.scrm.customer.get';
        $version = '3.1.0';
        $paramsMap = [];
        $forceParamsMap = [
            'account' => [
                'account_id',
                'account_type'
            ]
        ];
        $params = $this->loadParams($params, $paramsMap, $forceParamsMap, false);
        return $this->request($method, $version, $params);
    }

    public function wxShow($params)
    {
        $method = 'youzan.users.weixin.follower.get';
        $version = '3.0.0';
        $paramsMap = [
            'fields', // 需要返回的微信粉丝对象字段，如nick,avatar等。可选值：CrmWeixinFans微信粉丝结构体中所有字段均可返回；多个字段用“,”分隔。如果为空则返回所有
            'weixin_openid', // 微信粉丝用户的openid
            'fans_id', // 微信粉丝用户ID。 调用时，参数 weixin_openid 和 fans_id 选其一即可
        ];
        $forceParamsMap = [];
        $params = $this->loadParams($params, $paramsMap, $forceParamsMap, false);
        return $this->request($method, $version, $params);
    }
}