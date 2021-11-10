<p align="center">
    <a href="https://github.com/laravel" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/958072" height="100px">
    </a>
    <h1 align="center">VNPT EPay</h1>
    <br>
    <p align="center">
    <a href="https://github.com/lamtd/vnpt-epay/"><img src="https://img.shields.io/github/license/lamtd/vnpt-epay" alt="Latest version"></a>
            <a href="https://github.com/lamtd/vnpt-epay/"><img src="https://img.shields.io/github/stars/lamtd/vnpt-epay" alt="Latest version"></a>
    </p>
</p>

# Miêu  tả
Tạo cổng thanh toán VNPT. Thư viện dùng để bổ sung cổng thanh toán VNPT Epay từ bộ thanh toán Omnipay

## Cài đặt

Cài đặt VNPT Epay thông qua [Composer](https://getcomposer.org):

```bash
composer require lamtd/vnpt-epay
```

Sau khi cài đặt xong bạn cần phải publish config file để thiết lập thông số cho cổng thanh toán bạn cần tích hợp, publish thông qua câu lệnh:


```php
php artisan vendor:publish --provider="PHPViet\Laravel\Omnipay\OmnipayServiceProvider" --tag="config"
php artisan vendor:publish --provider="Lamtd\VNPTEpay\VNPTEpayServiceProvider"
```

Thêm vào cuối file config/laravel-omnipay.php

```php
'VnptEpay' => [
            'driver' => 'VnptEpay',
            'options' => [
                'merId' => '',
                'EncodeKey' => '',
                'VNPTDomain' => 'https://sandbox.megapay.vn:2810', //Domain test
                'CANCEL_PASSWORD' => '',
                'KEY3DES_ENCRYPT' => '',
                'KEY3DES_DECRYPT' => '',
            ],
        ],
```
# Sử dụng
Load class:
```php
use Lamtd\VNPTEpay\Facade\Gateway as VNPTEpay;

```
Gọi ở function:
```php
return VNPTEpay::purchase([
            'amount' => $request -> input('goodsAmount'),
            'userFee' => $request -> input('userFee'),
            'userId' => $request -> input('userId'),
            'callBackUrl' => route('vnpt-epay-success'), 
            'notiUrl' => '' //khi test local không dùng link ipn được
        ]) -> send();;

```
Listen từ vnpt:
```php
$response = VNPTEpay::notification()->send();
```

Bạn có thể xem demo ở
```php
vendor/lamtd/vnpt-epay/src/laravel/TestVNPTEpaytController.php
```
Khi chạy thực tế, vì vnpt sử dụng POST JSON nên cần thay đổi listener:
```php
$response = VNPTEpay::notificationJSON()->send();
```

# Demo:
```php
truy cập theo path /vnpt-epay-demo
```
## Dành cho nhà phát triển

Đây là version mình đã test trên phần thanh toán VNPT Epay. Nếu có lỗi hoặc muốn mở rộng chức năng, Hãy tạo các `issue` để mình cập nhật cho hoàn chỉnh. Nếu bạn muốn liên hệ trực tiếp hãy gửi mail về lamtd@boonygroup.com . Cảm ơn!
