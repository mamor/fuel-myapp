# Jenkinsの設定メモ
---
## 使用するbuild.xml
[https://github.com/mp-php/fuel-myapp/blob/master/build.xml](https://github.com/mp-php/fuel-myapp/blob/master/build.xml)

## 使用するphpunit.xml
[https://github.com/mp-php/fuel-myapp/blob/master/phpunit.xml](https://github.com/mp-php/fuel-myapp/blob/master/phpunit.xml)

## 必要なPHPモジュール
### Phing

### PHPUnit

### Xdebug

### phpDocumentor 2 & GraphViz

### PHP_CodeSniffer & PHPMD & PHPCPD  & PHP_Depend & phploc
PhingとPHPUnitを-a(--alldeps)でインストールすれば一緒に入る

## Jenkinsで必要なプラグイン(インストール済を除く)
### Checkstyle Plugin
PHP_CodeSnifferで出力されるXMLファイルの解析

### PMD Plugin
PHPMDで出力されるXMLファイルの解析

### DRY Plugin
PHPCPDで出力されるXMLファイルの解析

### Clover plugin
PHPUnitで--coverage-cloverにて出力されるXMLファイルの解析

### xUnit Plugin
PHPUnitで--log-junitにて出力されるXMLファイルの解析

### JDepend Plugin
PHP_Dependで出力されるXMLファイルの解析

### Plot Plugin
phplocで出力されるCSVファイルの解析

## JenkinsのPost-build Actions設定
### Checkstyle analysis results
* Checkstyle results: phing/phpcs/checkstyle.xml

### Publish PMD analysis results
* PMD results: phing/phpmd/pmd.xml

### Publish duplicate code analysis results
* Duplicate code results: phing/phpcpd/cpd.xml

### Publish Clover Coverage Report
* Clover report directory: phing/phpunit

### Publish Javadoc
* Javadoc directory: phing/phpdoc

### Publish xUnit test result report - PHPUnit-3.x (default)
* Pattern: phing/phpunit/junit.xml

### Report JDepend
* Pre-generated JDepend File: phing/pdepend/jdepend.xml

### Plot build data
* Plot group: 任意な値
* Data series file: phing/phploc/plot.csv
* Load data from csv fileを選択

### Archive the artifacts
* Files to archive: phing/phpdoc/,phing/phpunit/html/

## 参考
* [Template for Jenkins Jobs for PHP Projects](http://jenkins-php.org/)
