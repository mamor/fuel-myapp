#!/bin/sh

if [ ! -e oil ]; then
echo 'Not FuelPHP root directory.'
exit 1
fi

APPPATH="fuel/app/"

# Composer
php composer.phar install

# Root
wget -N -P ./ https://raw.github.com/mp-php/fuel-myapp/master/.gitignore --no-check-certificate
# wget -N -P ./ https://raw.github.com/mp-php/fuel-myapp/master/build.xml --no-check-certificate

# fuel/app/
wget -N -P ${APPPATH} https://raw.github.com/mp-php/fuel-myapp/master/bootstrap_phpunit.php --no-check-certificate
wget -N -P ${APPPATH} https://raw.github.com/mp-php/fuel-myapp/master/phpunit.xml --no-check-certificate

# fuel/app/bin/
wget -N -P ${APPPATH}bin/ https://raw.github.com/mp-php/fuel-myapp/master/bin/phpunit.sh --no-check-certificate
wget -N -P ${APPPATH}bin/ https://github.com/mp-php/fuel-myapp/raw/master/bin/php-cs-fixer.phar --no-check-certificate
wget -N -P ${APPPATH}bin/ https://raw.github.com/mp-php/fuel-myapp/master/bin/php-cs-fixer.sh --no-check-certificate
wget -N -P ${APPPATH}bin/ https://raw.github.com/mp-php/fuel-myapp/master/bin/apigen.sh --no-check-certificate

# fuel/app/classes/
wget -N -P ${APPPATH}classes/ https://raw.github.com/mp-php/fuel-myapp/master/classes/dbfixture.php --no-check-certificate
wget -N -P ${APPPATH}classes/ https://raw.github.com/mp-php/fuel-myapp/master/classes/dbtestcase.php --no-check-certificate
wget -N -P ${APPPATH}classes/ https://raw.github.com/mp-php/fuel-myapp/master/classes/functionaltestcase.php --no-check-certificate

# fuel/app/config/
wget -N -P ${APPPATH}config/ https://raw.github.com/mp-php/fuel-myapp/master/config/config.php --no-check-certificate
wget -N -P ${APPPATH}config/development/ https://raw.github.com/mp-php/fuel-myapp/master/config/development/config.php --no-check-certificate
wget -N -P ${APPPATH}config/test/ https://raw.github.com/mp-php/fuel-myapp/master/config/test/config.php --no-check-certificate

# fuel/app/tests/
wget -N -P ${APPPATH}tests/_files/ https://raw.github.com/mp-php/fuel-myapp/master/tests/_files/.htaccess.test --no-check-certificate
wget -N -P ${APPPATH}tests/_files/ https://raw.github.com/mp-php/fuel-myapp/master/tests/_files/bootstrap.php.test --no-check-certificate

# fuel/app/tasks/
wget -N -P ${APPPATH}tasks/ https://raw.github.com/mp-php/fuel-myapp/master/tasks/generate.php --no-check-certificate
php oil r generate:autocomplete
rm ${APPPATH}tasks/generate.php

echo '' # new line
exit 0
