<?php

namespace Nldou\Youzan;

use Youzan\Open\Token as TokenClient;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Nldou\Youzan\Exceptions\GetTokenException;

class Token
{
    private $clientId;
    private $clientSecret;
    private $tokenClient;
    private $appType;
    private $authorityId;
    private $token;

    const CACHE_TOKEN = 'nldou-youzan:token';
    const CACHE_REFRESH_TOKEN = 'nldou-youzan:refresh-token';

    public function __construct(string $clientId, string $clientSecret, string $authorityId, string $appType)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->appType = $appType;
        $this->authorityId = $authorityId;
        // 实例化
        $this->tokenClient = new TokenClient($this->clientId, $this->clientSecret);
    }

    public function getToken()
    {
        // 缓存中获取token
        $token = Cache::get(self::CACHE_TOKEN);
        if (!empty($token)) {
            $this->token = $token;
            return $this;
        }

        // 刷新token
        $refreshToken = Cache::get(self::CACHE_REFRESH_TOKEN);
        if (!empty($refreshToken)) return $this->refreshToken($refreshToken);

        // token和refreshToken都不存在
        // 重新获取
        return $this->requireToken();

    }

    /**
     * 请求token信息
     */
    private function requireToken()
    {

        // 请求token
        $tokenObj = $this->SDKToken(['refresh' => true]);

        // 返回结果异常
        if (isset($tokenObj['code']) && $tokenObj['code'] != 200) {
            $code = $tokenObj['code'];
            $msg = $tokenObj['message'];
            throw new GetTokenException("GetAccessTokenError: {$code} {$msg}");
        }

        // 缓存token
        $this->cacheToken($tokenObj);

        $this->token = $tokenObj['access_token'];

        return $this;
    }

    /**
     * 刷新token
     */
    private function refreshToken($refreshToken)
    {
        // 刷新token
        try {
            $tokenObj = $this->tokenClient->refreshToken($refreshToken);
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            throw new GetTokenException("RefreshTokenError: {$msg}");
        }

        // 返回结果异常
        if (isset($tokenObj['code']) && $tokenObj['code'] != 200) {
            $code = $tokenObj['code'];
            $msg = $tokenObj['message'];
            throw new GetTokenException("RefreshTokenError: {$code} {$msg}");
        }

        // 缓存token
        $this->cacheToken($tokenObj);

        $this->token = $tokenObj['access_token'];

        return $this;
    }

    private function SDKToken($config)
    {
        $method = Str::camel("get-{$this->appType}-token");

        if (!\method_exists($this->tokenClient, $method)) throw new GetTokenException('illegal app_type');

        try {
            $tokenObj = $this->tokenClient->$method($this->authorityId, $config);
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            throw new GetTokenException("GetAccessTokenError: {$msg}");
        }

        return $tokenObj;
    }

    private function cacheToken($tokenObj)
    {
        // token提前10分钟过期
        $expires = Carbon::createFromTimestampMs($tokenObj['expires'])->subMinutes(10);
        Cache::put(self::CACHE_TOKEN, $tokenObj['access_token'], $expires);
        // 更新refresh_token
        Cache::put(self::CACHE_REFRESH_TOKEN, $tokenObj['refresh_token']);
    }

    /**
     * 获取acccess_token
     */
    public function getAccessToken()
    {
        return $this->token;
    }

    /**
     * 获取店铺ID
     */
    public function getAuthorityId()
    {
        return $this->authorityId;
    }

}