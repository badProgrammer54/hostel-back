# laravel build

laravel 8, nginx, mysql, docker

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
php artisan make:factory NewsFactory
```