<?php

namespace UMeng\Android;

use UMeng\AndroidNotification;

class AndroidListcast extends AndroidNotification
{
    function __construct()
    {
        parent::__construct();
        $this->data["type"] = "listcast";
        $this->data["device_tokens"] = null;
    }

}