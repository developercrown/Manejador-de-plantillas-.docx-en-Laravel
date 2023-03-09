docker-compose run --rm composer install --optimize-autoloader --no-dev


docker exec -it app-titulos-digitales php artisan config:cache

docker exec -it app-titulos-digitales php artisan route:cache

docker exec -it app-titulos-digitales php artisan view:cache

docker-compose run --rm composer dump-autoload

// config for .env file

APP_NAME=Laravel
APP_ENV=production
APP_KEY=base64:eIKO6RXCok2Ie264Q+PMgidoaZOhPR96IHAHIHQd2ME=
APP_DEBUG=false
APP_URL=http://localhost


docker-compose run --rm composer create-project laravel/laravel app
docker exec -it titulos_digitales_mysql_db_server mysql mysql -ustitulos_digitales_devcrown -pBrfm2RAu@FfwTSvD -Dsistema_titulos_digitales

docker exec -it titulos_digitales_mysql_db_server mysql mysql -uroot -pB60FDEC223EADD6C5E4EC855C6B24F286413A1B5 sistema_titulos_digitales

docker exec -it app-titulos-digitales php artisan storage:link

docker exec -it app-titulos-digitales ls -la

solution for [The stream or file "/var/www/storage/logs/laravel.log" could not be opened in append mode: Failed to open stream: Permission denied]

docker exec -it app-titulos-digitales bash
chmod -R 777 ./storage


-- common commands

# create a model with factory, migration, seeder and controller
    - docker exec -it app-titulos-digitales php artisan make:model institution -a