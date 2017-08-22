<?php

namespace UMeng\Android;

use UMeng\AndroidNotification;

class AndroidBroadcast extends AndroidNotification
{
    function __construct()
    {
        parent::__construct();
        $this->data["type"] = "broadcast";
    }
}