rm -rf ./reports/apidocs
apigen -s fuel/app/ -d ./reports/apidocs/ --source-code no --todo yes --exclude `pwd`/fuel/app/_autocomplete.php
