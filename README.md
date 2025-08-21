# FocusBoard Platform

A full-stack productivity platform with a Laravel backend API and a Vue 3 frontend.

---

## Project Structure

```
backend/   # Laravel 12 REST API 
frontend/  # Vue 3 SPA 
```

---

## Backend (Laravel) Setup

```sh
cd backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run dev
php artisan serve
```

---

## Frontend (Vue 3) Setup

```sh
cd frontend
npm install
npm run dev
```

---

## Features

- User authentication (register, login, logout)
- Task management (CRUD, priorities, statuses)
- Quotes with like/dislike reactions
- User profile management
- Contact message submission
- Dashboard analytics

