Recycle Batteries
=======

# setup
 1 - composer install
 2 - php bin/console doctrine:database:create 
 3 - php bin/console doctrine:migrations:migrate --no-interaction
 4 - php bin/console server:run
    * endpoints:
    http://localhost:8000/app_dev.php/ - statistic page
# Run test
 * vendor/bin/phpunit


