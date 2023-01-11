Запуск миграций
```sh
php artisan migrate
```
Сидеры 
```sh
php artisan db:seed
```
Запуск 
```sh
php artisan serve
```

[Ссылка на Postman Api ](https://www.postman.com/mediana/workspace/best-partner/api/b8cb8360-2ebb-4b1b-9a4b-2769cf615c54)

[Ссылка на Postman Collection ](https://api.postman.com/collections/1281845-d7cde88c-caa2-4b4c-82c8-76d8e03039c3?access_key=PMAT-01GPE4PES9X23KZ941XPDA797P)

# Задача #

Нужно спроектировать каталог товаров, корзину и заказы для интернет-магазина. Затем реализовать для него JSON API. Для реализации использовать фреймворк Laravel.
 
## Требования к структуре каталога.
Каталог состоит из дерева категорий (максимальная вложенность – 3) и товаров, которые принадлежат к одной из категорий второго/третьего уровня. Товары должны иметь следующие поля:
* Название :heavy_check_mark:
* Описание :heavy_check_mark:
* Автогенерируемый slug :heavy_check_mark:
* Категория второго/третьего уровня :heavy_check_mark:
* Цена :heavy_check_mark:
* Несколько дополнительных характеристики (например длина, ширина, вес). :heavy_check_mark: 

## Требования к корзине и заказам.
* Взаимодействовать с корзиной и оформлять заказы могут как авторизованные, так и неавторизованные пользователи. :heavy_check_mark: 
* Заказы должны содержать контактную информацию покупателя (например email и телефон), а также список купленных товаров. :heavy_check_mark: 
* Для авторизированных пользователей контактная информация должна подтягиваться из профиля автоматически. :heavy_check_mark: 

## Требования к API.
API должно поддерживать авторизацию (рекомендуется использовать пакет Sanctum). :heavy_check_mark: 

Рекомендуемый состав методов API.
* Методы для регистрации/авторизации пользователей. :heavy_check_mark:
* Метод для получения дерева категорий. :heavy_check_mark: 
* Метод для получения товаров. Должен поддерживать фильтрацию по категории/категориям любого уровня, а также по цене и дополнительным характеристикам. Значения фильтров должны валидироваться. :x:
* Метод для получения товара по slug. :heavy_check_mark: 
* Методы для работы с корзиной (добавление товара, редактирование количества товара/товаров, удаление товара). :heavy_check_mark: 
* Метод для оформления заказа. :heavy_check_mark:
* Метод для получения списка заказов авторизированного пользователя.  :heavy_check_mark: 

## Дополнения к заданию.
* Будет плюсом, если дополнительные характеристики товаров будут вынесены в отдельную таблицу, а также будет реализовано API (не требующее авторизации) для добавления/удаления данных характеристик. При этом должны работать динамические фильтры для этих характеристик в методе получения товаров. :heavy_check_mark:
* Будет плюсом, если будут написаны сидеры для каталога товаров. :heavy_check_mark:
* Также будет плюсом, если разработанное приложение будет разворачиваться с помощью Docker. :x:
* Желательно приложить небольшую документацию к API (рекомендуется использовать Postman). :heavy_check_mark:
