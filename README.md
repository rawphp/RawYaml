# RawYaml - A Simple Symfony Yaml Wrapper Class for PHP Applications

[![Build Status](https://travis-ci.org/rawphp/RawYaml.svg?branch=master)](https://travis-ci.org/rawphp/RawYaml) [![Coverage Status](https://coveralls.io/repos/rawphp/RawYaml/badge.png)](https://coveralls.io/r/rawphp/RawYaml)
[![Latest Stable Version](https://poser.pugx.org/rawphp/raw-yaml/v/stable.svg)](https://packagist.org/packages/rawphp/raw-yaml) [![Total Downloads](https://poser.pugx.org/rawphp/raw-yaml/downloads.svg)](https://packagist.org/packages/rawphp/raw-yaml)
[![Latest Unstable Version](https://poser.pugx.org/rawphp/raw-yaml/v/unstable.svg)](https://packagist.org/packages/rawphp/raw-yaml) [![License](https://poser.pugx.org/rawphp/raw-yaml/license.svg)](https://packagist.org/packages/rawphp/raw-yaml)

## Package Features
- Load yaml files into arrays
- Save arrays as yaml files

## Installation

### Composer
RawYaml is available via [Composer/Packagist](https://packagist.org/packages/rawphp/raw-yaml).

Add `"rawphp/raw-yaml": "0.*@dev"` to the require block in your composer.json and then run `composer install`.

```json
{
        "require": {
            "rawphp/raw-yaml": "0.*@dev"
        }
}
```

You can also simply run the following from the command line:

```sh
composer require rawphp/raw-yaml "0.*@dev"
```

### Tarball
Alternatively, just copy the contents of the RawYaml folder into somewhere that's in your PHP `include_path` setting. If you don't speak git or just want a tarball, click the 'zip' button at the top of the page in GitHub.

## Basic Usage

```php
<?php

use RawPHP\RawYaml\Yaml;

// new yaml parser instance
$yaml = new Yaml( );

// load yaml file
$array = $yaml->load( $file );

// save array to yaml
$yaml->save( $array, $file );
```

## License
This package is licensed under the [MIT](https://github.com/rawphp/RawYaml/blob/master/LICENSE). Read LICENSE for information on the software availability and distribution.

## Contributing

Please submit bug reports, suggestions and pull requests to the [GitHub issue tracker](https://github.com/rawphp/RawYaml/issues).

## Versioning
This package uses the [Semantic Versioning](http://semver.org/spec/v2.0.0.html) standard.

## Changelog

#### 21-09-2014
- Tested for PHP 5.3

#### 20-09-2014
- Initial Code Commit
