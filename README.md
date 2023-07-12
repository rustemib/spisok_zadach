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
