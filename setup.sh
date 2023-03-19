#!/bin/bash

if [ ! -f '.env' ]; then
    cp ./.env.example ./.env
fi

docker-compose -f docker/docker-compose.local.yml -p user-management-v2 up -d

cd .. || exit

docker exec -it -u 1000 user-management-laravel-v2 composer i
docker exec -it -u 1000 user-management-laravel-v2 php artisan key:generate
docker exec -it -u 1000 user-management-laravel-v2 php artisan migrate:fresh
docker exec -it -u 1000 user-management-laravel-v2 php artisan db:seed
docker exec -it -u 1000 user-management-laravel-v2 php artisan storage:link
docker exec -it -u 1000 user-management-laravel-v2 php artisan test

docker exec -it -u 1000 user-management-node-js-v2 npm i
docker exec -it -u 1000 user-management-node-js-v2 npm run dev
