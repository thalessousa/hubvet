echo "run phpcpd in app"
./vendor/bin/phpcpd --fuzzy app/
echo "run phpcpd in database"
./vendor/bin/phpcpd --fuzzy database/
echo "run phpcpd in tests"
./vendor/bin/phpcpd --fuzzy tests/
echo "run phpcpd in routes"
./vendor/bin/phpcpd --fuzzy routes/
