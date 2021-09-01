# laravel-revenuecat

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Simple wrapper to get subscribers, delete subscribers and check subscription status for products.

## Install

Via Composer

```bash
$ composer require Sjerd/laravel-revenuecat
```

Then run:

```bash
$ php artisan vendor:publish
```

to publish the config files.

Add the `REVENUECAT_API_KEY` to your `.env` file.

If you do not run Laravel 5.5 (or higher), then add the service provider in `config/app.php`:
`Sjerd\LaravelRevenuecat\LaravelRevenuecatServiceProvider::class,`

## Usage

```php
use Sjerd\LaravelRevenueCat\RevenueCatApi;

//initiate class
$revenueCatApi = new RevenueCatApi();

//Get subscriber
$subscriber = $revenueCatApi->getSubscriber($userId)

//Check subscription $options is optional if you've already got the subscriber
$isSubscribed = $revenueCatApi->isSubscribed(['userId' => $userId, 'productIdentifier' => 'annual']);

//delete subscriber $userId is optional if you got the subscriber
$deletedUserId = $revenueCatApi->deleteSubscriber($userId);
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

```bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email info@sjerd.nl instead of using the issue tracker.

## Credits

- [Sjoerd de Wit][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/Sjerd/laravel-revenuecat.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/Sjerd/laravel-revenuecat/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/Sjerd/laravel-revenuecat.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/Sjerd/laravel-revenuecat.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/Sjerd/laravel-revenuecat.svg?style=flat-square
[link-packagist]: https://packagist.org/packages/Sjerd/laravel-revenuecat
[link-travis]: https://travis-ci.org/Sjerd/laravel-revenuecat
[link-scrutinizer]: https://scrutinizer-ci.com/g/Sjerd/laravel-revenuecat/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/Sjerd/laravel-revenuecat
[link-downloads]: https://packagist.org/packages/Sjerd/laravel-revenuecat
[link-author]: https://github.com/Sjerd
[link-contributors]: ../../contributors
