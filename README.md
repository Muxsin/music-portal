# Music Portal

Music Portal is a web application that allows users to explore and interact with music content, including albums, artists, and tracks. Users can mark their favorite artists and tracks, while admins have the ability to manage the content.

## Features

- View albums and tracks
- Add, edit, and delete albums (Admin only)
- Like tracks and favorite artists
- User authentication and authorization
- Admin dashboard for managing music content

## Requirements

- PHP >= 7.4
- Composer
- Laravel 8.x or higher
- MySQL or another database system supported by Laravel
- Node.js (for front-end assets)
- NPM (for managing front-end dependencies)

## Installation

1. **Clone the repository:**

    ```bash
    git clone https://github.com/Muxsin/music-portal
    cd music-portal
    ```

2. **Install dependencies:**

    - PHP dependencies:

    ```bash
    composer install
    ```

    - Front-end dependencies:

    ```bash
    npm install
    ```

3. **Set up environment variables:**

    Copy the `.env.example` file to `.env`:

    ```bash
    cp .env.example .env
    ```

    Configure the database and other settings in the `.env` file.

4. **Generate application key:**

    ```bash
    php artisan key:generate
    ```

5. **Run migrations:**

    ```bash
    php artisan migrate
    ```

5. **Create Admin user:**

    ```bash
    php artisan make:admin
    ```

7. **Serve the application:**

    ```bash
    php artisan serve
    ```

    Now you can access the application in your browser at `http://localhost:8000`.

## Routes

- `/`: Home page
- `/albums`: View albums (Admin: create, edit, delete)
- `/albums/{album}`: View a single album with associated tracks
- `/dashboard`: User's dashboard with their favorite tracks and artists
- `/login`: Login page
- `/register`: Register page

## Contributing

We welcome contributions to this project. To contribute:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/your-feature`)
3. Commit your changes (`git commit -am 'Add new feature'`)
4. Push to the branch (`git push origin feature/your-feature`)
5. Create a new Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
