<?php

namespace UMeng\Android;

use UMeng\AndroidNotification;

class AndroidGroupCast extends AndroidNotification
{
    function __construct()
    {
        parent::__construct();
        $this->data["type"] = "groupcast";
        $this->data["filter"] = null;
    }
}