# SQ1 Technical test

This is a technical test.

## Installation

Cd to project and install packages via composer.

```bash
composer install --ignore-platform-reqs
```
Rename .env.example to .env and Generate a new key

```bash
cp .env.example .env

php artisan key:generate
```

Configure database and run migrations

```bash
php artisan migrate
```
Run seeders

```bash
php artisan db:seed
```
Install frontend packages
```bach
npm install
```

Build assets
```bash
npm run build
```

To run tests 
```bash
php artisan test
```
## Usage

Run 
```bash
php artisan serve
```
Or configure a virtual host with a .test tld and go to http://sq1-technical.test


User with ID = 1
```bash
email : admin@example.com
password : password
```

## Post import cron

To import posts every 30 minutes please run this command
```bash
php artisan schedule:work
```

To run the import immediately 
```bash
php artisan import-posts:halfhourly
```
