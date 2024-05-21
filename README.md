# Setup container

## 1 - Clone Repository

## 2 - Create a .env file
Create a .env file according to the .env.example

## 3 - Build the container images
```
$ docker-compose up -d --force-recreate
```

## 4 - Start aplication
```
$ php artisan migrate:fresh && php artisan make:filament-user
```