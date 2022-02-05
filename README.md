# PHP wrapper for WL Registry (https://wl-api.mf.gov.pl)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/apsg/mf-wl-api.svg?style=flat-square)](https://packagist.org/packages/apsg/mf-wl-api)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/apsg/mf-wl-api/run-tests?label=tests)](https://github.com/apsg/mf-wl-api/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/apsg/mf-wl-api/Check%20&%20fix%20styling?label=code%20style)](https://github.com/apsg/mf-wl-api/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/apsg/mf-wl-api.svg?style=flat-square)](https://packagist.org/packages/apsg/mf-wl-api)

Wrapper PHP dla API Ministerstwa Finansów rejestru WL (https://wl-api.mf.gov.pl). Rejestr pozwala na sprawdzenie danych
i poprawności m.in. numerów NIP i REGON.

## Installation

You can install the package via composer:

```bash
composer require apsg/mf-wl-api
```

## Usage

```php
$mf = new Apsg\MF();

$response = $mf->searchNip($someNipToFind);

```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Credits

- [Szymon Gackowski](https://github.com/apsg)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
