<?php

namespace UMeng\Ios;

use UMeng\IOSNotification;

class IOSBroadCast extends IOSNotification {
	function  __construct() {
		parent::__construct();
		$this->data["type"] = "broadcast";
	}
}