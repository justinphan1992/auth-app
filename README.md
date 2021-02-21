## Overview

Simple authentication API with JWT

## Require

- Docker
## Installation

- Clone code from Git: 

```bash
git clone git@github.com:justinphan1992/auth-app.git
```

- Go to app folder
```bash
cd auth-app
```

- Install composer packages
```bash
docker run --rm -v $(pwd):/app composer install 
```

- Copy environment: .env.example => .env
```bash
cp .env.example .env
```

- Add Database config into .env 
```bash
DB_USERNAME=laravel 
DB_PASSWORD=laravel
```

- Run Docker compose
```bash
docker-compose up -d
```

- Generate app key
```bash
docker-compose exec app php artisan key:generate
```
- Cache app config
```bash
docker-compose exec app php artisan config:cache
```
## Init Database

- Login to db service
```bash
docker-compose exec db bash
```

- Login to MYSQL and enter root password in DB service
```bash
mysql -u root -p
```

- Grant all privileges of user to database
```bash
GRANT ALL ON laravel.* TO 'laravel'@'%' IDENTIFIED BY 'laravel';
```

- Clear cache permission
```bash
FLUSH PRIVILEGES;
```

- Exit MYSQL
```
exit
```

- Exit docker service
```
exit
```

- Run laravel migration
```bash
docker-compose exec app php artisan migrate
```

- Seeding database
```bash
docker-compose exec app php artisan db:seed
```
