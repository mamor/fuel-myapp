#!/bin/sh

APPPATH="./"

# .gitignore
wget -N -P ${APPPATH}../../ https://raw.github.com/mp-php/fuel-myapp/master/.gitignore --no-check-certificate

# PHPUnit
wget -N -P ${APPPATH} https://raw.github.com/mp-php/fuel-myapp/master/bootstrap_phpunit.php --no-check-certificate
wget -N -P ${APPPATH} https://raw.github.com/mp-php/fuel-myapp/master/phpunit.xml --no-check-certificate
wget -N -P ${APPPATH} https://raw.github.com/mp-php/fuel-myapp/master/phpunit.sh --no-check-certificate

# PHP-CS-Fixer
wget -N -P ${APPPATH} https://github.com/mp-php/fuel-myapp/raw/master/php-cs-fixer.phar --no-check-certificate
wget -N -P ${APPPATH} https://raw.github.com/mp-php/fuel-myapp/master/php-cs-fixer.sh --no-check-certificate

# FuelPHP classes
wget -N -P ${APPPATH}classes/ https://raw.github.com/mp-php/fuel-myapp/master/classes/dbfixture.php --no-check-certificate
wget -N -P ${APPPATH}classes/ https://raw.github.com/mp-php/fuel-myapp/master/classes/dbtestcase.php --no-check-certificate
wget -N -P ${APPPATH}classes/ https://raw.github.com/mp-php/fuel-myapp/master/classes/functionaltestcase.php --no-check-certificate

# FuelPHP config
wget -N -P ${APPPATH}config/ https://raw.github.com/mp-php/fuel-myapp/master/config/config.php --no-check-certificate
wget -N -P ${APPPATH}config/development/ https://raw.github.com/mp-php/fuel-myapp/master/config/development/config.php --no-check-certificate
wget -N -P ${APPPATH}config/test/ https://raw.github.com/mp-php/fuel-myapp/master/config/test/config.php --no-check-certificate

# FuelPHP tests
wget -N -P ${APPPATH}tests/_files/ https://raw.github.com/mp-php/fuel-myapp/master/tests/_files/.htaccess.test --no-check-certificate
wget -N -P ${APPPATH}tests/_files/ https://raw.github.com/mp-php/fuel-myapp/master/tests/_files/bootstrap.php.test --no-check-certificate

# FuelPHP tasks
wget -N -P ${APPPATH}tasks/ https://raw.github.com/mp-php/fuel-myapp/master/tasks/generate.php --no-check-certificate

# Others
# wget -N -P ${APPPATH}../../ https://raw.github.com/mp-php/fuel-myapp/master/build.xml --no-check-certificate
