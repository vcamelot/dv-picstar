# Requirements

Create a small PHP service that exposes a RESTful API over CRUD operations on a model.

Given the `employee` model, containing:

`name`

`position`

`superior` - the link to another employee with a management position

`startDate`

`endDate`

### We need to be able to:

1. Save, update, delete and read an employee
2. Find all the child employees of a parent employee with a management position
3. Find all employees, filtered by a specific position
4. Make sure that the above requirements are tested properly both with negative and positive scenarios
5. Have a docker image that can run the service
6. Have a docker compose that can run all the dependencies that the service requires in order to work(I.E a database)

# Solution

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
