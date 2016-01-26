# Jane Open Api

[![Latest Version](https://img.shields.io/github/release/jolicode/jane-openapi.svg?style=flat-square)](https://github.com/jolicode/jane-openapi/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/jolicode/jane-openapi.svg?style=flat-square)](https://travis-ci.org/jolicode/jane-openapi)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/jolicode/jane-openapi.svg?style=flat-square)](https://scrutinizer-ci.com/g/jolicode/jane-openapi)
[![Quality Score](https://img.shields.io/scrutinizer/g/jolicode/jane-openapi.svg?style=flat-square)](https://scrutinizer-ci.com/g/jolicode/jane-openapi)
[![Total Downloads](https://img.shields.io/packagist/dt/jane/openapi.svg?style=flat-square)](https://packagist.org/packages/jane/openapi)

Generate a PHP Client API (PSR7 compatible) given a [OpenApi (Swagger) specification](https://github.com/OAI/OpenAPI-Specification/blob/master/versions/2.0.md).

## Disclaimer

The generated code may contain bug or incorrect behavior, use it as a base for your application but you should never trust it as is.

## Usage

```
# jane-openapi [schema-path] [namespace] [destination]
php vendor/bin/jane-openapi generate Name\\Space src/Name/Space
```

This will generate, in the `src/Name/Space`, a Resource, a Model and a Normalizer directory:

 * Resource directory will contain all differents resources of the API with their endpoints;
 * Model directory will contain all Model used in the API;
 * Normalizer directory will contain a normalizer service class for each of the model class generated.

## Example

The [Docker PHP](https://github.com/stage1/docker-php) library has been built on this, you can see there a complete example of using this library.

## Installation

Use composer for installation

```
composer require jane/openapi
```

## Recommended workflow

Here is a recommended workflow when dealing with the generated code:

 1. Start from a clean revision on your project (no modified files);
 2. Update your OpenApi (Swagger) Schema file (edit or download new version);
 3. Generate the new code;
 4. Check the generated code with a diff tool: `git diff` for example;
 5. If all is well commit modifications.

An optional and recommanded practice is to separate the generated code in a specific directory
like creating a `generated` directory in your project and using jane inside. This allows other developers
to be aware that this part of the project is generated and must not be updated manually.

## Internal

Here is a quick presentation on how this library transforms a Json Schema file into models and normalizers:

 1. First step is to read and parse the OpenApi (Swagger) Schema file;
 2. Second step is to guess api calls, classes and their associated properties and types;
 3. Once all things are guessed, they are transformed into an AST (by using the [PHP-Parser library from nikic](https://github.com/nikic/PHP-Parser));
 4. Then the AST is written into PHP files.
 5. Optionally, if php-cs-fixer is present, it is used to format the generated code

## Credits

* [All contributors](https://github.com/jolicode/jane-openapi/graphs/contributors)

## License

View the [LICENSE](LICENSE) file attach to this project.
