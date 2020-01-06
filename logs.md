#Обработка ошибок

http {
	access_log /var/log/nginx/access.log;
	error_log  /var/log/nginx/error.log;
}

nginx -t
sudo service nginx status
sudo lsof -P -n -i :80 -i 443 | grep LISTEN  //ПРОВЕРКА ДОСТУПНОСТИ ПОРТОВ
                                             //lsof - это list of open files

sudo netstat -plan | grep nginx              //ПРОВЕРКА ДОСТУПНОСТИ ПОРТОВ тоже

sudo tail -f /var/log/nginx/*.log            //проверяем ошибки в логах
sudo tail -5 /var/log/nginx/error.log
sudo tail -5 /var/log/nginx/access.log

https://stackoverflow.com/      //изба читальня

#В случае если что-то работает не как ожидалось, 
можно попытаться выяснить причину с помощью файлов access.log и error.log из каталога 
/usr/local/nginx/logs или 
/var/log/nginx.