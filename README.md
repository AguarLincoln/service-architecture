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

### 6. Preparations

```sh
sail artisan migrate
sail artisan key:generate
sail artisan nova:publish
sail artisan migrate --seed
```
### 7. Install Git flow(to develop)
[Git flow](https://www.atlassian.com/br/git/tutorials/comparing-workflows/gitflow-workflow)
    * Branch production: master
    * Branch development: dev
