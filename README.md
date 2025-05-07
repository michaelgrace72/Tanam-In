# Tanam.in 🌱

Tanam.in is a web application designed to help users manage their plants, track their growth, set reminders for plant care, and share posts about their gardening journey. Built with Laravel, this project leverages the framework's powerful features to deliver a seamless experience.

---

## Features

- **Plant Management**: Add, update, and manage plant details.
- **User Plants**: Track plants owned by users, including planting dates, locations, and statuses.
- **Reminders**: Set and manage reminders for watering, fertilizing, and harvesting plants.
- **Posts**: Share gardening updates and images with others.
- **Guides**: Step-by-step instructions for growing and caring for plants.

---

## Requirements

Before running this project, ensure you have the following installed:

- **PHP**: Version 8.1 or higher
- **Composer**: Dependency manager for PHP
- **Livewire**: For managing frontend assets
- **Database**: MySQL or any other supported database
- **Laravel**: Version 10.x (installed via Composer)

---

## Installation

Follow these steps to set up the project locally:

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/your-username/tanam.in.git
   cd tanam.in
   ```

2. **Install Dependencies**:
   ```bash
   composer install
   npm install
   ```

3. **Set up Environment Variables**:
   - Copy the example environment file and configure it:
     ```bash
     cp .env.example .env
     ```
   - Update the `.env` file with your database credentials and other necessary configurations.

4. **Generate Application Key**:
   ```bash
   php artisan key:generate
   ```

5. **Run Database Migrations**:
   ```bash
   php artisan migrate
   ```

6. **Start the Development Server**:
   ```bash
   php artisan serve
   ```

---

## Project Structure

Here is an overview of the main directories in this project:

- **app/**: Contains the core application logic, including models, controllers, and services.
- **resources/**: Holds frontend assets like views (Blade templates), CSS, and JavaScript files.
- **routes/**: Defines the application's routes (web.php for web routes, api.php for API routes).
- **database/**: Includes migrations, seeders, and factories for database management.
- **public/**: Contains publicly accessible files like images, CSS, and JavaScript.
- **config/**: Stores configuration files for various parts of the application.

---

## License

This project is licensed under the MIT License. See the LICENSE file for details.
