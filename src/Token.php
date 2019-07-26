<?php

namespace Nldou\Youzan;

use Youzan\Open\Token as TokenClient;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;
use Nldou\Youzan\Exceptions\GetTokenException;
use Nldou\Youzan\Exceptions\InvalideCacheSystemException;

class Token
{
    private $clientId;
    private $clientSecret;
    private $tokenClient;
    private $type;
    private $kdtId;
    private $tokenObj;

    public function __construct(string $clientId, string $clientSecret, string $kdtId, string $type = 'silent')
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->type = $type;
        $this->kdtId = $kdtId;
    }

    public function getToken()
    {
        if (!class_exists(Cache::class)) {
            throw new InvalideCacheSystemException('InvalidLaravelCacheSystem');
        }
        $cachekey = 'nldou-youzan:token';
        $token = Cache::get($cachekey, null);
        if ($token) {
            // 获取缓存结果
            $this->tokenObj = json_decode($token, true);
        } else {
            // 重新获取
            $token = $this->requireToken()->getAll();
            // 提前10分钟过期
            $expires = Carbon::createFromTimestampMs($token['expires'])->subMinutes(10);
            // 缓存结果
            Cache::put($cachekey, $this->getAll(true), $expires);
        }
        return $this;
    }

    /**
     * 请求token信息
     */
    private function requireToken()
    {
        try {
            $this->tokenClient = new TokenClient($this->clientId, $this->clientSecret);
            $tokenObj = $this->tokenClient->getToken($this->type, ['kdt_id' => $this->kdtId]);
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            throw new GetTokenException("GetAccessTokenError: {$msg}");
        }
        // 返回结果异常
        if (isset($tokenObj['code']) && $tokenObj['code'] != 200) {
            $code = $tokenObj['code'];
            $msg = $tokenObj['message'];
            throw new GetTokenException("GetAccessTokenError: {$code} {$msg}");
        }
        $this->tokenObj = $tokenObj;
        return $this;
    }

    /**
     * 存在缓存时设置token信息
     */
    // public function setToken(array $token)
    // {
    //     $this->tokenObj = $token;
    //     return $this;
    // }

    /**
     * 获取token所有信息
     */
    public function getAll(bool $json = false)
    {
        return $json ? json_encode($this->tokenObj) : $this->tokenObj;
    }

    /**
     * 获取acccess_token
     */
    public function getAccessToken()
    {
        return $this->tokenObj['access_token'];
    }

    /**
     * 获取access_token过期时间
     * 单位:毫秒 默认:7天
     */
    public function getExpires()
    {
        return $this->tokenObj['expires'];
    }

    /**
     * 获取access_token权限
     */
    public function getScope()
    {
        return $this->tokenObj['scope'];
    }

    /**
     * 获取店铺ID
     */
    public function getAuthorityId()
    {
        return $this->tokenObj['authority_id'];
    }

}