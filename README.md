## Installation

### 1. Install docker

See: https://docs.docker.com/engine/install/

### 2. Install docker Compose

See: https://docs.docker.com/compose/install/

> **Important!** If you are a Linux user, also see this: https://docs.docker.com/engine/install/linux-postinstall/

### 3. Install composer dependencies

The command below will install the composer dependencies using docker, so if you don't have composer locally, you're
covered.

```shell
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install
```

### 4. Generate .env 
```sh
cp .env.example .env
```
### 5. Run the containers

```
./vendor/bin/sail up -d
```

> **PRO TIP:** You can create an alias for the `./vendor/bin/sail` command
> with `alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
`, and simply type `sail up -d`. From this point forward, we will assume you have the alias configured.

> To stop the containers, run `sail down`

### 6. Install passport

```sh
sail artisan passport:install --uuids
sail artisan passport:client --password
```
#### 6.1 example login
    With credentials generated from sail artisan passport:client --password

    ```sh
    curl --location 'http://0.0.0.0/oauth/token' \
--header 'Accept: application/json' \
--header 'Content-Type: application/x-www-form-urlencoded' \
--header 'Cookie: XSRF-TOKEN=eyJpdiI6Inl3YXVkMVZoS3gzOCtyRlRZcHZaNmc9PSIsInZhbHVlIjoiU2ltaVQ5bmhZUGNmdjJCUTFZQW1ZTy83Ulc3TmUxZThIcnlkYytnQkkvd2xyZXgxc25RRDBMb0RUWWVMUVgvblcvaHA5NWFlS2taN0FQaW13M1l0ZlFETFJ1UWtwUHhMR1JHaDdodlArRUdKajZOa28yZFRscVJHQXhtUVBVYXIiLCJtYWMiOiI0YTcwMjZhMjA5MWMyNDgzZDEwZjc5Yzg4NjJmMmQxMzNjN2IyNjA1MDlkNTFjZTg2YTU0MTA4ZTBhZjI1ODEwIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6Im5RR01oT3BTaTBQOVVXUnl2YzU4c1E9PSIsInZhbHVlIjoiRldzQ0FhRlVNc1QwTy9TUnNHTzB4T1g5Y1dpVXZzdWxpbWo3ZVA3R3JvWFpIazI2YVRRRTFaQjNwaVlUcWhYVGgvc3dCS21ITjQxbmlGUGJ1Y0QxV2NxSWtaYTZWcWpqeStWVWQvVW9yK3Q3a08xSFJEeCtMeWhEdjBmRW9JV1kiLCJtYWMiOiI3Y2Y0Y2YzNTA5NTZlYzdkNzgzMWM4Yzk1NzViMDlkZjU1Y2U2ZWU3YzYzNWEyZmNlYzViZmFjMmUxNTM4YjRkIiwidGFnIjoiIn0%3D' \
--data-urlencode 'grant_type=password' \
--data-urlencode 'client_id=CLIENT_ID' \
--data-urlencode 'client_secret=CLIENT_SECRET' \
--data-urlencode 'username=EMAIL' \
--data-urlencode 'password=PASSWORD' \
--data-urlencode 'scope='
```

### 7. Preparations

```sh
sail artisan migrate
sail artisan migrate --seed
```

### 8. Install Git flow(to develop)
[Git flow](https://www.atlassian.com/br/git/tutorials/comparing-workflows/gitflow-workflow)
    * Branch production: master
    * Branch development: dev
