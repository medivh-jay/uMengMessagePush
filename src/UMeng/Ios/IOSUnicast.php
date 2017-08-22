<?php

namespace UMeng\Ios;

use UMeng\IOSNotification;

class IOSUnicast extends IOSNotification
{
    function __construct()
    {
        parent::__construct();
        $this->data["type"] = "unicast";
        $this->data["device_tokens"] = null;
    }

}