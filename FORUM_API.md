# Документация API Форума

Базовый URL: `/api/v1/forum`

## 1. Категории

### Получить список категорий
Возвращает список всех категорий форума с количеством тем в каждой.

- **URL**: `/categories`
- **Method**: `GET`
- **Auth**: Не требуется

**Пример ответа:**
```json
[
    {
        "id": 1,
        "name": "General Discussion",
        "slug": "general-discussion",
        "icon_name": "chat_bubble",
        "color_code": "#3B82F6",
        "topics_count": 5
    },
    {
        "id": 2,
        "name": "Questions",
        ...
    }
]
```

---

## 2. Темы (Topics)

### Получить список тем
Возвращает пагинированный список тем с возможностью фильтрации и сортировки.

- **URL**: `/topics`
- **Method**: `GET`
- **Auth**: Не требуется
- **Query Parameters**:
    - `category_id` (optional, int): ID категории для фильтрации.
    - `search_query` (optional, string): Поиск по заголовку.
    - `sort` (optional, string):
        - `latest`: Новые (по умолчанию).
        - `popular`: Популярные (по просмотрам и лайкам).
        - `hot`: Горячие/В тренде.
    - `page` (optional, int): Номер страницы.

**Пример ответа:**
```json
{
    "current_page": 1,
    "data": [
        {
            "id": 12,
            "title": "Как изучать историю?",
            "content": "<p>Текст...</p>",
            "views_count": 150,
            "slug": "kak-izuchat-istoriyu",
            "is_pinned": false,
            "is_hot": true,
            "replies_count": 5,
            "created_at_human": "2 часа назад",
            "user": {
                "id": 5,
                "name": "Alihan",
                "avatar": "https://ui-avatars.com/..."
            },
            "category": {
                "id": 2,
                "name": "Questions",
                "color_code": "#EF4444",
                "slug": "questions"
            }
        }
    ],
    "total": 50,
    "per_page": 20
}
```

### Создать новую тему
- **URL**: `/topics`
- **Method**: `POST`
- **Auth**: **Требуется (Bearer Token)**
- **Body**:
```json
{
    "title": "Мой вопрос про историю",
    "content": "Текст вопроса...",
    "category_id": 2
}
```

### Получить детали темы
Возвращает полную информацию о теме. Если пользователь авторизован, показывает, добавил ли он тему в закладки.
*Side effect: Увеличивает счетчик просмотров.*

- **URL**: `/topics/{id}`
- **Method**: `GET`
- **Auth**: Опционально (для поля `is_bookmarked_by_me`)

**Пример ответа:**
```json
{
    "id": 12,
    "title": "Как изучать историю?",
    "content": "Полный текст...",
    "views_count": 151,
    "likes_count": 10,
    "replies_count": 5,
    "is_pinned": false,
    "is_hot": true,
    "created_at_human": "2 часа назад",
    "is_bookmarked_by_me": true, // Если пользователь авторизован
    "user": { ... },
    "category": { ... }
}
```

---

## 3. Ответы (Replies)

### Получить ответы темы
- **URL**: `/topics/{id}/replies`
- **Method**: `GET`
- **Auth**: Опционально (для поля `is_liked_by_me`)
- **Query Parameters**:
    - `page` (int): Пагинация.

**Пример ответа:**
```json
{
    "data": [
        {
            "id": 45,
            "content": "Ответ на вопрос...",
            "is_best_answer": false,
            "likes_count": 3,
            "is_liked_by_me": false, // Если пользователь авторизован
            "created_at_human": "15 минут назад",
            "user": {
                "id": 8,
                "name": "User 2",
                "avatar": "..."
            },
            "reply_to_user": null // Или объект user, если это ответ на ответ
        }
    ]
}
```

### Оставить ответ
- **URL**: `/topics/{id}/replies`
- **Method**: `POST`
- **Auth**: **Требуется (Bearer Token)**
- **Body**:
```json
{
    "content": "Спасибо за ответ!",
    "reply_to_user_id": 8 // Опционально, если отвечаем конкретному пользователю
}
```

---

## 4. Взаимодействия (Interactions)

### Лайк / Дизлайк
Переключает состояние лайка (Toggle). Работает и для тем, и для ответов.

- **URL**: `/interactions/like`
- **Method**: `POST`
- **Auth**: **Требуется**
- **Body**:
```json
{
    "id": 12,         // ID темы или ответа
    "type": "topic"   // Или "reply"
}
```

**Ответ:**
```json
{
    "message": "Liked" // Или "Unliked"
}
```

### Добавить в закладки / Удалить
Переключает состояние закладки для темы.

- **URL**: `/interactions/bookmark`
- **Method**: `POST`
- **Auth**: **Требуется**
- **Body**:
```json
{
    "topic_id": 12
}
```

**Ответ:**
```json
{
    "message": "Bookmarked" // Или "Unbookmarked"
}
```
