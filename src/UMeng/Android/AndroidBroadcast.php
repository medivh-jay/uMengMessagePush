<?php

namespace UMeng\Android;

use UMeng\AndroidNotification;

/**
 * 广播消息
 * Class AndroidBroadcast
 * @package UMeng\Android
 */
class AndroidBroadcast extends AndroidNotification
{
    function __construct()
    {
        parent::__construct();
        $this->data["type"] = "broadcast";
    }
}