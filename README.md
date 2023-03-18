# Laravel+Vue User Management Application

## About Repository

### A very simple Laravel 8 + Vue 2  SPA Application.

#### Login, Register using Sanctum. Show error messages from Laravel validation

![reg](https://user-images.githubusercontent.com/66250856/225889781-06d795d5-a0be-461d-9e87-8484a32da2b7.jpg)

#### CRUD User operations

![crud1](https://user-images.githubusercontent.com/66250856/225891429-4cf1ccc8-3b5b-4b58-9fb5-2d76278bee25.jpg)

#### Images uploading 

![upload](https://user-images.githubusercontent.com/66250856/225886235-e083214b-4a5b-4ca3-beb1-00851e26aa9e.jpg)

#### Swagger CRUD documentation and token generation using email and password

![swager](https://user-images.githubusercontent.com/66250856/225704864-ef10bf30-3b3d-42b3-8595-d306ed7fe206.jpg)


## Tech Specification
- PHP 8.2
- Node 16.3.0
- NPM 8.0.0
- Laravel 8
- Vue 2 + VueRouter
- Laravel Sanctum
- Bootstrap
- Docker (optionally; rootless)


## Features

- Login, Register using Sanctum
- User CRUD for auth user
- Vue form with back-end validation errors messages
- Upload avatar using vue2Dropzone
- Feature Tests for User
- Routing Vue Router

## Installation

#### Local
- `composer install`
- `cp .env.example .env`
- Update `.env` and set your database credentials
- `php artisan key:generate`
- `php artisan migrate`
- `php artisan db:seed`
- `npm install`
- `php artisan storage:link`
- `npm run dev`
- `php artisan serve`
- `admin login: admin@gmail.com; pas: 123123`

#### With Docker

- `cd docker`
- `docker-compose -f docker-compose.local.yml -p {stack-name} up -d`

### Dockerized with a script

- `./setup.sh` from the project root

#### To reset db to first state

- `php artisan migrate:fresh --seed`

## Feature Tests

- `php artisan test`

## License

[MIT license](https://opensource.org/licenses/MIT).
