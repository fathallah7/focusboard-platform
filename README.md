# FocusBoard Platform

A full-stack productivity platform with a Laravel backend API and a Vue 3 frontend.

---

## Project Structure

```
backend/   # Laravel 12 REST API 
frontend/  # Vue 3 SPA 
```

---

## Backend (Laravel)

- **Tech:** Laravel 12, Sanctum (API auth), Tailwind CSS, MySQL
- **API:** Tasks, Quotes, Reactions, Contact Messages, User Auth/Profile

### Setup

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

### Testing

```sh
php artisan test
```

---

## Frontend (Vue 3 + Vite)

- **Tech:** Vue 3, Vue Router, Axios, Tailwind CSS, Vite

### Setup

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

