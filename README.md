# PHP String Formatter

The `php-string-formatter` package provides a simple and efficient way to generate formatted strings by replacing placeholders (`#`, `?`, `*`, `%`) with random characters, numbers, or a mix of both. It's perfect for creating test data, unique codes, or flexible string patterns.

---

## Features

- Replace `#` with random digits (0-9).
- Replace `%` with random digits (1-9).
- Replace `?` with random lowercase letters (a-z).
- Replace `*` with random digits or letters.
- Easy integration with PHP projects.

---

## Installation

Install the package via Composer:

```bash  
composer require cndrsdrmn/php-string-formatter  
```  

---

## Usage

### Basic Wildcard Replacement

```php  
use Cndrsdrmn\PhpStringFormatter\StringFormatter;

// Replace '#' with random digits (0-9)
echo StringFormatter::numerify('Order-###');  
// Output: Order-123  

// Replace '%' with random digits (1-9)
echo StringFormatter::numerify('Code-%-%-%');  
// Output: Code-3-7-8  

// Replace '?' with random lowercase letters (a-z)
echo StringFormatter::lexify('User-???');  
// Output: User-abc  

// Replace '*' with random digits or letters
echo StringFormatter::bothify('Key-***');  
// Output: Key-a3b  
```  

### Advanced Replacement

You can mix and match placeholders in a single string:

```php  
echo StringFormatter::bothify('Code-#?%-*?#');  
// Output: Code-3a9-b1c3  
```  

---

## Supported Placeholders

| Placeholder | Replacement         | Example Input | Example Output |  
|-------------|---------------------|---------------|----------------|  
| `#`         | Random digit (0-9)  | `###`         | `123`          |  
| `%`         | Random digit (1-9)  | `%%%`         | `456`          |  
| `?`         | Random letter (a-z) | `???`         | `abc`          |  
| `*`         | Random digit or letter | `***`     | `a1b`          |  

---

## Methods

### `numerify(string $string): string`
Replaces all `#` with random digits (0-9) and `%` with random digits (1-9).

### `lexify(string $string): string`
Replaces all `?` with random lowercase letters (a-z).

### `bothify(string $string): string`
Replaces all `*` with random digits (0-9) or letters (a-z).

---

## Testing

This package can be tested with PHPUnit. To run tests:

```bash  
composer test  
```  

---

## Contributing

Contributions are welcome! Feel free to fork the repository, submit pull requests, or open issues for suggestions and bug reports.

---

## License

This package is open-source software licensed under the [MIT license](LICENSE).
