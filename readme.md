# Laravel SmsKing 套件
Laravel SmsKing 為串接簡訊王的非官方套件

## 系統需求
 - PHP >= 7
 - Laravel >= 5.7

## 安裝
```composer require javck/sms-king

## 環境設定
```php artisan vendor:publish --tag=smsKing 
### .env 裡加入

SMG_USERNAME=
SMG_PASSWORD=
SMG_APIKEY=


## 用法
### 寄出簡訊
    函式名稱    sendSMS
    參數1 smbody簡訊內容
    參數2 mobile發送電話號碼
    回傳值 狀態碼

```
### 取得狀態碼訊息內容
    函式名稱    smgStatusCode
    參數1 smgStatusCode 狀態碼
    回傳值 狀態碼中文訊息
```
### 查詢簡訊發送的結果
    函式名稱    searchSmgStatusUrl
    參數1 kmsgid 簡訊流水號
    回傳值 狀態碼
```
### 查詢簡訊剩餘點數
    函式名稱    searchPointsUrl
    回傳值 剩餘點數數值

## 參考文件

