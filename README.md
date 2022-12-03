## Requirement
1. php 7.2|7.3
2. xhprof扩展
3. tideways扩展
4. mongodb扩展
5. laravel框架

## 安装
```
composer require mfei58/laravel-tideways
```

## 配置
*发布配置*
```
php artisan vendor:publish --tag=tideways-config
```
*添加中间件*
```php
    protected $middleware = [
        laravelTideways\middleware\ViaTideways\ViaTideways::class,
    ];
```
*添加APP变量*
```
TIDEWAYS_ENABLE=true
TIDEWAYS_MONGO_HOST=mongodb://yourhost:27017
TIDEWAYS_MONGO_DB=xhprof
TIDEWAYS_MONGO_USERNAME=yourusername
TIDEWAYS_MONGO_PASSWORD=yourpassword
```