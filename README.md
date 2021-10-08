# Тестовое задание для PHP + Laravel.

[Ссылка на текст задания](https://n1creator.com/whtestphp.html).

* Конвертирование названий столбцов при получении объекта из БД из `underscore_case` в `camelCase`.
* Обратное конвертирование перед сохранением объекта в БД.

## Использование конвертирования

Чтобы подключить конвертирование к любой модели, необходимо в методе `\App\Providers\EventServiceProvider::boot` подключить `CamelCaseFieldsObserver` для желаемой модели. 

Например:

```php 
ToDoList::observe(CamelCaseFieldsObserver::class);
```

# About Laravel 

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
