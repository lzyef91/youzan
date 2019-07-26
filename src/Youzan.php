<?php

namespace Nldou\Youzan;

use Nldou\Youzan\Token;
use Nldou\Youzan\Api\GoodsApi;
use Nldou\Youzan\Api\SalesmanApi;
use Nldou\Youzan\Api\UserApi;
use Nldou\Youzan\Exceptions\InvalidApiException;

class Youzan
{
    private $token;
    private $api = [];
    private $mapApiClass = [
        'goods' => GoodsApi::class,
        'salesman' => SalesmanApi::class,
        'user' => UserApi::class
    ];

    public function __construct(Token $token)
    {
        $this->token = $token;
    }

    public function api(string $class)
    {
        if (!array_key_exists($class, $this->mapApiClass)) {
            throw new InvalidApiException('InvalidApiClassError');
        }
        $apiClass = $this->mapApiClass[$class];
        if (!array_key_exists($apiClass, $this->api)) {
            $this->api[$apiClass] = new $apiClass($this->token);
        }
        return $this->api[$apiClass];
    }
}