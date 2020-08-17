<?php

namespace Nldou\Youzan\Api;

use Nldou\Youzan\Token;

class UserApi extends YouzanApi
{
    public function __construct(Token $token)
    {
        parent::__construct($token);
    }

    /**
     * 是否存在有赞账号
     * @param array $params
     * [
     *      account_type string 帐号类型。目前支持以下选项（只支持传一种）： Mobile：手机号， UnionId：微信 UnionId
     *      account_id 账号ID
     * ]
     */
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

    /**
     * 创建客户
     * @param array $params
     * [
     *      mobile string 必填，注册手机号
     *      customer_create.remark string 客户信息备注
     *      customer_create.birthday string 生日 1988-05-13 00:00:00
     *      customer_create.name string 姓名
     *      customer_create.gender int 性别，0：未知；1：男；2：女
     *      customer_create.contact_address.area_code 地域编码
     * ]
     */
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

    /**
     * 获取客户信息
     * 根据手机号，商家自有粉丝（fanstype为1的），yzUid（有赞注册手机号生成的账号ID）
     * [
     *       // 性别。0:未知；1:男；2:女
     *       "gender" => 2,
     *       // 是否为会员
     *       "is_member" => false,
     *       // 客户姓名
     *       "name" => "18917329928",
     *       // 客户手机
     *       "mobile" => "18917329928",
     *       "remark" => "",
     *       // 联系地址，不存在时该字段不返回
     *       "contact_address" => [
     *          "province" => "上海市",
     *          "city" => "上海市",
     *          "area_code" => 310118,
     *          "county" => "青浦区",
     *       ],
     *   ]
     */
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

    /**
     * 依据有赞openid 或者手机号 获取用户简要信息
     * @return array
     * [
     *       "country_code" => "+86",
     *       "nick_name" => "Annie ppan",
     *       "mobile" => "13918336226",
     *       "yz_open_id" => "xBUDS3ub616666733490499584",
     *       "avatar" => "http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83eqfhuxzOmv9CiaqfEyxnmPM80sRYict8qltrcKzJ4mibTvnEAYicdM5jR7K3tQO9pQic2GXwPhOu7Y9ibaw/0",
     * ]
     */
    public function basicShow($params)
    {
        $method = 'youzan.user.basic.get';
        $version = '3.0.1';
        $paramsMap = [
            // 国家码，+86
            'country_code',
            // 手机号（注：手机号和yz_open_id必传其中1个）
            'mobile',
            // 有赞开放openid（（注：手机号和yz_open_id必传其中1个）
            'yz_open_id'
        ];
        $forceParamsMap = [];
        $params = $this->loadParams($params, $paramsMap, $forceParamsMap);
        return $this->request($method, $version, $params);
    }

    /**
     * 根据微信粉丝用户的 weixin_openid 或 fans_id 获取用户信息
     * @return array
     * [
     *      "user" => [
     *          "is_follow" => false,
     *          "city" => "苏州",
     *          "sex" => "f",
     *          "avatar" => "http://thirdwx.qlogo.cn/mmopen/wraibGcyPEb9Tvia4uUF0AT71vrJFQUVdqkicIClSdAEfSPpP1DX9nsjb74icegIFKS7kibiaudjte79CRpsbIFrW1pj3jkFUtBPkV/132",
     *          "traded_num" => 1,
     *          "points" => 1,
     *          "nick" => "penny",
     *          "follow_time" => 1576150577,
     *          "province" => "江苏",
     *          "user_id" => 10196625339,
     *          "union_id" => "oOYHo1KHkeQlosVNtmj17T7366l8",
     *          "weixin_openid" => "oHlcTtwMMKUjZ2HfF51hQwTEoyss",
     *          "traded_money" => "208.00",
     *      ],
     * ]
     */
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
        $params = $this->loadParams($params, $paramsMap, $forceParamsMap);
        return $this->request($method, $version, $params);
    }

    public function customersIndex($params)
    {
        $method = 'youzan.scrm.customer.search';
        $version = '3.1.2';
        $paramsMap = [
            'created_at_start', // 成为客户的时间，起始值，时间戳格式，单位是秒
            'created_at_end', // 成为客户的时间，截止值，时间戳格式，单位是秒
            'is_member', // 是否为会员，0表示非会员，1表示会员
            'page', // 页码，最多支持500页(500页是以每页默认值20为单位，客户查询最大为10000)
            'page_size' // 每页数量，最多支持50个
        ];
        $forceParamsMap = [];
        $params = $this->loadParams($params, $paramsMap, $forceParamsMap);
        return $this->request($method, $version, $params);
    }
}