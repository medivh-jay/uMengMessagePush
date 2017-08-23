<?php
/**
 * Created by xjliu.
 * User: xjliu@snqu.com
 * Date: 2017/8/22 12:10
 */

namespace UMeng\PushFactory;

use UMeng\Android\AndroidBroadcast;
use UMeng\Android\AndroidCustomizedCast;
use UMeng\Android\AndroidFileCast;
use UMeng\Android\AndroidGroupCast;
use UMeng\Android\AndroidUniCast;

class Android implements PushInterface
{
    protected $appKey = null;
    protected $appMasterSecret = null;
    protected $timestamp = null;

    function __construct($key, $secret)
    {
        $this->appKey = $key;
        $this->appMasterSecret = $secret;
        $this->timestamp = strval(time());
    }

    public function sendBroadCast($ticker, $title, $text, $afterOpen, array $customs = [], $isFormal = true)
    {
        try {
            $broCast = new AndroidBroadcast();
            $broCast->setAppMasterSecret($this->appMasterSecret);
            $broCast->setPredefinedKeyValue("appkey", $this->appKey);
            $broCast->setPredefinedKeyValue("timestamp", $this->timestamp);
            $broCast->setPredefinedKeyValue("ticker", $ticker);
            $broCast->setPredefinedKeyValue("title", $title);
            $broCast->setPredefinedKeyValue("text", $text);
            $broCast->setPredefinedKeyValue("after_open", $afterOpen);
            // Set 'production_mode' to 'false' if it's a test device.
            // For how to register a test device, please see the developer doc.
            $broCast->setPredefinedKeyValue("production_mode", $isFormal);
            // [optional]Set extra fields
            foreach ( $customs as $key => $value ){
                $broCast->setExtraField($key, $value);
            }
            print("Sending broadcast notification, please wait...\r\n");
            $broCast->send();
            print("Sent SUCCESS\r\n");
        } catch (\Exception $e) {
            print("Caught exception: " . $e->getMessage());
        }
    }

    public function sendUniCast($deviceTokens, $ticker, $title, $text, $afterOpen, array $customs = [], $isFormal = true)
    {
        try {
            $uniCast = new AndroidUniCast();
            $uniCast->setAppMasterSecret($this->appMasterSecret);
            $uniCast->setPredefinedKeyValue("appkey", $this->appKey);
            $uniCast->setPredefinedKeyValue("timestamp", $this->timestamp);
            // Set your device tokens here
            $uniCast->setPredefinedKeyValue("device_tokens", $deviceTokens);
            $uniCast->setPredefinedKeyValue("ticker", $ticker);
            $uniCast->setPredefinedKeyValue("title", $title);
            $uniCast->setPredefinedKeyValue("text", $text);
            $uniCast->setPredefinedKeyValue("after_open", $afterOpen);
            // Set 'production_mode' to 'false' if it's a test device.
            // For how to register a test device, please see the developer doc.
            $uniCast->setPredefinedKeyValue("production_mode", $isFormal);
            // Set extra fields
            foreach ( $customs as $key => $value ){
                $uniCast->setExtraField($key, $value);
            }
            print("Sending unicast notification, please wait...\r\n");
            $uniCast->send();
            print("Sent SUCCESS\r\n");
        } catch (\Exception $e) {
            print("Caught exception: " . $e->getMessage());
        }
    }

    public function sendFileCast($ticker, $title, $text, $afterOpen)
    {
        try {
            $fileCast = new AndroidFileCast();
            $fileCast->setAppMasterSecret($this->appMasterSecret);
            $fileCast->setPredefinedKeyValue("appkey", $this->appKey);
            $fileCast->setPredefinedKeyValue("timestamp", $this->timestamp);
            $fileCast->setPredefinedKeyValue("ticker", $ticker);
            $fileCast->setPredefinedKeyValue("title", $title);
            $fileCast->setPredefinedKeyValue("text", $text);
            $fileCast->setPredefinedKeyValue("after_open", $afterOpen);  //go to app
            print("Uploading file contents, please wait...\r\n");
            // Upload your device tokens, and use '\n' to split them if there are multiple tokens
            $fileCast->uploadContents("aa" . "\n" . "bb");
            print("Sending filecast notification, please wait...\r\n");
            $fileCast->send();
            print("Sent SUCCESS\r\n");
        } catch (\Exception $e) {
            print("Caught exception: " . $e->getMessage());
        }
    }

