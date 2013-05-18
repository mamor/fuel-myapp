rm -rf ./reports/apidocs
apigen -s fuel/app/ -d ./reports/apidocs/ --exclude=`pwd`/fuel/app/_autocomplete.php
