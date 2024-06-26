
# Install Production and Staging (Live/Test) Instances of CakePHP 5.x on Ubuntu 24.04

For CakePHP 5.x `debug = true` you cannot set `zend.assertions = 1` anywhere but in `php.ini`

To have a live (zend.assertions = -1) / test (zend.assertions = 1) environment requires each nginx location/php-fpm environment to point at separate php.ini file


## Install PHP, nginx and Postgres

```sh
sudo apt-get install php-pgsql \
    php-intl php-mbstring php-fpm \
    php-xml nginx php-sqlite3 \
    postgresql
```

## Change Database postgres User Password
```sh
sudo su - postgres
psql
\password

```

## Create a parallel PHP8.3-fpm Install

```sh
cp config/php8.3-fpm-test.service /etc/systemd/system/
# or copy and edit the current one
# cp /etc/systemd/system/multi-user.target.wants/php8.3-fpm.service /etc/systemd/system/php8.3-fpm-test.service
# edit sudo vim /etc/systemd/system/php8.3-fpm-test.service

systemctl enable php8.3-fpm-test.service

```

```sh
cd /etc/php/8.3/fpm
cp php.ini php-test.ini
cp -arv pool.d pool.d-test
mv pool.d-test/www.conf pool.d-test/www-test.conf
```

Check config/php8.3 directory

## Nginx config
Sample files in config/nginx

```sh

cp config/nginx/nginx.conf /etc/nginx/site-available/default
cp config/nginx/fastcgi_params-live.conf /etc/nginx/

```

## How to create fastcgi_params conf file for nginx

This repo contains a plugin named `FastCGIParamsCreator` 

It has a command that creates a `app_fastcgi_params.conf` file based on the contents of `config/.env`

To use it run as follows

```sh
# to see the fastcgi_params output
bin/cake make_fastcgi_params

# to write it to tmp/app_fastcgi_params.conf
bin/cake make_fastcgi_params -w
```

Example output:

```
fascgi_param APP_NAME              "Test";
fascgi_param DEBUG                 "true";
fascgi_param HIJAMES               "A value with spaces";
fascgi_param APP_ENCODING          "UTF-8";
fascgi_param APP_DEFAULT_LOCALE    "en_AU";
fascgi_param APP_DEFAULT_TIMEZONE  "UTC";
```

