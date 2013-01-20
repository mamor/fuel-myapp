#!/bin/sh

APPPATH="./"

wget -N -P ${APPPATH}../../ https://raw.github.com/mp-php/fuel-myapp/master/build.xml

wget -N -P ${APPPATH} https://raw.github.com/mp-php/fuel-myapp/master/bootstrap_makegood.php
wget -N -P ${APPPATH} https://github.com/mp-php/fuel-myapp/raw/master/php-cs-fixer.phar
wget -N -P ${APPPATH} https://raw.github.com/mp-php/fuel-myapp/master/php-cs-fixer.sh
wget -N -P ${APPPATH} https://raw.github.com/mp-php/fuel-myapp/master/phpunit.xml

wget -N -P ${APPPATH}classes/ https://raw.github.com/mp-php/fuel-myapp/master/classes/dbfixture.php
wget -N -P ${APPPATH}classes/ https://raw.github.com/mp-php/fuel-myapp/master/classes/dbtestcase.php

wget -N -P ${APPPATH}config/ https://raw.github.com/mp-php/fuel-myapp/master/config/config.php
wget -N -P ${APPPATH}config/development/ https://raw.github.com/mp-php/fuel-myapp/master/config/development/config.php
wget -N -P ${APPPATH}config/test/ https://raw.github.com/mp-php/fuel-myapp/master/config/test/config.php

wget -N -P ${APPPATH}tasks/ https://raw.github.com/mp-php/fuel-myapp/master/tasks/coverage.php
wget -N -P ${APPPATH}tasks/ https://raw.github.com/mp-php/fuel-myapp/master/tasks/generate.php
wget -N -P ${APPPATH}tasks/ https://raw.github.com/mp-php/fuel-myapp/master/tasks/phpdoc.php
wget -N -P ${APPPATH}tasks/ https://raw.github.com/mp-php/fuel-myapp/master/tasks/testcase.php
