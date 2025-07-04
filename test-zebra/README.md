# Управление автомобилями

## Как запустить

1. Клонировать репозиторий
2. Установить зависимости:
```bash
composer install
```
3. Скопировать .env.example в .env
4. Внести переменные базы данных в .env:
```bash
DB_CONNECTION=pgsql
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```
5. Запустить docker-compose:
```bash
docker-compose up -d
```
6. Запустить миграции и сидеры:
```bash
php artisan migrate
php artisan db:seed --class=TendersCsvSeeder
```
7. Запустить сервер:
```bash
php artisan serve
```

### Для удобства прикреплены постман коллекция
