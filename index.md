## Installation Guide MarketSoft

Please, Follow all the steps below this will 
tell you how to install the full software.
`Note: Please do not use MarketSoft for production purposes it's still in development.`

## Step 1

This will install the add-apt-repository command and update apt.
```
apt-get update
apt -y install software-properties-common curl apt-transport-https ca-certificates gnupg
```

Now we are gonna install mariadb, php
```
LC_ALL=C.UTF-8 add-apt-repository -y ppa:ondrej/php
curl -sS https://downloads.mariadb.com/MariaDB/mariadb_repo_setup | sudo bash
apt-get update
```

Install all dependencies
```
apt -y install php8.0 php8.0-{cli,gd,mysql,pdo,mbstring,tokenizer,bcmath,xml,fpm,curl,zip} mariadb-server nginx tar unzip git redis-server
```

# Step 2

Now we are gonna install composer. Composer is the system laravel uses for packages.
```curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer```

# Step 3

Now we are gonna create the directory where marketsoft will be runned in.
```
mkdir -p /var/www/MarketSoft
cd /var/www/MarketSoft
```

Here we download all the filles.
```
curl -Lo marketsoft.tar.gz https://github.com/DitIsVincentPM/marketsoft/archive/refs/tags/0.7.9.tar.gz
tar -xzvf marketsoft.tar.gz
chmod -R 755 storage/* bootstrap/cache/
```

# Step 4

Now we are gonna configure the Composer
```
cp .env.example .env
composer install --no-dev --optimize-autoloader
php artisan key:generate
php artisan p:environment:setup
```

# Step 5 

Create a Database
```
mysql -u root -p
USE mysql;

# Change the password below.
CREATE USER 'marketsoft'@'127.0.0.1' IDENTIFIED BY 'somePassword'; 

CREATE DATABASE MarketSoft;
GRANT ALL PRIVILEGES ON MarketSoft.* TO 'marketsoft'@'127.0.0.1' WITH GRANT OPTION;
FLUSH PRIVILEGES;
``` 

Setup database for MarketSoft
```
php artisan p:environment:database
php artisan migrate --seed --force
```

# Step 6 (Setting Up a WebServer)

First we are gonna install Nginx
```
apt install nginx
```

Okay now we will begin to setup a config.
```
cd /etc/nginx/sites-available
mkdir marketsoft.conf
```

Then put the code below in the file you just created and change the DOMAIN to your domain.
```
server_tokens off;

server {
    listen 80;
    server_name DOMAIN;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    server_name DOMAIN;

    root /var/www/MarketSoft/public;
    index index.php;

    client_max_body_size 100m;
    client_body_timeout 120s;

    sendfile off;

    # SSL Configuration
    ssl_certificate /etc/letsencrypt/live/DOMAIN/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/DOMAIN/privkey.pem;
    ssl_session_cache shared:SSL:10m;
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers "ECDHE-ECDSA-AES128-GCM-SHA256:ECDHE-RSA-AES128-GCM-SHA256:ECDHE-ECDSA-AES256-GCM-SHA384:ECDHE-RSA-AES256-GCM-SHA384:ECDHE-ECDSA-CHACHA20-POLY1305:ECDHE-RSA-CHACHA20-POLY1305:DHE-RSA-AES128-GCM-SHA256:DHE-RSA-AES256-GCM-SHA384";
    ssl_prefer_server_ciphers on;

    add_header X-Content-Type-Options nosniff;
    add_header X-XSS-Protection "1; mode=block";
    add_header X-Robots-Tag none;
    add_header Content-Security-Policy "frame-ancestors 'self'";
    add_header X-Frame-Options DENY;
    add_header Referrer-Policy same-origin;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:/run/php/php8.0-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param PHP_VALUE "upload_max_filesize = 100M \n post_max_size=100M";
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param HTTP_PROXY "";
        fastcgi_intercept_errors off;
        fastcgi_buffer_size 16k;
        fastcgi_buffers 4 16k;
        fastcgi_connect_timeout 300;
        fastcgi_send_timeout 300;
        fastcgi_read_timeout 300;
        include /etc/nginx/fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }
}
```

Now we are gonna create an SSL Certificate for your domain.
```
sudo apt update
sudo apt install -y certbot
sudo apt install -y python3-certbot-nginx

# Change the example.com to the domain your using.
certbot certonly --nginx -d example.com
```

Restart Nginx 
```
service nginx restart
```

# Step 7

Set your permissions
```
chown -R www-data:www-data /var/www/MarketSoft/*
```

Good luck with MarketSoft.
