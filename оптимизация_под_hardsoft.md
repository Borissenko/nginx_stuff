ОПТИМИЗАЦИЯ под hardsoft
Worker Processes

# кол-во запущенных Worker Processes
systemctl status nginx
> ├─ 2017 nginx: master process /usr/sbin/nginx -c /etc/nginx/nginx.conf
  └─17968 nginx: worker process

т.е видим 2 вида процессов
кол-во worker process оптимально д.б. равным кол-ву ядер процессора

>nproc -сколько ядер у процессора компьютера
>lscpu -данные о компе

в nginx.conf прописываем
worker_processes: 4; //кол-во ядер у компа, или
worker_processes auto;


# лимит одновременно открытых файлов
>ulimit -n
>>>1024

прописываем
events {
  worker_connections 1024;
}

# прописать в начале nginx.conf
pid /var/run/new_nginx.pid

