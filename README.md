## Dependencies
- PHP 8.4
- composer
- https://laravel.com/docs/12.x#creating-a-laravel-project

## Installation
- `cp .env.example .env`
- `npm i`
- `composer update`
- `composer run post-create-project-cmd` (To install SQLite)

## Usage
- First, seed the Database
- `php artisan migrate:fresh --seed` (With fresh, it resets the database and with the flag --seed you add test data.)
- `php artisan serve` (localhost:8000)
- `npm run dev` (So vite runs)

## Deployment

- ssh into server

```
cd /var/www/pegelmeister
```

```
git pull
```

```
./deploy.sh
```
