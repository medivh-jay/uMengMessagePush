<?php

namespace UMeng\Android;

use UMeng\AndroidNotification;

class AndroidUniCast extends AndroidNotification
{
    function __construct()
    {
        parent::__construct();
        $this->data["type"] = "unicast";
        $this->data["device_tokens"] = null;
    }

}