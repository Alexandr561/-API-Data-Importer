## Доступ к базе данных MySQL (локальная разработка)

**Хост:** 127.0.0.1
**Порт:** 3306
**База данных:** wb_api
**Пользователь:** root
**Пароль:** (оставить пустым)

## Доступ к продакшен-базе данных (FreeDB.tech)

**Хост:** `sql.freedb.tech`
**Порт:** `3306`
**База данных:** `freedb_freedb_wb_api`
**Пользователь:** `freedb_freedb_wb_user`
**Пароль:** `UgWAD9Sdf#t7s2$`
**Пароль нужно экранировать в кавычки**

**Примечание:** База данных развернута на бесплатном хостинге FreeDB.tech
https://freedb.tech
---

**Таблицы:**
- \`sales\` - данные продаж
- \`orders\` - данные заказов
- \`stocks\` - остатки на складах
- \`incomes\` - данные поступлений

## Установка и запуск

1. Клонировать репозиторий:
   \`\`\`
   git clone https://github.com/Alexandr561/API-Data-Importer.git
   cd API-Data-Importer
   \`\`\`

2. Установить зависимости Laravel:
   \`\`\`
   composer install
   \`\`\`

3. Настроить файл окружения:
   \`\`\`
   cp .env.example .env
   \`\`\`

4. Настроить подключение к БД в файле \`.env\`:
   \`\`\`
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=wb_api
   DB_USERNAME=root
   DB_PASSWORD=
   \`\`\`

5. Создать таблицы в базе данных:
   \`\`\`
   php artisan migrate
   \`\`\`

6. Запустить импорт данных:
   \`\`\`
   php artisan import:test
   \`\`\`


## Доступные команды

\`\`\`
# Импорт тестовых данных (5 страниц каждой таблицы)
php artisan import:test

# Очистить все таблицы
php artisan clear:data

# Пересоздать таблицы (удалить и создать заново)
php artisan migrate:fresh
\`\`\`

## Информация об API

**Хост:** 109.73.206.144:6969
**Ключ авторизации:** E6kUTYrYwZq2tN4QEtyzsbEBk3ie


