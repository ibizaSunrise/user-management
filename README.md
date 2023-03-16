# Laravel+Vue User Management Application

## About Repository

### A very simple Laravel 8 + Vue 2  SPA Application.
- Login, Register using Sanctum. Show error messages from Laravel validation

![login](https://user-images.githubusercontent.com/66250856/225461141-48346aa6-2af6-444a-8b93-5409df6c7fc9.jpg)
![registration](https://user-images.githubusercontent.com/66250856/225461153-c995abcc-d98e-4f45-b5ec-3e95ccb3eb6e.jpg)

- CRUD User operations

![createUser](https://user-images.githubusercontent.com/66250856/225462133-7757a8ba-b6dc-4ed5-8137-9f20667fcc4d.jpg)
![updateUser](https://user-images.githubusercontent.com/66250856/225462143-9d497425-7856-422d-b45f-0480f3472eb5.jpg)

- Images uploading 

![uploadAvatar](https://user-images.githubusercontent.com/66250856/225462151-fb29e070-cddb-4ff8-9b98-b2ec58f64f4a.jpg)

- Swagger CRUD documentation and token generation using email and password

![swager](https://user-images.githubusercontent.com/66250856/225704864-ef10bf30-3b3d-42b3-8595-d306ed7fe206.jpg)


## Tech Specification
- php 8
- node 14.17.0
- Laravel 8
- Vue 2 + VueRouter
- Laravel Sanctum
- Bootstrap


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

#### To reset db to first state

- `php artisan migrate:fresh --seed`

## Feature Tests

- `php artisan test`

## License

[MIT license](https://opensource.org/licenses/MIT).
