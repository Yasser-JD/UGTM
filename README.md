# UGTM Education Platform 🎓

A modern web platform for the **UGTM (Union Générale des Travailleurs du Maroc)** education sector, built with **Laravel 10**, **Filament PHP**, and **Tailwind CSS**.

## 🚀 Features

*   **Modern Hero Slider**: Dynamic homepage slider for featured posts.
*   **News & Memos**: Categorized content with a dedicated section for Ministerial Memos.
*   **Admin Panel**: Full content management system using Filament.
*   **Responsive Design**: Mobile-friendly layout with Alpine.js interactions.
*   **RTL Support**: Fully optimized for Arabic content.

## 🛠️ Installation Guide

Follow these steps to set up the project on your local machine.

### Prerequisites
*   PHP 8.1 or higher
*   Composer
*   Node.js & NPM
*   MySQL or SQLite

### 1. Clone the Repository
```bash
git clone https://github.com/baxirbajja/UGTM.git
cd UGTM
```

### 2. Install Dependencies
Install PHP and JavaScript packages:
```bash
composer install
npm install
```

### 3. Environment Setup
Copy the example environment file and generate the application key:
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Configuration
1.  Create a database (e.g., `ugtm_db`) in your MySQL server.
2.  Open `.env` and update your database credentials:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=ugtm_db
    DB_USERNAME=root
    DB_PASSWORD=
    ```

### 5. Run Migrations & Seeders
This will create the tables and populate them with dummy data (including the admin user):
```bash
php artisan migrate --seed
```

### 6. Link Storage
To ensure images appear correctly:
```bash
php artisan storage:link
```

### 7. Build Assets
Compile the Tailwind CSS and JavaScript assets:
```bash
npm run build
```

### 8. Run the Application
Start the local development server:
```bash
php artisan serve
```
Visit `http://localhost:8000` in your browser.

---

## 🔐 Admin Access

*   **URL**: `/admin` (e.g., `http://localhost:8000/admin`)
*   **Email**: `admin@ugtm.com`
*   **Password**: `password`

## 🤝 Contributing

1.  Fork the repository.
2.  Create a new branch (`git checkout -b feature/amazing-feature`).
3.  Commit your changes (`git commit -m 'Add some amazing feature'`).
4.  Push to the branch (`git push origin feature/amazing-feature`).
5.  Open a Pull Request.
