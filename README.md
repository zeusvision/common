# Common classes used in any Zeus project

[![Latest Version on Packagist](https://img.shields.io/packagist/v/zeus/common.svg?style=flat-square)](https://packagist.org/packages/zeus/common)
[![Build Status](https://img.shields.io/travis/zeus/common/master.svg?style=flat-square)](https://travis-ci.org/zeus/common)
[![Quality Score](https://img.shields.io/scrutinizer/g/zeus/common.svg?style=flat-square)](https://scrutinizer-ci.com/g/zeus/common)
[![Total Downloads](https://img.shields.io/packagist/dt/zeus/common.svg?style=flat-square)](https://packagist.org/packages/zeus/common)

Conjunto de clases o servicios comunes para todos los proyectos de Zeus

## Installation

You can install the package via composer:

```bash
composer require zeus/common
```

## Package list
- BaseRequest
- ZeusTestCase

## Usage
### ZeusTest
El fichero `ZeusTestCase.php` define diversas funciones para testear la API. Además, por defecto hace rollback tras cada test, por lo que la base de datos 
siempre queda en un estado "limpio".

Esta clase servirá como base para nuestros test, por lo que todos los test de tipo `Feature` la extenderán.

Incluye métodos para CRUD:

Index
```php
$route = route('users.index');

$this->get($route);
```

Show
```php
$user = factory(User::class)->create();
$route = route('users.index', $user);

$this->get($route);
```

Create
```php
$route = route('users.store');
$data = ['name' => 'my name'];

$this->post($route, $data);
```

Update
```php
$user = factory(User::class)->create();
$route = route('user.update', $user);
$data = ['name' => 'my name'];

$this->put($route, $data);
```

Update
```php
$user = factory(User::class)->create();
$route = route('user.update', $user);
$data = ['name' => 'my name'];

$this->patch($route, $data);
```

Delete
```php
$user = factory(User::class)->create();
$route = route('user.destroy', $user);

$this->delete($route);
```

También permite actuar como un usuario logueado
```php
$user = factory(User::class)->create();

$this->signIn($user); // Loguea el usuario creado

$route = route('user.update', $user);
$data = ['name' => 'my name'];

$response = $this->put($route, $data);
$response->assertSuccessful();
```

Obtener el contenido de la última respuesta
```php
$this->dumpResponse();
```

Obtener el contenido de una respuesta en concreto
```php
$this->dumpResponse($response);
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email j.morell@mail.zeus.vision instead of using the issue tracker.

## Credits

- [Joan Morell](https://github.com/zeus)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
