# Laravel Finer

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rjchauhan/laravel-finer.svg?style=flat-square)](https://packagist.org/packages/rjchauhan/laravel-finer)
[![Total Downloads](https://img.shields.io/packagist/dt/rjchauhan/laravel-finer.svg?style=flat-square)](https://packagist.org/packages/rjchauhan/laravel-finer)

This package introduces set of multi-purpose helper classes that provides a new way of organising the logic of your Laravel applications.

## Installation

You can install the package via composer:

``` bash
$ composer require rjchauhan/laravel-finer
```

## Usage

## Action

Keep your Laravel applications DRY with single action classes.

```php
use Rjchauhan\LaravelFiner\Action\Action;

class DeactivateUser extends Action
{
    protected function canBePerformed()
    {
        return $this->model->is_active;
    }

    protected function perform()
    {
        $this->model->is_active = false;

        $this->model->save();
    }
}
```

#### Usage

```php
class UserActivationController extends Controller
{
    public function deactivate(User $user)
    {
        $user = (new DeactivateUser($user))->execute();

        return UserResource::make($user);
    }
}
```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email [Raviraj Chauhan](rjchauhan8427@gmail.com) instead of using the issue tracker.

## Credits

- [Raviraj Chauhan](https://github.com/rjchauhan)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/rjchauhan/laravel-finer.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/rjchauhan/laravel-finer.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/rjchauhan/laravel-finer/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/rjchauhan/laravel-finer
[link-downloads]: https://packagist.org/packages/rjchauhan/laravel-finer
[link-travis]: https://travis-ci.org/rjchauhan/laravel-finer
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/rjchauhan
[link-contributors]: ../../contributors
