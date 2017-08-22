# uMengMessagePush

* 使用composer安装

```
composer require stmbuy/message-push
```

```php
$uMeng = \UMeng\PushFactory\PushFactory::android($appKey, $appMasterSecret);
$umeng->sendUniCast()
```