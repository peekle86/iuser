## Установка

Прослідувати 
[офіційним інструкціям Laravel](https://laravel.com/docs/9.x/installation#getting-started-on-windows)
по установці через Sail

### Ставимо аліас на sail команду
~~~
nano ~/.bashrc
~~~
##### В кінці файлу додаємо строку і зберігаємо
~~~
alias sail='bash vendor/bin/sal'
~~~
##### Застосовуємо зміни
~~~
. ~/.bashrc
~~~

#### Запускаємо образ
~~~
sail up -d
~~~
#### Виключаємо образ
~~~
sail down
~~~

## Ініціалізація

#### Запускаємо міграції
~~~
sail artisan migrate
~~~

#### Наповнюємо БД тестовими даними
~~~
sail artisan db:seed
~~~