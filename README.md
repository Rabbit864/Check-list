Что используется
===
PHP - 7.3.2  
MySQL- 8.0  
Laravel - 8.33.0  

Как развернуть
=====================
***
1)```git clone https://github.com/Rabbit864/Check-list.git``` - скачать проект на компьютер.  
2)```npm i``` - скачать зависимости npm  
3)```npm run prod``` - развернуть зависимости  
4)```composer install --no-dev -o``` - скачать зависимости php  
Далее сгенерировать конфиг  
5)```copy .env.example .env``` - на Windows  
5.1)```cp .env.example .env``` - на Linux  
6)```php artisan key:generate --ansi``` - сгенировать ключ  
Далее нужно в файле .env прописать нужные настройки для подключения к бд  
Для MySql:  
DB_CONNECTION=mysql  
DB_HOST=127.0.0.1  
DB_PORT=3306  
DB_DATABASE=  
DB_USERNAME=  
DB_PASSWORD=  
7)```php artisan migrate``` - запуск миграций  
8)```php artisan serve``` - запуск тестового сервера  
