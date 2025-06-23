# Oyster Farm - WordPress Theme & Landing Page

Современная WordPress тема и лендинг для компании, предоставляющей гастроэкскурсии на устричную ферму.

## Структура проекта

```
oyster-farm/
├── wordpress-theme/          # WordPress тема
│   ├── style.css
│   ├── index.php
│   ├── functions.php
│   ├── header.php
│   ├── footer.php
│   ├── front-page.php        # Главная страница (лендинг)
│   ├── page-services.php     # Страница услуг
│   ├── page-products.php     # Страница продукции
│   ├── page-contacts.php     # Страница контактов
│   ├── single.php           # Шаблон для блога
│   ├── assets/              # CSS, JS, изображения
│   └── inc/                 # Дополнительные функции
├── landing-page/            # Отдельный лендинг
│   ├── index.html
│   ├── css/
│   ├── js/
│   └── images/
└── documentation/           # Документация
```

## Установка WordPress темы

1. Скопируйте папку `wordpress-theme` в `/wp-content/themes/` вашего WordPress сайта
2. Активируйте тему в админ-панели WordPress
3. Настройте главную страницу как статическую в Настройки > Чтение
4. Создайте необходимые страницы (Услуги, Продукция, Контакты, Новости)

## Установка лендинга

1. Загрузите содержимое папки `landing-page` на хостинг
2. Настройте домен для лендинга
3. При необходимости интегрируйте с WordPress через API

## Особенности

- Адаптивный дизайн
- SEO-оптимизация
- Интеграция с социальными сетями
- Мультиязычность (готовность)
- Блог с удобным управлением
- Формы обратной связи
- Галерея изображений

## Технологии

- HTML5, CSS3, JavaScript
- PHP (WordPress)
- Bootstrap 5
- Font Awesome
- Google Fonts 