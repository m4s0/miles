server {
    listen  80;

    client_max_body_size 20M;

    root /var/www/web;
    index app.php index.html index.php;

    server_name dev.miles;

    error_log /var/log/nginx/error-dev.miles.log;
    access_log /var/log/nginx/access-dev.miles.log;

    add_header 'Access-Control-Allow-Origin' '*';
    add_header 'Access-Control-Allow-Methods' 'GET, POST, OPTIONS, PUT, DELETE';
    add_header 'Access-Control-Allow-Headers' 'DNT,X-CustomHeader,Keep-Alive,User-Agent,X-Requested-With,If-Modified-Since,Cache-Control,Content-Type,X-Auth-Token,Authorization';
    add_header 'Access-Control-Allow-Credentials' 'true';

    location @rewriteapp {
        # riscrittura di tutto su app.php
        rewrite ^(.*)$ /dev.php/$1 last;
    }

    location / {
     try_files $uri @rewriteapp;

     if ($request_method = OPTIONS ) {
       return 204;
     }
    }

    error_page 404 /404.html;

    error_page 500 502 503 504 /50x.html;
    location = /50x.html {
        root /usr/share/nginx/html;
    }

    location ~ ^/(app|dev|test)\.php(/|$) {
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:/var/run/php-fpm/php-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_buffers 256 16k;
        fastcgi_buffer_size 128k;
        fastcgi_busy_buffers_size 256k;
        include fastcgi_params;

        if ($request_method = OPTIONS ) {
            return 204;
        }
    }
}
