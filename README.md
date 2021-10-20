## Brief

A test application written in Laravel 8, PHP 8, utilized MySQL 5, and PHPUnit. Wrapped in Docker container.

(I did not work with Codeception before and was not able to handle it in a short time)

### Docker installation

``make install``

This will create three containers:
* Nginx
* MySQL
* PHP

No changes required to .env but if you changed MySQL password in `docker-compose.yml` on previous step, make sure to update the `.env` file accordingly.

```make post-install```

This will run `composer update`, generate application key, and run migrations

```make seed```

This will seed the database with fake data (provided by `Faker` package)

### Testing

The `.env.testing` file should be fine, but please check your database credentials.

```make test```

All tests will be launched


### API Documentation

Available in `api.yaml`
