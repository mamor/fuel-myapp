rm -rf ./coverage
phpunit --group=App --coverage-html ./coverage -c fuel/app/phpunit.xml
