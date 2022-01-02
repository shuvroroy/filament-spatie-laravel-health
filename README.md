# Filament Spatie Laravel Health

[![Latest Version on Packagist](https://img.shields.io/packagist/v/shuvroroy/filament-spatie-laravel-health.svg?style=flat-square)](https://packagist.org/packages/shuvroroy/filament-spatie-laravel-health)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/shuvroroy/filament-spatie-laravel-health/run-tests?label=tests)](https://github.com/shuvroroy/filament-spatie-laravel-health/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/shuvroroy/filament-spatie-laravel-health/Check%20&%20fix%20styling?label=code%20style)](https://github.com/shuvroroy/filament-spatie-laravel-health/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/shuvroroy/filament-spatie-laravel-health.svg?style=flat-square)](https://packagist.org/packages/shuvroroy/filament-spatie-laravel-health)

This package provides a Filament page that you can monitor the health of your application by registering checks using the [spatie/laravel-health](https://spatie.be/docs/laravel-health/v1/introduction) package.

![Health Check Results - Filament Demo](https://user-images.githubusercontent.com/21066418/147746698-8a21ab58-1771-4525-9595-0bbcedc6a325.png)

## Installation

You can install the package via composer:

```bash
composer require shuvroroy/filament-spatie-laravel-health
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-spatie-laravel-health"
```

This is the contents of the published config file:

```php
return [

    /*
    |--------------------------------------------------------------------------
    | Page
    |--------------------------------------------------------------------------
    |
    | This is the configuration for the general appearance of the page
    | in admin panel.
    |
    */
    
    'page' => [
        'heading' => null,

        'navigation' => [
            'group' => null,
            'label' => null,
            'sort' => null,
        ],
    ],

];
```

## Usage

This package will automatically register the `HealthCheckResults`. You'll be able to see it when you visit your Filament admin panel.

## Customising the heading

You can customise the heading for the `HealthCheckResults` by publishing the configuration file and updating the `page.heading` value.

## Customising the navigation group

You can customise the navigation group for the `HealthCheckResults` by publishing the configuration file and updating the `page.navigation.group` value.

## Customising the navigation label

You can customise the navigation label for the `HealthCheckResults` by publishing the configuration file and updating the `page.navigation.label` value.

## Customising the navigation sorting

You can customise the navigation sort for the `HealthCheckResults` by publishing the configuration file and updating the `page.navigation.sort` value.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Shuvro Roy](https://github.com/shuvroroy)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
