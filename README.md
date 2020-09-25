# Bare Framework.

[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

Simple, lightweight modern PHP without framework. I just put some open-source packages together to make a minimal micro-framework. \
I accepted challenge from <https://kevinsmith.io/modern-php-without-a-framework>


## Documentation

Will document later. You'll have to know about PSR (PHP Standards Recommendations).


## Known Issues

Because of using Laravel Eloquent ORM, project was mixed with some of Laravel's Facade classes. But, they won't work.\
I mean there's a Hash class, but if you try `Hash::make("Hello")`, then, it'll throw Exception about Facade root. Sorry for such inconvenience.


## Installation

Currently, under development. Simple `git clone` will help you!

```shell script
git clone https://github.com/heinthanth/bare
cd bare
composer install
cp .env.example .env
php -S localhost:8000 -t public
```

This will make this repo alive at <http://localhost:8000>


## Core Features

No feature out of the box! - with just router, view engine and other stuffs.


## Credits

* PSR-7 Http Message : <https://github.com/laminas/laminas-diactoros>
* PSR-7 based Router : <https://github.com/thephpleague/route>
* View Engine : <https://github.com/thephpleague/plates>
* SAPI emitter : <https://github.com/laminas/laminas-httphandlerrunner>
* DI container : <https://github.com/thephpleague/container>
* env Parser : <https://github.com/vlucas/phpdotenv>
* DataBase ORM : <https://github.com/illuminate/database>
* Logger : <https://github.com/Seldaek/monolog>


## License

The Bare Framework is licensed under the MIT license. See [License](LICENSE) for more information.
