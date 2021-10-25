# Yellow Media Test

## How to test
1. Clone the project `git clone git@github.com:zhovtyj/yellow-media-test.git`
2. Run docker compose `docker-compose up -d`
3. Go into your container `docker exec -it yellow-media-test_php-fpm_1 bash`
4. Install vendors in the container `composer install`
5. Copy and set up your .env file `cp .env.example .env`
6. Run migrations and seeders `php artisan migrate --seed`
7. Run tests `vendor/bin/phpunit`
8.You can access API endpoints: http://localhost:19000/api/...
