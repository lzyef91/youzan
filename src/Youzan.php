<?php

namespace Nldou\Youzan;

use Nldou\Youzan\Token;
use Nldou\Youzan\Api\GoodsApi;
use Nldou\Youzan\Api\SalesmanApi;
use Nldou\Youzan\Api\UserApi;
use Nldou\Youzan\Api\OrdersApi;
use Nldou\Youzan\Api\CouponsApi;
use Nldou\Youzan\Message\Server;
use Nldou\Youzan\Exceptions\InvalidProviderException;
use Nldou\Youzan\Exceptions\InvalidApiException;

class Youzan
{
    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $clientSecret;

    /**
     * @var Token
     */
    private $token;

    /**
     * api服务实例
     * @var array
     */
    private $apiServices = [];

    /**
     * api服务提供者
     * @var array
     */
    private $apiProviders = [
        'goods' => GoodsApi::class,
        'salesman' => SalesmanApi::class,
        'user' => UserApi::class,
        'orders' => OrdersApi::class,
        'coupons' => CouponsApi::class
    ];

    /**
     * 服务实例
     * @var array
     */
    private $services = [];

    /**
     * 服务提供者
     * @var array
     */
    private $providers = [
        'server' => Server::class
    ];

    /**
     * Constructor
     *
     * @param Token $token
     */
    public function __construct($clientId, $clientSecret, Token $token)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->token = $token;
    }

    /**
     * 获取api服务实例
     *
     * @param string $class
     *
     * @return \Nldou\Youzan\Api\YouzanApi
     */
    public function api(string $class)
    {
        // 是否存在api
        if (!array_key_exists($class, $this->apiProviders)) {
            throw new InvalidApiException("{$class}_api_not_exist");
        }

        // 获取api
        $apiClass = $this->apiProviders[$class];

        // 获取api实例
        if (!array_key_exists($apiClass, $this->apiServices)) {
            $this->apiServices[$apiClass] = new $apiClass($this->token);
        }

        return $this->apiServices[$apiClass];
    }

    /**
     * Magic get access
     *
     * @param string $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        // 是否存在服务
        if (!array_key_exists($name, $this->providers)) {
            throw new InvalidProviderException("{$name}_service_not_exist");
        }

        // 获取服务
        $class = $this->providers[$name];

        // 获取服务实例
        if (!array_key_exists($class, $this->services)) {
            $this->services[$class] = new $class($this->clientId, $this->clientSecret);
        }

        return $this->services[$class];

    }
}