# Laravel+Vue User Management application

## About Repository

A very simple Laravel 8 + Vue 2 + AdminLTE 3 based Curd Starter template for SPA Application.
<p align="center">
<img src="https://i.imgur.com/mZAHbUL.png">
</p>

## Tech Specification
- php 8
- node 14.17.0
- Laravel 8
- Vue 2 + VueRouter
- Laravel Sanctum
- Bootstrap


## Features

- Modal based Create+Edit, List with Pagination, Delete with Sweetalert
- Login, Register, Forget+Reset Password as default auth
- Profile, Update Profile, Change Password, Avatar
- Product Management
- User Management
- Settings: Categories, Tags
- Frontend and Backend User ACL with Gate Policy (type: admin/user)
- Simple Static Dashboard
- Developer Options for OAuth Clients and Personal Access Token
- Build with Docker

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
