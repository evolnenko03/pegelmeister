## Dependencies
- PHP 8
- composer
- https://laravel.com/docs/12.x#creating-a-laravel-project

## Installation
- `cp .env.example .env`
- `npm i`
- `composer update`
- `composer run post-create-project-cmd`

## Usage
- First, seed the Database
- `php artisan migrate:fresh --seed`
- `php artisan serve` (localhost:8000)
