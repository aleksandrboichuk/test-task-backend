# Тестове завдання

### Розгортання проєкту:
- Перейти у робочу директорію та виконати наступні команди в консолі:
    + `git clone https://github.com/aleksandrboichuk/test-task-backend.git` - клонування проєкту у робочу директорію
    + `cd test-task-backend`
    + `cp .env.example .env && cd docker && cp docker-compose.example.yml docker-compose.yml` - копіювання конфігураційних файлів для docker-compose та laravel
    + `docker-compose build && docker-compose up -d` - білд та підняття контейнерів
    + `docker-compose exec php-fpm bash` - перехід у php-fpm контейнер для встановлення композеру (та виконання в майбутньому artisan команд)
    + `composer install` - встановлення composer
    + `php artisan migrate` - виконання міграцій та заповнення тестовими данними БД

Проєкт має бути доступним за посиланням http://localhost