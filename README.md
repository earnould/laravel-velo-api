# Pul Velo API resources in your Laravel app

[![Latest Version on Packagist](https://img.shields.io/packagist/v/earnould/laravel-velo-api.svg?style=flat-square)](https://packagist.org/packages/earnould/laravel-velo-api)
[![Code coverage](https://scrutinizer-ci.com/g/earnould/laravel-velo-api/badges/coverage.png)](https://scrutinizer-ci.com/g/earnould/laravel-velo-api)
[![Quality Score](https://img.shields.io/scrutinizer/g/earnould/laravel-velo-api.svg?style=flat-square)](https://scrutinizer-ci.com/g/earnould/laravel-velo-api)
[![StyleCI](https://styleci.io/repos/61802818/shield)](https://styleci.io/repos/182159944)
___
### **NOTE**
You will need to request a `client_id` and a `client_secret` at [velo-antwerpen.be](https://www.velo-antwerpen.be) to actually use this package.
___

## Installation

You can install the package via composer:

``` bash
composer require earnould/laravel-velo-api
```

The package will automatically register itself.

You'll need to publish the config file with:
```bash
php artisan vendor:publish --provider="Earnould\LaravelVeloApi\VeloServiceProvider" --tag="config"
```

This allows you to define the client id and secret in your .env file like this:

```
VELO_CLIENT_ID = ''
VELO_CLIENT_SECRET = ''
```

This package allows you to connect to the Velo Antwerp API. For now there are only two sources available `stations` and `stationsStatuses`. The stations resource speaks for itself. The stationsStatuses resource returns the availability of all stations. The API requires a client_id and client_secret to fetch these results.

A quick overview:

You can retrieve all Velo resources using the `Earnould\LaravelVeloApi\Facades\Velo` facade.

Retrieves all Velo stations in Antwerp
```php
Velo::stations();
```
Returns a collection of all stations
```php
Collection {
    0 => {
        +"id": "036"
        +"name": "036- Bourla"
        +"address": "Schuttershofstraat n° 2"
        +"addressNumber": null
        +"zipCode": "2000"
        +"districtCode": null
        +"districtName": null
        +"altitude": null
        +"location": {
            +"lat": "51.2163878210059"
            +"lon": "4.40593043087013"
        }
        +"stationType": "BIKE"
    },
    1 => { ... }
}
```
___

Requests all Velo stations statuses in Antwerp

```php
Velo::stationsStatuses();
```
Returns a collection of all stations statuses

```php
Collection {
    0 => {
        +"id": "001"
        +"status": "OPN"
        +"availability": {
            +"bikes": 22
            +"slots": 10
        }
    },
    1 => { ... }
}
```

**+status**

The status will be `OPN` for open stations and `CLS` for Closed stations.
___
## Documentation

Any bugs? Any suggestions or question? Shoot an [issue on GitHub](https://github.com/earnould/laravel-velo-api/issues) and let's have a look.

If you've found a security issue please mail [contact@evertarnould.be](mailto:contact@evertarnould.be) instead of using the issue tracker.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information about recent changes.

## Testing

``` bash
vendor/bin/phpunit
```

## Security

If you discover any security related issues, please email [contact@evertarnould.be](mailto:contact@evertarnould.be) instead of using the issue tracker.

## Credits

- [Evert Arnould](https://github.com/earnould)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.