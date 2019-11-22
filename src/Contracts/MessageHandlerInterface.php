<?php

namespace Nldou\Youzan\Contracts;

interface MessageHandlerInterface
{
    /**
     * @param mixed $msg
     */
    public function handle($msg = null);
}
