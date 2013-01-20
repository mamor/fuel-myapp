# 自分用FuelPHPツールの保存場所です。
---
## _dl.sh
以下のファイル(一部を除く)をwgetするスクリプトです。  
fuel/app/_dl.shの位置で実行しています。

## bootstrap_makegood.php
ユニットテストで使用するファイルです。  
core/bootstrap_phpunit.phpを元にしています。

## build.xml
Jenkinsで使用するファイルです。  
https://github.com/mp-php/fuel-myapp/blob/master/jenkins.md

## jenkins.md
Jenkinsのメモです。

## phpunit.xml
ユニットテストで使用するファイルです。  
core/phpunit.xmlを元にしています。

## classes/dbfixture.php
DBを伴うユニットテストクラスで使用するファイルです。  
電子書籍『はじめてのフレームワークとしてのFuelPHP』の一部を元にしています。  
https://github.com/kenjis/fuelphp1st/blob/master/sample-code/10/fuel_form_db/classes/dbfixture.php

## classes/dbtestcase.php
DBを伴うユニットテストクラスで使用するファイルです。  
電子書籍『はじめてのフレームワークとしてのFuelPHP』の一部を元にしています。  
https://github.com/kenjis/fuelphp1st/blob/master/sample-code/10/fuel_form_db/classes/dbtestcase.php

## config/
各種設定ファイルの雛形です。

## tasks/coverage.php
ユニットテストを実行してカバレッジレポートを出力するタスクです。

## tasks/generate.php
自動補完用のファイルを生成するタスクです。  
@kenjis さん作成です。  
https://github.com/kenjis/fuelphp-tools/blob/master/app/tasks/generate.php

## tasks/phpdoc.php
phpDocumentor 2によるPHPDocを生成するタスクです。

## tasks/scafdb.php
実在テーブルからscaffoldやmodelを生成するタスクです。  
FuelPHP 1.5で、当タスクを元にしたfromdbタスクが実装されました。  
FuelPHP 1.5以降は、fromdbタスクをお使い下さい。

## tasks/showenv.php
サーバ等でFuel::$envを確認するタスクです。

## tasks/testcase.php
app/classesのファイルに対するテストクラスを生成するタスクです。

## php-cs-fixer.phar
http://cs.sensiolabs.org/

## php-cs-fixer.sh
php-cs-fixer.pharを実行するスクリプトです。
