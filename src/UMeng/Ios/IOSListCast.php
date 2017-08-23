<?php

namespace UMeng\Ios;

use UMeng\IOSNotification;

class IOSListCast extends IOSNotification
{
    function __construct()
    {
        parent::__construct();
        $this->data["type"] = "listcast";
        $this->data["device_tokens"] = null;
    }

}