    public function sendGroupCast($filter, $ticker, $title, $text, $afterOpen, $isFormal = true)
    {
        try {
            $groupCast = new AndroidGroupCast();
            $groupCast->setAppMasterSecret($this->appMasterSecret);
            $groupCast->setPredefinedKeyValue("appkey", $this->appKey);
            $groupCast->setPredefinedKeyValue("timestamp", $this->timestamp);
            // Set the filter condition
            $groupCast->setPredefinedKeyValue("filter", $filter);
            $groupCast->setPredefinedKeyValue("ticker", $ticker);
            $groupCast->setPredefinedKeyValue("title", $title);
            $groupCast->setPredefinedKeyValue("text", $text);
            $groupCast->setPredefinedKeyValue("after_open", $afterOpen);
            // Set 'production_mode' to 'false' if it's a test device.
            // For how to register a test device, please see the developer doc.
            $groupCast->setPredefinedKeyValue("production_mode", $isFormal);
            print("Sending groupcast notification, please wait...\r\n");
            $groupCast->send();
            print("Sent SUCCESS\r\n");
        } catch (\Exception $e) {
            print("Caught exception: " . $e->getMessage());
        }
    }

    public function sendCustomizedCast($alias, $aliasType, $ticker, $title, $text, $afterOpen)
    {
        try {
            $customizedCast = new AndroidCustomizedCast();
            $customizedCast->setAppMasterSecret($this->appMasterSecret);
            $customizedCast->setPredefinedKeyValue("appkey", $this->appKey);
            $customizedCast->setPredefinedKeyValue("timestamp", $this->timestamp);
            // Set your alias here, and use comma to split them if there are multiple alias.
            // And if you have many alias, you can also upload a file containing these alias, then
            // use file_id to send customized notification.
            $customizedCast->setPredefinedKeyValue("alias", $alias);
            // Set your alias_type here
            $customizedCast->setPredefinedKeyValue("alias_type", $aliasType);
            $customizedCast->setPredefinedKeyValue("ticker", $ticker);
            $customizedCast->setPredefinedKeyValue("title", $title);
            $customizedCast->setPredefinedKeyValue("text", $text);
            $customizedCast->setPredefinedKeyValue("after_open", $afterOpen);
            print("Sending customizedcast notification, please wait...\r\n");
            $customizedCast->send();
            print("Sent SUCCESS\r\n");
        } catch (\Exception $e) {
            print("Caught exception: " . $e->getMessage());
        }
    }

    public function sendCustomizedCastFileId($uploadContent, $aliasType, $ticker, $title, $test, $afterOpen)
    {
        try {
            $customizedCast = new AndroidCustomizedCast();
            $customizedCast->setAppMasterSecret($this->appMasterSecret);
            $customizedCast->setPredefinedKeyValue("appkey", $this->appKey);
            $customizedCast->setPredefinedKeyValue("timestamp", $this->timestamp);
            // if you have many alias, you can also upload a file containing these alias, then
            // use file_id to send customized notification.
            $customizedCast->uploadContents($uploadContent);
            // Set your alias_type here
            $customizedCast->setPredefinedKeyValue("alias_type", $aliasType);
            $customizedCast->setPredefinedKeyValue("ticker", $ticker);
            $customizedCast->setPredefinedKeyValue("title", $title);
            $customizedCast->setPredefinedKeyValue("text", $test);
            $customizedCast->setPredefinedKeyValue("after_open", $afterOpen);
            print("Sending customizedcast notification, please wait...\r\n");
            $customizedCast->send();
            print("Sent SUCCESS\r\n");
        } catch (\Exception $e) {
            print("Caught exception: " . $e->getMessage());
        }
    }
}