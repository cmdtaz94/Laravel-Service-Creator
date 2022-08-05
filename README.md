
[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/support-ukraine.svg?t=1" />](https://supportukrainenow.org)

# A package that help you to create easily business services for your application

[![Latest Version on Packagist](https://img.shields.io/packagist/v/nazonhou/laravel-service-creator.svg?style=flat-square)](https://packagist.org/packages/nazonhou/laravel-service-creator)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/nazonhou/laravel-service-creator/run-tests?label=tests)](https://github.com/nazonhou/laravel-service-creator/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/nazonhou/laravel-service-creator/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/nazonhou/laravel-service-creator/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/nazonhou/laravel-service-creator.svg?style=flat-square)](https://packagist.org/packages/nazonhou/laravel-service-creator)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/Laravel-Service-Creator.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/Laravel-Service-Creator)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require nazonhou/laravel-service-creator
```

## Usage

You can create a service file with his contract and service provider by running:

```bash
php artisan make:service <Name>
```

This command will create :
- A NameService.php file in the app/Services directory with is the service contract (an interface)
- A NameServiceImplementation.php file in the app/Services directory which implement NameService 
- A NameServiceProvider.php file in app/Providers directory which is a service provider which contains the binding from the NameService to the NameServiceImplementation in the service container

You can only generate a service file by running.

```bash
php artisan make:service <Name> --no-contract
```

You can also generate a service file with his contract without their service provider file by running.

```bash
php artisan make:service <Name> --no-provider
```


## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/cmdtaz94/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [AZONHOU Nelson](https://github.com/cmdtaz94)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
