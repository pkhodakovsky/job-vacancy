
# job-vacancy
A simple job board where users can post their jobs and send a response to other jobs.
* move .env.example to .env
* run ``` php artisan key:generate ```

# API Requests
* request all jobs 
``` http://localhost:8000/api/job ```
* Request Job Filter by Creating date
``` http://localhost:8000/api/job?created_at=2022-10-06 ```
* Filtered By Response count
``` http://localhost:8000/api/job?response_count=5 ```
* 
