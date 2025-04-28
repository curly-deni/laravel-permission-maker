# Laravel Permission Maker

[![Latest Version on Packagist](https://img.shields.io/packagist/v/curly-deni/laravel-permission-maker.svg?style=flat-square)](https://packagist.org/packages/curly-deni/laravel-permission-maker)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/curly-deni/laravel-permission-maker/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/curly-deni/laravel-permission-maker/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/curly-deni/laravel-permission-maker.svg?style=flat-square)](https://packagist.org/packages/curly-deni/laravel-permission-maker)

**Laravel Permission Maker** is a simple extension for [spatie/laravel-permission](https://github.com/spatie/laravel-permission) that automates the creation of permission migrations.  
Quickly generate full CRUD permission sets or individual permissions using Artisan commands.

## Features

- 🔥 Quickly scaffold CRUD permissions for any resource.
- ✍️ Generate a migration for a single permission with one command.
- 📦 Seamlessly integrates with [spatie/laravel-permission](https://github.com/spatie/laravel-permission).
- 🚀 Clean, minimalistic, and developer-friendly.
- 🛠️ Fully customizable stub templates for advanced use cases.

## Installation

Install the package via Composer:

```bash
composer require curly-deni/laravel-permission-maker
```

Publish the configuration file:

```bash
php artisan vendor:publish --tag="permission-maker-config"
```

Ensure that the Spatie permission migrations are published and migrated:

```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="permission-migrations"
php artisan migrate
```

## Configuration

The configuration file allows you to control which CRUD permissions are automatically generated when using the `permission:commit-crud` command.

Default configuration (`config/permission-maker.php`):

```php
<?php

return [
    'create' => [
        'generate' => true,
    ],
    'read' => [
        'generate' => false,
    ],
    'update' => [
        'generate' => true,
    ],
    'delete' => [
        'generate' => true,
    ],
];
```

### Options

- `create.generate`:  
  Should the `create` permission be generated?  
  **Default:** `true`

- `read.generate`:  
  Should the `read` permission be generated?  
  **Default:** `false`

- `update.generate`:  
  Should the `update` permission be generated?  
  **Default:** `true`

- `delete.generate`:  
  Should the `delete` permission be generated?  
  **Default:** `true`

You can adjust these options according to your needs by modifying the published configuration file.

---

## Usage

| Command                                | Description                                   | Options                              |
|----------------------------------------|-----------------------------------------------|--------------------------------------|
| `permission:commit-crud {resource}`    | Create a migration for CRUD permissions       | `--private`, `--own`                 |
| `permission:commit {name}`             | Create a migration for a single permission    | None                                 |

---

### 1. `permission:commit-crud`

Generates a set of standard CRUD permissions (`create`, `update`, `delete`, `read`) for a specified resource.

```bash
php artisan permission:commit-crud {resource} {--private} {--own}
```

| Argument / Option | Description                                           |
|-------------------|-------------------------------------------------------|
| `resource`        | The name of the resource (preferably in `snake_case`). |
| `--private`       | Add a `private_read` permission.                      |
| `--own`           | Add "own" permissions: `own_read`, `own_update`, `own_delete`. |

**Example:**

```bash
php artisan permission:commit-crud blog_post --private --own
```

Generated permissions:

```
blog_post:create
blog_post:update
blog_post:delete
blog_post:read
blog_post:private_read
blog_post:own_read
blog_post:own_update
blog_post:own_delete
```

---

### 2. `permission:commit`

Generates a migration for a single, custom permission.

```bash
php artisan permission:commit {name}
```

| Argument | Description                        |
|----------|------------------------------------|
| `name`   | The name of the permission (e.g., `post:publish`). |

**Example:**

```bash
php artisan permission:commit post:publish
```

Generated permission:

```
post:publish
```

---

## Credits

- [Danila Mikhalev](https://github.com/curly-deni)
- [All Contributors](../../contributors)

## License

The MIT License (MIT).  
Please see [License File](LICENSE.md) for more information.
