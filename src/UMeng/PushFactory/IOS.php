<?php
/**
 * Created by xjliu.
 * User: xjliu@snqu.com
 * Date: 2017/8/22 12:10
 */

namespace UMeng\PushFactory;


use UMeng\Ios\IOSBroadCast;
use UMeng\Ios\IOSCustomizedCast;
use UMeng\Ios\IOSFileCast;
use UMeng\Ios\IOSGroupCast;
use UMeng\Ios\IOSUniCast;

class IOS implements PushInterface
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

    /**
     * ios 广播消息
     * @param string $alert IOS必须字段
     * @param array $customs 自定义字段 , d b 不能用于字段名
     * @param bool $isFormal
     */
    function sendBroadCast($alert, $customs = [], $isFormal = true)
    {
        try {
            $broCast = new IOSBroadCast();
            $broCast->setAppMasterSecret($this->appMasterSecret);
            $broCast->setPredefinedKeyValue("appkey", $this->appKey);
            $broCast->setPredefinedKeyValue("timestamp", $this->timestamp);

            $broCast->setPredefinedKeyValue("alert", $alert);
            $broCast->setPredefinedKeyValue("badge", 0);
            $broCast->setPredefinedKeyValue("sound", "chime");
            // Set 'production_mode' to 'true' if your app is under production mode
            $broCast->setPredefinedKeyValue("production_mode", $isFormal);
            // Set customized fields
            foreach ( $customs as $key => $value ){
                $broCast->setCustomizedField($key, $value);
            }
            print("Sending broadcast notification, please wait...\r\n");
            $broCast->send();
            print("Sent SUCCESS\r\n");
        } catch (\Exception $e) {
            print("Caught exception: " . $e->getMessage());
        }
    }

    /**
     *
     * @param string $deviceTokens 设备唯一标识 ios为64位
     * @param string $alert
     * @param array $customs 自定义字段
     * @param boolean $isFormal
     */
    function sendUniCast($deviceTokens, $alert, $customs, $isFormal = true)
    {
        try {
            $uniCast = new IOSUniCast();
            $uniCast->setAppMasterSecret($this->appMasterSecret);
            $uniCast->setPredefinedKeyValue("appkey", $this->appKey);
            $uniCast->setPredefinedKeyValue("timestamp", $this->timestamp);
            // Set your device tokens here
            $uniCast->setPredefinedKeyValue("device_tokens", $deviceTokens);
            $uniCast->setPredefinedKeyValue("alert", $alert);
            $uniCast->setPredefinedKeyValue("badge", 0);
            $uniCast->setPredefinedKeyValue("sound", "chime");
            // Set 'production_mode' to 'true' if your app is under production mode
            $uniCast->setPredefinedKeyValue("production_mode", $isFormal);
            // Set customized fields
            foreach ( $customs as $key => $value ){
                $uniCast->setCustomizedField($key, $value);
            }
            print("Sending unicast notification, please wait...\r\n");
            $uniCast->send();
            print("Sent SUCCESS\r\n");
        } catch (\Exception $e) {
            print("Caught exception: " . $e->getMessage());
        }
    }

    /**
     * @param string $alert
     * @param boolean $isFormal
     * @param string $uploadContent
     */
    function sendFileCast($alert, $uploadContent, $isFormal = true)
    {
        try {
            $fileCast = new IOSFileCast();
            $fileCast->setAppMasterSecret($this->appMasterSecret);
            $fileCast->setPredefinedKeyValue("appkey", $this->appKey);
            $fileCast->setPredefinedKeyValue("timestamp", $this->timestamp);
            $fileCast->setPredefinedKeyValue("alert", $alert);
            $fileCast->setPredefinedKeyValue("badge", 0);
            $fileCast->setPredefinedKeyValue("sound", "chime");
            // Set 'production_mode' to 'true' if your app is under production mode
            $fileCast->setPredefinedKeyValue("production_mode", $isFormal);
            print("Uploading file contents, please wait...\r\n");
            // Upload your device tokens, and use '\n' to split them if there are multiple tokens
            $fileCast->uploadContents($uploadContent);
            print("Sending filecast notification, please wait...\r\n");
            $fileCast->send();
            print("Sent SUCCESS\r\n");
        } catch (\Exception $e) {
            print("Caught exception: " . $e->getMessage());
        }
    }

    function sendGroupCast(array $filter, $alert, $isFormal = true)
    {
        try {
            $groupCast = new IOSGroupCast();
            $groupCast->setAppMasterSecret($this->appMasterSecret);
            $groupCast->setPredefinedKeyValue("appkey", $this->appKey);
            $groupCast->setPredefinedKeyValue("timestamp", $this->timestamp);
            // Set the filter condition
            $groupCast->setPredefinedKeyValue("filter", $filter);
            $groupCast->setPredefinedKeyValue("alert", $alert);
            $groupCast->setPredefinedKeyValue("badge", 0);
            $groupCast->setPredefinedKeyValue("sound", "chime");
            // Set 'production_mode' to 'true' if your app is under production mode
            $groupCast->setPredefinedKeyValue("production_mode", $isFormal);
            print("Sending groupcast notification, please wait...\r\n");
            $groupCast->send();
            print("Sent SUCCESS\r\n");
        } catch (\Exception $e) {
            print("Caught exception: " . $e->getMessage());
        }
    }

    function sendCustomizedCast($alias, $aliasType, $alert, $isFormal = true)
    {
        try {
            $customizedCast = new IOSCustomizedCast();
            $customizedCast->setAppMasterSecret($this->appMasterSecret);
            $customizedCast->setPredefinedKeyValue("appkey", $this->appKey);
            $customizedCast->setPredefinedKeyValue("timestamp", $this->timestamp);

            // Set your alias here, and use comma to split them if there are multiple alias.
            // And if you have many alias, you can also upload a file containing these alias, then
            // use file_id to send customized notification.
            $customizedCast->setPredefinedKeyValue("alias", $alias);
            // Set your alias_type here
            $customizedCast->setPredefinedKeyValue("alias_type", $aliasType);
            $customizedCast->setPredefinedKeyValue("alert", $alert);
            $customizedCast->setPredefinedKeyValue("badge", 0);
            $customizedCast->setPredefinedKeyValue("sound", "chime");
            // Set 'production_mode' to 'true' if your app is under production mode
            $customizedCast->setPredefinedKeyValue("production_mode", $isFormal);
            print("Sending customizedcast notification, please wait...\r\n");
            $customizedCast->send();
            print("Sent SUCCESS\r\n");
        } catch (\Exception $e) {
            print("Caught exception: " . $e->getMessage());
        }
    }
}