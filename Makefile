install: copy-files build

copy-files:
	cp .env.example .env

build:
	docker-compose up -d --build

post-install:
	docker-compose exec app composer update
	docker-compose exec app composer run-script post-autoload-dump
	docker-compose exec app php artisan key:generate
	docker-compose exec app php artisan migrate

seed:
	docker-compose exec app php artisan db:seed --class=EmployeeSeeder

test-unit:
	docker-compose run --rm app composer test:unit
