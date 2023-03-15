# Laravel+Vue User Management Application

## About Repository

A very simple Laravel 8 + Vue 2  SPA Application.
<p align="center">
<img src="">
</p>

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
