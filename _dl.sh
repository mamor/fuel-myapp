#!/bin/sh

APPPATH="./"

wget -P ${APPPATH}../../ https://raw.github.com/mp-php/fuel-myapp/master/build.xml

wget -P ${APPPATH} https://raw.github.com/mp-php/fuel-myapp/master/bootstrap_makegood.php
wget -P ${APPPATH} https://github.com/mp-php/fuel-myapp/raw/master/php-cs-fixer.phar
wget -P ${APPPATH} https://raw.github.com/mp-php/fuel-myapp/master/php-cs-fixer.sh
wget -P ${APPPATH} https://raw.github.com/mp-php/fuel-myapp/master/phpunit.xml

wget -P ${APPPATH}classes/ https://raw.github.com/mp-php/fuel-myapp/master/classes/dbfixture.php
wget -P ${APPPATH}classes/ https://raw.github.com/mp-php/fuel-myapp/master/classes/dbtestcase.php

wget -P ${APPPATH}config/ https://raw.github.com/mp-php/fuel-myapp/master/config/config.php
wget -P ${APPPATH}config/development/ https://raw.github.com/mp-php/fuel-myapp/master/config/development/config.php
wget -P ${APPPATH}config/test/ https://raw.github.com/mp-php/fuel-myapp/master/config/test/config.php

wget -P ${APPPATH}tasks/ https://raw.github.com/mp-php/fuel-myapp/master/tasks/coverage.php
wget -P ${APPPATH}tasks/ https://raw.github.com/mp-php/fuel-myapp/master/tasks/generate.php
wget -P ${APPPATH}tasks/ https://raw.github.com/mp-php/fuel-myapp/master/tasks/phpdoc.php
wget -P ${APPPATH}tasks/ https://raw.github.com/mp-php/fuel-myapp/master/tasks/testcase.php
