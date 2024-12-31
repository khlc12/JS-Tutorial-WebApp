# JSAcademy

A modern, interactive JavaScript learning platform built with Laravel and Vue.js. JSAcademy provides a comprehensive learning experience with interactive lessons, code examples, and real-time feedback.

## Features

- 📚 Interactive JavaScript lessons and tutorials
- 💻 Live code editor with real-time preview
- 🎯 Practice exercises and challenges
- 📝 Markdown-based content with syntax highlighting
- 🔍 Search functionality for quick access to topics
- 🌙 Modern, clean UI with responsive design

## Tech Stack

- **Frontend:** Vue.js, TailwindCSS
- **Backend:** Laravel
- **Database:** MySQL
- **Editor:** Monaco Editor
- **Markdown:** Marked.js with custom renderer
- **Icons:** Font Awesome

## Getting Started

1. Clone the repository
2. Install dependencies:
   ```bash
   composer install
   npm install
   ```
3. Set up your environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Run migrations:
   ```bash
   php artisan migrate
   ```
5. Start the development server:
   ```bash
   php artisan serve
   npm run dev
   ```

## Running on Other Devices

To access JSAcademy from other devices on your network:

### Method 1: Using Laravel's Artisan Server

1. Find your computer's IP address:
   - On Windows: Open CMD and type `ipconfig`
   - On macOS/Linux: Open terminal and type `ifconfig` or `ip addr`

2. Start the Laravel server with your IP address:
   ```bash
   php artisan serve --host=0.0.0.0 --port=8000
   ```

3. In another terminal, start Vite with host flag:
   ```bash
   npm run dev -- --host
   ```

4. Access the app from other devices:
   - Backend URL: `http://[your-ip-address]:8000`
   - Frontend dev server: `http://[your-ip-address]:5173`

### Method 2: Using Local Domain (Production-like Environment)

1. Build the assets for production:
   ```bash
   npm run build
   ```

2. Update your `.env` file:
   ```env
   APP_URL=http://[your-ip-address]:8000
   ```

3. Start the server:
   ```bash
   php artisan serve --host=0.0.0.0 --port=8000
   ```

4. Access from other devices using:
   ```
   http://[your-ip-address]:8000
   ```

### Notes
- Replace `[your-ip-address]` with your actual IP address (e.g., 192.168.1.100)
- Make sure your firewall allows connections on ports 8000 and 5173
- Both your computer and other devices must be on the same network
- For security, only use these methods on trusted networks