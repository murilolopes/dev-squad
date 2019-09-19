# Dev Squad

This is a test for Dev Squad Laravel Back-end position

## Getting Started

These instructions will get you a copy of the project up to run on your local machine for development.

### Prerequisites

You need to have homestead installed in your machine with these lines:
```
sites:
    - map: dev.squad
      to: /<your-homestead-code-folder>/dev-squad/public
      schedule: true 

databases:
    - dev-squad
```

You need a .env file so you can type a cp command and change some variables as you like 23
```
cd <your-homestead-code-folder>/dev-squad
cp .env.example .env
```

### Installing

Here you will install some dependencies
```
composer install
npm install
npm run dev
```

And now, let's go populate database. This are the main application user:

Email: murilo.angelo@devsquad.com
Password: secret

```
php artisan key:generate
php artisan migrate
php artisan db:seed
```
