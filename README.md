# Workopia - Job Listing Application

A Laravel-based job listing platform built following **Brad Traversy's Laravel PHP course** for learning Laravel fundamentals and best practices.

## Live Demo
**🌐 [View Live Application →](https://workopia.xyz/)**

## Description

Workopia is a job marketplace where employers can post positions and job seekers can search, bookmark, and apply to opportunities. This version includes enhancements beyond the original course: application limits, dashboard notifications, application controls.

## Features

- Job posting and management (CRUD)
- User authentication and profiles  
- Job search with filtering
- Bookmark system
- Job applications with resume upload
- Application limits (per job and per user)
- Dashboard notifications
- Mapbox integration for locations
- Email notifications
- Prevents self-applications

## Tech Stack

**Backend:** Laravel, PHP, PostgreSQL  
**Frontend:** Blade, Tailwind CSS, Alpine.js  
**Tools:** Vite, Mapbox, Mailtrap  
**Deployment:** Laravel Forge + Digital Ocean

## Installation

```bash
git clone https://github.com/ELSOLRA/Workopia-laravel.git
cd workopia
composer install && npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm run dev
php artisan serve

```

## License

Educational project based on **Brad Traversy's Laravel course** with personal enhancements.

Licensed under the [MIT License](https://opensource.org/license/MIT).