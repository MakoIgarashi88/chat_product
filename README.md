# Chat_Product
 
チャットツール

# 差別化
 
+ 登録の手順が簡単
+ 個人同士でも、集団でもチャットができる
 
# 使用環境
 
"hoge"を動かすのに必要なライブラリなどを列挙する
 
* Composer
* Node.js
* Mysql

# 使い方
 ## データベース作成
 
```bash
create database chat_product_dev;
 ```

```bash
git clone https://github.com/fuuga000/chat_product.git
cd chat_product
```
 .envファイル作成（環境に合わせて）
 ```bash
 composer install
 npm install
php artisan migrate --seed
npm run dev
php artisan serve
 ```
 http://localhost:8000 にアクセス
# 注意
 
通知は来ません
 
# 作成者情報
 
作成情報を列挙する
 
* mako
* 無所属