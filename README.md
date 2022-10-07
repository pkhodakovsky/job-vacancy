# Job Vacancy

A simple job board where users can post their jobs and send a response to other jobs.

-   move .env.example to .env
-   run `php artisan key:generate`
-   run `php artisan migrate --seed`

## Login credentials

username: ` admin@admin.com`
password: ` admin@admin.com`

## Api Test

[open on postman](https://www.postman.com/winter-sunset-16392/workspace/public/collection/13788391-b7cc61a2-63d0-4620-9984-3c018730b9b8?action=share&creator=13788391)
` https://www.postman.com/winter-sunset-16392/workspace/public/collection/13788391-b7cc61a2-63d0-4620-9984-3c018730b9b8?action=share&creator=13788391`

## API Requests

> update,delete,create needs bears token, you able to get it from api/login or api/register

-   [request all jobs](http://localhost:8000/api/job)

    `http://localhost:8000/api/job`

-   [Request Job Filter by Creating date](http://localhost:8000/api/job?created_at=2022-10-06)
    `http://localhost:8000/api/job?created_at=2022-10-06`

> return job vacancies created at 2022-10-06

-   [Filtered By Response count](http://localhost:8000/api/job?response_count=5)
    `http://localhost:8000/api/job?response_count=5`

> return only only job vacancies with 5 response

-   [Filter By tag](http://127.0.0.1:8000/api/job?tag=larave)
    `http://127.0.0.1:8000/api/job?tag=laravel`
    > filter request by tag,response only job vacancy with the tag name
-   [Register an User](http://localhost:8000/api/auth/register)
    > should send data as form-data `name - email - password` > `http://localhost:8000/api/auth/register`
-   [Login User](http://localhost:8000/api/auth/login)
    ` http://localhost:8000/api/auth/login` > should send data as form-data - post `email - password`
-   [New Job Vacancy](http://localhost:8000/api/job)
    ` http://localhost:8000/api/job` > should send data as form-data post request `body - title`
    -   [Update Job Vacancy](http://localhost:8000/api/job/jobid)
        ` http://localhost:8000/api/job/jobid` > should send data as form-data put request `body - title`
    -   [Delete Job Vacancy](http://localhost:8000/api/job/jobid)
        ` http://localhost:8000/api/job/jobid` > should send as delete request
