оптимизация сервер-клиент взаимодействия

#  Хедеры ответов сервера и время кеширования на клиенте
    location ~* \.(css|js|jpg|png)$ {
      access_log off;

      #хедеры, которые будут прикрепляться к ответу сервера
      #my_header- имя, "Go ahead!"- значение
      #что бы посмотреть хедеры ответа сервера загоняем в косоле
      #>curl I http://127.0.0.1/info.php
      add_header my_header "Go ahead!";
      add_header Cache-Control public; //это ресурс д кэшироваться на клиенте всегда
      add_header Pragma public;        //это ресурс д кэшироваться на клиенте всегда, too, old fashion
      add_header Vary Accept-Encoding;  //тело ответа может быть заархивировано

      #все css|js|jpg|png- файлы будут кешироваться у клиента в течении 1 Месяца
      expires 1M;  //60M- 60 minute, h - часов
    }
    
# см. также в proxy.md    


# Компрессия в архив файлов, посылаемых сервером клиенту.
В head запросa клиента заявлено, что броузер способен раскрывать архивы
Accept-Encoding: gzip, deflate
поэтому сервер будет посылать заархивированныые файлы, подтверждая это в хедере у ответа сервера- Для этого
хедер, подтверждающий возможность архивирования, дб заявлен
    location ~* \.(css|js|jpg|png)$ {
      add_header Vary Accept-Encoding;  //тело ответа может быть сервером заархивировано
    }

а так же дб указаны параметры для архивирования:
http {
  gzip on;
  #степень сжимания, 1-8, оптимально 3-4
  gzip_comp_level 3;

  gzip_types text/css;  //какие типы файлов мы будем сжимать
  gzip_types text/plain text/css application/json application/x-javascript text/xml
              application/xml application/xml+rss text/javascript;


    # gzip_vary on;
	# gzip_proxied any;
	
	# gzip_buffers 16 8k;
	# gzip_http_version 1.1;
	
  server {
  }
}

Проверяем эфективность сжатия
>curl http://127.0.0.1/main.css > style.css
получаем несжатый файл
>curl -H "Accept-Encoding: gzip, deflate" http://127.0.0.1/main.css > style.min.css
получаем архив

сравним параметры этих 2 полученных файлов
>ls -l style*












