<?php

namespace Nldou\Youzan\Message;

use Nldou\Youzan\Contracts\MessageHandlerInterface;
use Nldou\Youzan\Message\Message;
use Nldou\Youzan\Exceptions\InvalidParamsException;

class Server
{
    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $clientSecret;

    protected $httpSign;
    protected $httpType;
    protected $httpRequestBody;

    /**
     * @var Message
     */
    protected $message;

    /**
     * 消息处理器
     * @var array
     */
    private $handlers = [];

    public function __construct($clientId, $clientSecret)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;

        // msg请求信息
        $this->httpSign = $_SERVER['HTTP_EVENT_SIGN'];
        $this->httpType = $_SERVER['HTTP_EVENT_TYPE'];
        $this->httpRequestBody = file_get_contents('php://input');
    }

    protected function checkValidMsgType($type)
    {
        return \array_key_exists($type, Message::MESSAGE_TYPE_MAP);
    }

    /**
     * 将处理器加入队列
     *
     * @param MessageHandlerInterface $handlers
     * @param mixed $msgType
     */
    public function push(MessageHandlerInterface $handler, $msgType)
    {
        if (\is_array($msgType)) {

            foreach($msgType as $t){
                if ($this->checkValidMsgType($t)) {
                    $this->handlers[$t][] = $handler;
                }
            }

            return $this;
        }

        if ($this->checkValidMsgType($msgType)) {
            $this->handlers[$msgType][] = $handler;
        }

        return $this;

    }

    public function serve()
    {
        // 校验签名
        if (!$this->checkSign()) {
            return ['code' => 0,'msg' => 'success'];
        }

        // 获取message实例
        $this->message = $this->getMessageInstance();

        // 消息合法性
        if (!is_null($this->message) && $this->message instanceof Message
            && \array_key_exists($this->message->type, $this->handlers)) {
            // 处理器集合
            $handlers = $this->handlers[$this->message->type];
            // 按顺序执行
            foreach ($handlers as $handler) {
                // 如果处理器返回false，则接下来的处理器不执行
                $res = $handler->handle($this->message);
                if ($res === false) {
                    break;
                }
            }
        }

        return ['code' => 0,'msg' => 'success'];
    }

    protected function checkSign()
    {
        // 判断消息是否合法，若合法则返回成功标识
        $sign = md5(sprintf('%s%s%s', $this->clientId, $this->httpRequestBody, $this->clientSecret));
        return $sign == $this->httpSign;
    }

    protected function getMessageInstance()
    {
        if (\array_key_exists($this->httpType, Message::MESSAGE_TYPE_MAP)) {
            // post data
            $httpData = json_decode($this->httpRequestBody, true);

            if (\array_key_exists('msg', $httpData)) {
                // msg内容经过 urlencode 编码，需进行解码
                $msg = json_decode(urldecode($httpData['msg']), true);
                $httpData['msg'] = $msg;
            } else {
                // 没有msg内容，直接返回
                $msg = $httpData;
            }

            // message实例
            $msgCls = Message::MESSAGE_TYPE_MAP[$this->httpType];
            return new $msgCls($msg, $httpData);
        }

        return NULL;
    }
}