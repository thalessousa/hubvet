echo "run phpcbf in tests"
./vendor/bin/phpcbf --standard=PSR2 --exclude=PSR1.Methods.CamelCapsMethodName tests/
echo "run phpcbf in database/migrations"
./vendor/bin/phpcbf --standard=PSR2 --exclude=PSR1.Classes.ClassDeclaration database/migrations/
echo "run phpcbf in app routes database/seeders database/factories"
./vendor/bin/phpcbf --standard=PSR2 app/ routes/ database/seeders/ database/factories/
