# Number Classification API

A REST API made with PHP Laravel that analyzes numbers and returns their mathematical properties along with interesting facts.

## Features

- Determines if a number is prime
- Checks if a number is perfect
- Identifies Armstrong numbers
- Calculates the sum of digits
- Returns interesting mathematical facts about numbers
- Handles CORS for cross-origin requests
- Returns responses in JSON format

## API Documentation

### Base URL
`https://hng.fasttrack-express.com/api/classify-number?number={number}`

### Endpoint
```
GET /classify-number?number={number}
```

## Local Development Setup

1. **Clone the repository**
```bash
git clone https://github.com/Noah-V/NumberClassification.git
cd NumberClassification
```

2. **Install dependencies**
```bash
composer install
```

3. **Set up environment file**
```bash
copy .env.example .env  # For Windows
```

4. **Generate application key**
```bash
php artisan key:generate
```

5. **Start the development server**
```bash
php artisan serve
```

The API will now be available at `http://localhost:8000/api/classify-number`

## Example Usage

Using Postman:
```bash
GET http://localhost:8000/api/classify-number?number=371
```

## Built With
- [Laravel](https://laravel.com/) - The PHP framework used
- Check out more about our PHP developers at [HNG PHP Developers](https://hng.tech/hire/php-developers)

## Response Time
- API response time is optimized to be less than 500ms

## Author
### Noah Vikoo
