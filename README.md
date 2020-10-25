# laravel build

laravel 8, nginx, mysql, docker


start project
```shell script
./project.sh up -d --build
```

create model and migration
```shell script
php artisan make:model NewsCategory -m
```

running migrations
```shell script
./project.sh web php artisan migrate
```

create seeder
```shell script
php artisan make:seeder UserTableSeeder
```

create factories
```shell script
php artisan make:factory NewsPostFactory
```

run seed
```shell script
./project.sh web php artisan db:seed
```

refresh seed
```shell script
./project.sh web php artisan migrate:refresh --seed
```

create Controller
```shell script
php artisan make:controller News/BaseController
```

create restController
```shell script
php artisan make:controller Api/News/PostController --resource
```

Error solution include(/app): failed to open stream
```shell script
php artisan config:cache 
php artisan config:clear 
composer dump-autoload -o
```

Show all routes
```shell script
php artisan route:list
```

create Request
```shell script
 php artisan make:request User/UserAuthorizationRequest
```

create Request
```shell script
 php artisan make:provider ServiceProvider
```

