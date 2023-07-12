<p align="center">
<h1>Список задач</h1>


![Скриншот главного экрана](https://github.com/rustemib/spisok_zadach/blob/master/Screenshot%20from%202023-07-11%2013-12-44.png)

Страница списка задач для пользователя.

![Лист задач](https://github.com/rustemib/spisok_zadach/blob/master/Screenshot%20from%202023-07-11%2013-26-30.png)

Страница списка тегов.

![Список тегов](https://github.com/rustemib/spisok_zadach/blob/master/Screenshot%20from%202023-07-11%2013-26-53.png)

Создать новый тег.

![Новый тег](https://github.com/rustemib/spisok_zadach/blob/master/Screenshot%20from%202023-07-11%2013-26-59.png)

Создать задачу.

![Создать задачу](https://github.com/rustemib/spisok_zadach/blob/master/Screenshot%20from%202023-07-11%2013-27-15.png)

Поиск по названию задачи.

![Поиск задачи](https://github.com/rustemib/spisok_zadach/blob/master/Screenshot%20from%202023-07-11%2016-40-53.png)

Поиск по тегам.

![Поиск по тегам](https://github.com/rustemib/spisok_zadach/blob/master/Screenshot%20from%202023-07-11%2016-41-09.png)




Админка

![Админка](https://github.com/rustemib/spisok_zadach/blob/master/Screenshot%20from%202023-07-12%2017-53-53.png)

Список в админке

![Админка](https://github.com/rustemib/spisok_zadach/blob/master/Screenshot%20from%202023-07-12%2018-35-32.png)

Список пользователей

![Список пользователей](https://github.com/rustemib/spisok_zadach/blob/master/Screenshot%20from%202023-07-12%2018-32-27.png)

Редактирование пользователя, возможность сделать его админом.

![Редактирование пользователя](https://github.com/rustemib/spisok_zadach/blob/master/Screenshot%20from%202023-07-12%2018-32-39.png)

Список всех задач всех пользователей

![Список всех задач](https://github.com/rustemib/spisok_zadach/blob/master/Screenshot%20from%202023-07-12%2018-32-54.png)

Список тегов всех пользователей

![Список всех тегов](https://github.com/rustemib/spisok_zadach/blob/master/Screenshot%20from%202023-07-12%2018-33-05.png)

Редактирование тегов

![Редактирование тегов](https://github.com/rustemib/spisok_zadach/blob/master/Screenshot%20from%202023-07-12%2018-33-12.png)



Так же редактирование задач и тегов. У каждого пользователя свой список задач и тегов. 
</p>
Установка: 
1. Скачать проект с репозитория https://github.com/rustemib/spisok_zadach.git

    git clone https://github.com/rustemib/spisok_zadach.git
    
2. composer install
3. создать базу mysql
4. переименовать файл .env.example на .env и отредактировать
- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=имя базы
- DB_USERNAME=пользователь
- DB_PASSWORD=пароль   
5. php artisan key:generate 
6. php artisan migrate
7. npm install
8. php artisan serve
9. npm run dev 
  
У каждого пользователя свой список задач, после логина он попадает на свой список.Если админ то попадает в админку. Установить админа в таблице users column is_admin значение 1.

Вот демка -  http://37.140.198.7


<h2>Деплой на сервер</h2>

Подготовка сервера:

NGINX
```sudo apt update```
```sudo apt install nginx```
```sudo systemctl reload nginx```

MYSQL
//установка
```sudo apt install mysql-server```

//настройка
```sudo mysql```
```SELECT user,authentication_string,plugin,host FROM mysql.user;```

```ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'password';``` //установка пароля для рута

//установка безопасности
```sudo mysql_secure_installation```
//после ответов на вопросы создать нового пользователя для базы
```CREATE USER 'username'@'host' IDENTIFIED WITH mysql_native_password BY 'password';```
//создать базу
```CREATE DATABASE название базы;```

```GRANT ALL ON названиебазы.* TO 'laravel'@'localhost';```

```FLUSH PRIVILEGES;```
//установка php
//PHP-FPM-8.2

```sudo apt update && sudo apt install -y software-properties-common ```
```sudo add-apt-repository ppa:ondrej/php ```
```sudo apt update```
```sudo apt install php8.2-fpm```

//GIT
```sudo apt install git```


//COMPOSER

```sudo apt install php-cli unzip```
```cd ~```
```curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php```
```HASH=`curl -sS https://composer.github.io/installer.sig```
echo $HASH

```php -r "if (hash_file('SHA384', '/tmp/composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"```

```sudo php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer```

```composer```


NODE NPM
```curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash - &&\```
```sudo apt-get install -y nodejs```


PHP Extensions

```sudo apt-get install -y php-common php-mysql php-zip php-gd php-mbstring php-curl php-xml php-bcmath```

настройка nginx
```cd /etc/nginx/sites-available/```
```sudo nano default```
в строке
```root /var/www/сайт скаченный с гита/public;```

пометять локации что бы ходить по всем страницам 
``` # Add index.php to the list if you are using PHP
        index index.php;

        server_name _;

         location / {
             try_files $uri $uri/ /index.php?$query_string;
        }
        # pass PHP scripts to FastCGI server
        #
        location ~ \.php$ {
                include snippets/fastcgi-php.conf;
        #
        #       # With php-fpm (or other unix sockets):
                fastcgi_pass unix:/run/php/php8.2-fpm.sock;
        #       # With php-cgi (or other tcp sockets):
        #       fastcgi_pass 127.0.0.1:9000;
        }

        # deny access to .htaccess files, if Apache's document root
        # concurs with nginx's one
        #
        #location ~ /\.ht {
        #       deny all;
        #}```





