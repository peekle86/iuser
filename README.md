## Установка

Прослідувати 
[офіційним інструкціям Laravel](https://laravel.com/docs/9.x/installation#getting-started-on-windows)
по установці Docker, WSL2

### 1. Клонуємо репозиторій в папку з проєктом
~~~
git clone git@github.com:peekle86/iuser.git
~~~

### 2. Ініціалізуємо папку vendor
~~~
docker run --rm --interactive --tty -v $(pwd):/app composer install
~~~

### 3. Копіюємо налаштування середовища з файлу .env.example в файл .env
~~~
cp .env.example .env
~~~

### 4. Ставимо аліас на sail команду
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

### 5. З папки з проєктом піднімаємо машину
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

