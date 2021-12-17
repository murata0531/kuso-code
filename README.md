# kuso-code

ECCコンピュータ専門学校地球祭2021で開催されたクソコードグランプリ準優勝コード

FizzBuzzをいかにクソにかけるかを確かめる

環境 : PHP7.4、Docker、MySQL8

# コードの説明やアピールポイントなど
https://hackmd.io/7VFzc9p7Qpyr5B9bsogjMw?view

# 構築

コンテナ立ち上げ
```
$ docker-compose up -d
```
テーブル作成
```
$ docker-compose exec db bash

bash# mysql -u root -p test
```
mysqlにログインしたら ` initdatabase ` 内の ` create_table.sql ` を実行する

FizzBuzzデータを挿入する
```
$ docker-compose run php bash

bash# php initdatabase/insert_fizzbuzz.php
```
FizzBuzz実行
```
bash# cd PHPCODE

bash# php create_fizzbuzzcsv.php

bash# php FizzBuzz.php