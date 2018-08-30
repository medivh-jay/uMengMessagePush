# uMengMessagePush

* 使用composer安装

```
composer require stmbuy/message-push dev-master
```

* 以下是一个使用示例, 具体使用方法,可以看源代码中的调用, 基本就是把友盟的sdk重新封装了一下,方便调用

```php
$uMeng = \UMeng\PushFactory\PushFactory::android($appKey, $appMasterSecret);
$umeng->sendUniCast()
```
