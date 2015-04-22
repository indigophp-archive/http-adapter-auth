# Ivory Http Adapter Authentication plugin

[![Latest Version](https://img.shields.io/github/release/indigophp/http-adapter-auth.svg?style=flat-square)](https://github.com/indigophp/http-adapter-auth/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/indigophp/http-adapter-auth.svg?style=flat-square)](https://travis-ci.org/indigophp/http-adapter-auth)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/indigophp/http-adapter-auth.svg?style=flat-square)](https://scrutinizer-ci.com/g/indigophp/http-adapter-auth)
[![Quality Score](https://img.shields.io/scrutinizer/g/indigophp/http-adapter-auth.svg?style=flat-square)](https://scrutinizer-ci.com/g/indigophp/http-adapter-auth)
[![HHVM Status](https://img.shields.io/hhvm/indigophp/http-adapter-auth.svg?style=flat-square)](http://hhvm.h4cc.de/package/indigophp/http-adapter-auth)
[![Total Downloads](https://img.shields.io/packagist/dt/indigophp/http-adapter-auth.svg?style=flat-square)](https://packagist.org/packages/indigophp/http-adapter-auth)

**Easily authenticate requests in [Ivory Http Adapter](https://github.com/egeloen/ivory-http-adapter).**


## Install

Via Composer

``` bash
$ composer require indigophp/http-adapter-auth
```


## Usage

1. Create your custom authentication implementing `Indigo\HttpAdapter\Authentication` interface (BasicAuth is provided by the package)
2. Wrap your HTTP Adapter of choice into an `Indigo\HttpAdapter\AuthenticatingHttpAdapter`
3. Enjoy!


``` php
use Indigo\HttpAdapter\AuthenticatingHttpAdapter;
use Indigo\HttpAdapter\Authentication\BasicAuth;
use Ivory\HttpAdapter\HttpAdapterFactory;

$httpAdapter = HttpAdapterFactory::guess();
$authentication = new BasicAuth('john.doe', 'secret');

$httpAdapter = new AuthenticatingHttpAdapter($httpAdapter, $authentication);
```


## Testing

``` bash
$ phpspec run
```


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.


## Credits

- [Márk Sági-Kazár](https://github.com/sagikazarmark)
- [All Contributors](https://github.com/indigophp/http-adapter-auth/contributors)


## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
