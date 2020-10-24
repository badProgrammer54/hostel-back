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
php artisan make:factory NewsFactory
```

run seed
```shell script
./project.sh web php artisan db:seed
```

refresh seed
```shell script
./project.sh web php artisan migrate:refresh --seed
```