
# Install

## PHP

```sh
sudo apt-get install php-pgsql \
    php-intl php-mbstring php-fpm \
    php-xml nginx php-sqlite3
```

# Database

```sh
sudo apt-get install postgresql
```

# Change Database postgres User Password
```sh
sudo su - postgres
psql
\password

```

# Copy config

```
cp config/php8.3-fpm-test.service /etc/systemd/system/

systemctl enable php8.3-fpm-test.service
```



