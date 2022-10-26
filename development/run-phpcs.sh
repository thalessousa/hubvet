echo "run phpcs in tests"
./vendor/bin/phpcs --standard=PSR2 --exclude=PSR1.Methods.CamelCapsMethodName --colors --report=summary -n tests/
echo "run phpcs in database/migrations"
./vendor/bin/phpcs --standard=PSR2 --exclude=PSR1.Classes.ClassDeclaration --colors --report=summary -n database/migrations/
echo "run phpcs in app routes database/seeders database/factories"
./vendor/bin/phpcs --standard=PSR2 --colors --report=summary -n app/ routes/ database/seeders/ database/factories/
