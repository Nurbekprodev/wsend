# WSend

A modern file-sharing platform built with Laravel.  
WSend allows users to upload, manage, and share files through a clean and responsive interface.

## Live Demo

🔗 https://file-share-5lyp.onrender.com/
---

## Overview

WSend is a lightweight SaaS-style application focused on fast and simple file sharing. Users can upload files, generate shareable links, and manage everything from a modern dashboard optimized for both desktop and mobile devices.

---

## Features

- Secure file uploads
- Public file sharing
- Unique shareable links
- File management dashboard
- Authentication system
- Responsive mobile-friendly UI
- Clean and modern design
- Fast upload and sharing workflow

---

## Tech Stack

### Backend
- PHP
- Laravel

### Frontend
- Tailwind CSS
- Alpine.js
- Blade Templates

### Database
- MySQL

---

## Screenshots

### Upload Page
![Upload Page](screenshots/upload.png)

### Share Link Page
![Share Link Page](screenshots/share_link.png)

### Dashboard
![Dashboard](screenshots/dashboard.png)

---

## Installation

Clone the repository:

```bash
git clone https://github.com/your-username/wsend.git
Move into the project directory:

cd wsend

Install dependencies:

composer install
npm install

Create the environment file:

cp .env.example .env

Generate the application key:

php artisan key:generate

Configure your database credentials inside the .env file.

Run migrations:

php artisan migrate

Start the development server:

php artisan serve

Run Vite:

npm run dev
Environment Variables

Example configuration:

APP_NAME=WSend
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=wsend
DB_USERNAME=root
DB_PASSWORD=
Usage
Register or log into your account
Upload a file
Generate a shareable link
Share the link with others
Manage uploaded files from the dashboard
Project Structure
app/
bootstrap/
config/
database/
public/
resources/
routes/
storage/
tests/
Future Improvements
Drag and drop uploads
File expiration settings
Cloud storage integration
Team collaboration
Multi-language support
File analytics
Contributing

Contributions, issues, and feature requests are welcome.

Feel free to fork the repository and submit a pull request.

License

This project is licensed under the MIT License.

Author

Developed by Nurbek Makhmadaminov.
