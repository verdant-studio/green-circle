# Blue Circle

## First time setup

```sh
# install deps
composer i && npm i

# migrate and seed database
php artisan migrate:fresh --seed

# create .env file and set database credentials
cp .env.example .env
```

## Getting started

```sh
# run the application
php artisan serve

# compile front-end assets
npm run watch
```

## Deployment

```sh
dep deploy
```

### Migrations

Make sure you are inside the deployer/current directory and run:

```sh
php artisan migrate
```
