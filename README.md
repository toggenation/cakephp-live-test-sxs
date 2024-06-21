
# Install a Production and Staging (Live/Test) CakePHP 5.x instances on Ubuntu 24.04

For CakePHP 5.x `debug = true` you cannot set `zend.assertions = 1` anywhere but in `php.ini`

So to have a live (zend.assertions = -1) / test (zend.assertions = 1) environment requires each nginx environment to point at separate php.ini file


## Install PHP, nginx and Postgres

```sh
sudo apt-get install php-pgsql \
    php-intl php-mbstring php-fpm \
    php-xml nginx php-sqlite3 \
    postgresql
```

# Change Database postgres User Password
```sh
sudo su - postgres
psql
\password

```

# Create a parrallel PHP8.3-fpm Install

```sh
cp config/php8.3-fpm-test.service /etc/systemd/system/
systemctl enable php8.3-fpm-test.service
```

```sh
cd /etc/php/8.3/fpm
cp php.ini php-test.ini
cp -arv pool.d pool.d-test
mv pool.d-test/www.conf pool.d-test/www-test.conf
```

Check config/php8.3 directory

# Nginx config
Sample files in config/nginx

```sh

cp config/nginx/nginx.conf /etc/nginx/site-available/default
cp config/nginx/fastcgi_params-live.conf /etc/nginx/

```



