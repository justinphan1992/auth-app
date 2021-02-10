## Overview

Simple authentication API with JWT

## Require

- Docker
## Installation

- Clone code from Git: git clone git@github.com:justinphan1992/auth-app.git

- cd auth-app

- Install composer: docker run --rm -v $(pwd):/app composer install 

- Copy environment: .env.example => .env

- Add DB_USERNAME=laravel DB_PASSWORD=laravel in .env

- Run Docker compose: docker-compose up -d

- Generate app key : docker-compose exec app php artisan key:generate

- Cache config: docker-compose exec app php artisan config:cache

## Init Database

- Login to db service: docker-compose exec db bash

- Login to MYSQL:  mysql -u root -p

- Enter Root Password in docker-compose db service

- Grant all privileges of user to database: GRANT ALL ON laravel.* TO 'laravel'@'%' IDENTIFIED BY 'laravel';

- Clear cache permission: FLUSH PRIVILEGES;

- Exit MYSQL: EXIT;

- Exit db service: exit

- Run laravel migration: docker-compose exec app php artisan migrate