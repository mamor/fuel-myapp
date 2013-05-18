rm -rf ./coverage
phpunit --group=App --coverage-html ./reports/coverage -c fuel/app/phpunit.xml
