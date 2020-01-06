REDIRECT

# простой редирект.
при наборе /greet мы редиректнимся на /home
причем в строке броузера адрес тоже поменяется на  /home

location /greet {
  return 307 /home;
}

# rewrites- переписывание получаемого сервером URL'a
при наборе /user/kola редиректнимся на /greet
причем в строке броузера адрес останется /user/kola
^/user/\w+ - это RE,
\w+        - это переменная

rewrite ^/user/\w+ /greet;

location /greet {
  return 200 "Hi!";
}

# rewrites с использованием 2 переменных
при наборе /user/kola/ola редиректнимся на /greet/kola/ola
значение первого (\w+) присудится переменной $1
значение второго (\w+) присудится переменной $2
причем в строке броузера адрес останется /user/kola/ola

rewrite ^/user/(\w+)/(\w+) /greet/$1/$2;

location = /greet/kola/ola {
  return 200 "Hi /kola/ola!";
}


# заявление 2 rewrites последовательно
введем /user/john

    rewrite ^/user/(\w+) /greet/$1;
    rewrite ^/greet/john /thumb.png;    
 ==>> редиректнимся на /thumb.png

    rewrite ^/user/(\w+) /greet/$1 last;
    rewrite ^/greet/john /thumb.png;
 ==>> редиректнимся на /greet/john, т.к. использовали  last, который прерывает переписывание
