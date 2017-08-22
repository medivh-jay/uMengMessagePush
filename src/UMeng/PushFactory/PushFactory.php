<?php
/**
 * Created by xjliu.
 * User: xjliu@snqu.com
 * Date: 2017/8/22 12:08
 */

namespace UMeng\PushFactory;


class PushFactory
{

    /**
     * 实例化安卓推送
     * @param $appKey
     * @param $appMasterSecret
     * @return Android
     */
    public static function android($appKey, $appMasterSecret)
    {
        return new Android($appKey, $appMasterSecret);
    }

    /**
     * 实例化IOS推送
     * @param $appKey
     * @param $appMasterSecret
     * @return IOS
     */
    public static function ios($appKey, $appMasterSecret)
    {
        return new IOS($appKey, $appMasterSecret);
    }

}