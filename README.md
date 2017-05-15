#MongoCli
[![Build Status](https://travis-ci.org/UnderTheKnife/MongoCli.svg?branch=master)](https://travis-ci.org/UnderTheKnife/MongoCli)

##Зависимости
Для установки всех нужных зависимостей, нужно иметь документно-ориентируемую СУБД Mongo версии, не меньше 3.0.0,
и mongodb рассширение для php (не меньше версии 1.1.0).
Дальше нужно запустить комманду в консоле:
```
composer install
```
Которая поставит все нужные зависимости.

##Конфигурация
Для конфигурации нужно перейти в файлик ***config/config.php***.
Там можно увидеть такой код:
```php
return [
    'db_uri' => 'mongodb://localhost:27017',
    'db_name' => 'mydb',
];
```
* db_uri - кофигурация для подключения к серверу Mongo;
* db_name - название нужной базы данных;

##Запуск приложения
Перед запуском приложения запустите mongod сервер.
Для запуска приложения нужно ввести комманду
```
php mongocli.php
```

##Использования приложения
В приложении доступна возможность делать выборки с Mongo, используя синтаксис sql.
Структура запроса (операторы со звездочкой - объязательные):
* SELECT* - для выбора нужных полей, если нужно выбрать все поля, можно использовать *);
* FROM* - для выбора нужной коллекции;
* WHERE - для добавления условий (доступные оператор сравнения >, >=, <, <=, =, <>, так же доступны логический операторы AND и OR для объединения нескольки выражения, между операндами и операторами сравнения НЕдолжно быть пробела, например: a>2, или b<>4);
* ORDER - для сортировки записей (доступна возможность сортировать поле ASC|DESC);
* LIMIT - для ограничения n-ого количества записей;
* SKIP - для пропуска n-ого количесва записей.

Все операторы регистронезависеммые.

##Запуск тестов
Для запуска тестов достаточно написать комманду
```
phpunit
```