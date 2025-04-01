# 🚀 Сервис коротких ссылок с QR-кодами

![Docker](https://img.shields.io/badge/Docker-20.10.7+-blue?logo=docker)
![Yii2](https://img.shields.io/badge/Yii-2.0.45-green)
![MySQL](https://img.shields.io/badge/MySQL-8.0-orange?logo=mysql)

Профессиональный сервис для сокращения URL-ссылок с генерацией QR-кодов.

## 🌟 Особенности

- Генерация коротких ссылок
- Создание QR-кодов
- Статистика переходов
- Docker-контейнеризация

## 🛠 Установка

### Требования
- Docker 20.10.7+
- Docker Compose 1.29.2+
- Git

### Быстрый старт

```bash
git clone https://github.com/MattewMattew/short_url_service.git
cd short_url_service
docker-compose up -d --build
docker-compose exec web composer install
docker-compose exec web ./yii migrate
```

После установки откройте:  
🔗 [http://localhost:8080](http://localhost:8080)

## 🐳 Docker-команды

| Команда | Описание |
|---------|----------|
| `docker-compose up -d --build` | Запуск проекта |
| `docker-compose down` | Остановка проекта |
| `docker-compose logs -f` | Просмотр логов |
| `docker-compose exec web bash` | Вход в контейнер |

## 🌍 Доступы

- Приложение: [http://localhost:8080](http://localhost:8080)

## ⚠️ Устранение проблем

<details>
<summary>🔧 Частые проблемы</summary>

### 1. Ошибки прав доступа
```bash
chmod -R 777 runtime web/assets
```

### 2. Очистка кэша
```bash
docker-compose exec web ./yii cache/flush-all
```

### 3. Пересборка контейнеров
```bash
docker-compose down
docker-compose up -d --build
```
</details>

## 📄 Лицензия

MIT © [MattewMattew](https://github.com/MattewMattew)

---

<div align="center">
  <sub>Создано с ❤️ для удобного сокращения ссылок</sub>
</div>
