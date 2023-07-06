## To setup the project, please run the following commands in the project root directory
---
`composer install`
----
`php artisan key:generate`
----
`php artisan storage:link`
---
`cp .env.example .env`
---
make changes to the .env file with your  db credentials
---
`php artisan migrate --seed`

