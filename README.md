# Example App - Check-In Management System

A modern, full-stack CRUD application built with Laravel and JavaScript for managing location-based check-ins. This project demonstrates professional development practices including comprehensive testing, security implementation, and modern web development patterns.

## Why I built this
This app was built as a sample project for a potential employer looking for strong PHP and Laravel fundamentals. I kept the feature set minimal to focus on clean structure, secure design, and good developer practices.

## Features

- **Complete CRUD Operations**: Create, read, update, and delete check-ins
- **Location-Based Data**: Store and manage latitude/longitude coordinates
- **UI Updates**: Smooth UX with fast, responsive interactions and feedback.
- **Validation with Feedback**: Forms are validated server-side using Laravel’s built-in rules, with errors shown inline for clarity.
- **Secure Implementation**: CSRF protection and proper authentications
- **Professional Testing**: Full test suite with edge case coverage
- **Frontend Stack**: Built with ES6, async/await, and Axios for clean API calls — no frameworks, just modular JavaScript.

## Next Steps (If This Were Production)
- Add role-based user accounts and access control
- Implement Google Maps integration or static thumbnails
- Include media uploads (S3, local)
- Expand API endpoints for external app integration

## Tech Stack

### Backend
- **Laravel 11**: PHP framework with modern features
- **MySQL**: Primary database (with SQLite for testing)
- **Laravel Sanctum**: API authentication (ready for expansion)
- **PHP 8.2+**: Modern PHP with type declarations

### Frontend
- **Vanilla JavaScript**: ES6 modules and modern browser APIs
- **Axios**: HTTP client with interceptors and error handling
- **Tailwind CSS**: Utility-first CSS framework for responsive design
- **Vite**: Modern build tool with hot reload

### Development & Testing
- **PHPUnit**: Comprehensive test suite with 100% feature coverage
- **Laravel Sail**: Docker development environment
- **SQLite**: In-memory database for fast testing
- **Git**: Version control with meaningful commits

## Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js 18+ and npm
- Docker (if using Laravel Sail)

## Quick Start

### Using Laravel Sail (Recommended)

```bash
# Clone the repository
git clone <repository-url>
cd example_app

# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install

# Copy environment file
cp .env.example .env

# Start the Docker environment
./vendor/bin/sail up -d

# Generate application key
./vendor/bin/sail artisan key:generate

# Run database migrations
./vendor/bin/sail artisan migrate

# Build frontend assets
./vendor/bin/sail npm run dev

# Visit the application
open http://localhost
```

### Local Development

```bash
# Install dependencies
composer install
npm install

# Set up environment
cp .env.example .env
php artisan key:generate

# Configure database in .env file
# Run migrations
php artisan migrate

# Build assets and start servers
npm run dev
php artisan serve
```

## Testing

This project includes a comprehensive test suite covering all CRUD operations, validation scenarios, and edge cases.

```bash
# Run all tests
./vendor/bin/sail test

# Run specific test class
./vendor/bin/sail test tests/Feature/CheckInTest.php

# Run with coverage (requires Xdebug)
./vendor/bin/sail test --coverage
```

### Test Coverage

- ✅ **CRUD Operations**: All create, read, update, delete operations
- ✅ **Validation Testing**: Required fields, data types, constraints
- ✅ **Error Handling**: 404 responses, validation failures
- ✅ **API Consistency**: JSON responses, proper status codes
- ✅ **Database Integrity**: Data persistence and cleanup

## 🏗 Architecture

### Backend Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   └── CheckInController.php    # RESTful API controller
│   └── Resources/
│       └── CheckInResource.php      # JSON API resources
├── Models/
│   └── CheckIn.php                  # Eloquent model
└── ...

database/
├── factories/
│   └── CheckInFactory.php           # Test data generation
├── migrations/
│   └── create_checkins_table.php    # Database schema
└── seeders/
```

### Frontend Structure

```
resources/
├── js/
│   ├── app.js                       # Application entry point
│   ├── bootstrap.js                 # Axios configuration & CSRF
│   ├── checkins.js                  # API interaction module
│   └── index.js                     # DOM manipulation & events
├── views/
│   └── index.blade.php              # Main application view
└── css/
    └── app.css                      # Tailwind CSS compilation
```

## Security Features

- **CSRF Protection**: All forms protected with Laravel's CSRF tokens
- **Input Validation**: Server-side validation for all user inputs
- **SQL Injection Protection**: Eloquent ORM with parameter binding
- **XSS Prevention**: Blade template escaping and sanitization

## API Documentation

### Endpoints

| Method | Endpoint | Description | Response |
|--------|----------|-------------|----------|
| GET | `/check-ins` | List all check-ins (paginated) | JSON with data array |
| POST | `/check-ins` | Create new check-in | JSON with created record |
| GET | `/check-ins/{id}` | Get specific check-in | JSON with single record |
| PUT | `/check-ins/{id}` | Update check-in | JSON with updated record |
| DELETE | `/check-ins/{id}` | Delete check-in | JSON with success message |

### Request/Response Examples

#### Create Check-In
```bash
POST /check-ins
Content-Type: application/json

{
  "description": "Coffee shop visit",
  "lat": 40.7128,
  "lng": -74.0060,
  "notes": "Great wifi and atmosphere"
}
```

#### Response
```json
{
  "data": {
    "id": 1,
    "description": "Coffee shop visit",
    "lat": 40.7128,
    "lng": -74.0060,
    "notes": "Great wifi and atmosphere",
    "created_at": "2025-07-02T10:30:00.000000Z",
    "updated_at": "2025-07-02T10:30:00.000000Z"
  }
}
```

## Development Practices Demonstrated

### Code Quality
- **PSR Standards**: Following PHP coding standards
- **SOLID Principles**: Single responsibility, dependency injection
- **DRY Principle**: Reusable components and functions
- **Clean Code**: Meaningful names, small functions, clear logic

### Testing Strategy
- **Feature Tests**: End-to-end API testing
- **Test-Driven Development**: Tests written alongside features
- **Edge Case Coverage**: Invalid data, missing resources
- **Fast Feedback**: SQLite in-memory database for speed

### Modern JavaScript
- **ES6 Modules**: Proper import/export structure
- **Async/Await**: Modern asynchronous programming
- **Event-Driven**: Proper event listeners vs inline handlers
- **Error Handling**: Comprehensive try/catch blocks

## Performance Considerations

- **Database Indexing**: Primary keys and foreign key constraints
- **Pagination**: Server-side pagination for large datasets
- **Asset Optimization**: Vite build process with minification
- **Caching Ready**: Laravel cache configuration prepared

## Future Enhancements

- **User Authentication**: Multi-user support with role-based access
- **Real-time Updates**: WebSocket sintegration for live updates
- **Mobile App**: API ready for mobile application integration
- **Advanced Search**: Filtering and search functionality
- **File Uploads**: Image attachments for check-ins
- **Geofencing**: Location-based notifications and triggers

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Write tests for your changes
4. Ensure all tests pass (`./vendor/bin/sail test`)
5. Commit your changes (`git commit -m 'Add amazing feature'`)
6. Push to the branch (`git push origin feature/amazing-feature`)
7. Open a Pull Request

## License

This project is open-sourced software licensed under the [MIT license](LICENSE).

## Contact

**Chad Hunter**  
chunter01@gmail.com  
[LinkedIn](https://www.linkedin.com/in/chunter01)  
---

*This project demonstrates modern full-stack development practices and is designed to showcase professional coding standards, testing methodologies, and security-conscious development.*

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
