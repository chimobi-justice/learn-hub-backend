### API Docs [Api Docs](https://learn-hub-backend-api.onrender.com/api/docs)


# Learn-hub

This is the backend api for [learn-hub](https://learn-hub-rosy.vercel.app/) community portal.

## Requirements

The following tools are required in order to start the installation.

- PHP ^8.2
- [Composer](https://getcomposer.org/download/)
- [Valet](https://laravel.com/docs/valet#installation)

## Installation

1. Clone this repository with `git clone https://github.com/chimobi-justice/learn-hub-backend.git`
-   Change directories into learn-hub-backend
-   cd learn-hub-backend
2. Run `composer install` to install the PHP dependencies
3. Set up a local database called `learn-hub` or create a sqlite databse with 
-  touch database/database.sqlite
4. Create the .env file by duplicating the .env.example file
-   cp .env.example .env
5. Set the APP_KEY value
-   php artisan key:generate
6. Run `valet link` to link the site to a testing web address


### Please note if you're using Herd just install and start your application. 

You can now visit the app in your browser by visiting [http://learn-hub-backend.test](http://learn-hub-backend.test).

### Some required credentials

```
JWT_SECRET=
CLOUDINARY_URL=
```
