Подключение php
здесь nginx работает как прокси, а сервером является fpm

1. инстилляция
>apt-get update
>apt-get install php-fpm

подтверждаем, что установилось
>systemctl list-units | grep php
>systemctl status php7.2-fpm

2. пример nginx.conf см в папке etc,nginx/PHP.conf.
  user www-data;
  #это пишем в самом верху nginx.conf
  #www-data - это "юзер" php-fpm'a

  server {
    listen 80;
    server_name sw;

    root /var/www/demo;

    index index.php index.html;

    location / {
      try_files $uri $uri/ =404;
    }

    location ~\.php$ {
      # Pass php requests to the php-fpm service (by fastcgi-protocol, это аналог http-протокола)
      # fastcgi.conf находиться в /etc/nginx и существует от начальной установки nginx'a
      include fastcgi.conf;
      fastcgi_pass unix:/run/php/php7.2-fpm.sock;
      #unix- это like php-port

      #проверяяем наличие /run/php/php7.2-fpm.sock by командой
      #>find / -name *fpm.sock
      #и поправляем номер версии у php7.2-fpm.sock (!)
    }
  }

3. создаем php-файл в проекте
echo '<?php phpinfo(); ?>' > /var/www/demo/info.php

4. проверяем сходство портов php и nginx
ps aux | grep nginx
ps aux | grep php

=>>в начале nginx.conf дописываем
  user www-data;

5.
> systemctl reload nginx

в броузере вводим http://127.0.0.1/info.php

=>> не работает- см. log
tail -n 2 /var/log/nginx/error.log

all work !!!

6. создаем index.php и запускаем его в броузере
echo '<h1> Date: <?php echo date("l jS F"); ?></h1>' > /var/www/demo/index.php

запускаем index.php в броузере
http://127.0.0.1



# см too cache_for_php-fpm.txt
(кеширование на сервере части файлов, получаемых nginx'ом от php)











