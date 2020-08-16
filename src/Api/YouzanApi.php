<?php

namespace Nldou\Youzan\Api;

use Nldou\Youzan\Token;
use Youzan\Open\Client;
use Nldou\Youzan\Exceptions\HttpException;
use Nldou\Youzan\Exceptions\ApiResponseException;
use Nldou\Youzan\Exceptions\InvalidParamsException;

class YouzanApi
{
    private $token;

    public function __construct(Token $token)
    {
        $this->token = $token;
    }

    protected function request(string $method, string $apiVersion, array $params = [])
    {
        // 请求token
        $acceessToken = $this->token->getAccessToken();

        // 客户端
        $client = new Client($acceessToken);

        try {
            $response = $client->post($method, $apiVersion, $params);
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            throw new HttpException("ApiHttpError-{$method}-{$apiVersion}: {$msg}");
        }

        if (isset($response['code'])) {
            // 响应结果异常
            if ($response['code'] != 200 || !$response['success']) {
                $code = $response['code'];
                $msg = $response['message'];
                throw new ApiResponseException("ApiResponseError-{$method}-{$apiVersion}: {$code} {$msg}", $code);
            }
        } elseif (isset($response['gw_err_resp'])) {
            // 通用网关错误
            $code = $response['gw_err_resp']['err_code'];
            $msg = $response['gw_err_resp']['err_msg'];
            throw new ApiResponseException("ApiResponseError-{$method}-{$apiVersion}: {$code} {$msg}", $code);
        }

        // 返回结果
        if (isset($response['data'])) {
            return $response['data'];
        } elseif (isset($response['response'])) {
            return $response['response'];
        } else {
            return $response;
        }
    }

    protected function loadParams(array $params, array $paramsMap = [], array $forceParamsMap= [],
        bool $paramsCheck = true)
    {
        $ret = [];
        // 必填参数
        if ($paramsCheck) {
            foreach ($forceParamsMap as $p) {
                if (array_key_exists($p, $params)) {
                    $ret[$p] = $params[$p];
                } else {
                    throw new InvalidParamsException("InvalidParamsError: lack {$p}");
                }
            }
            foreach ($paramsMap as $p) {
                if (array_key_exists($p, $params)) {
                    $ret[$p] = $params[$p];
                }
            }
        } else {
            $ret = $params;
        }

        return $ret;
    }
}