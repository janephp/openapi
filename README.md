# Jane Swagger

[![Latest Version](https://img.shields.io/github/release/jolicode/jane-swagger.svg?style=flat-square)](https://github.com/jolicode/jane-swagger/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/jolicode/jane-swagger.svg?style=flat-square)](https://travis-ci.org/jolicode/jane-swagger)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/jolicode/jane-swagger.svg?style=flat-square)](https://scrutinizer-ci.com/g/jolicode/jane-swagger)
[![Quality Score](https://img.shields.io/scrutinizer/g/jolicode/jane-swagger.svg?style=flat-square)](https://scrutinizer-ci.com/g/jolicode/jane-swagger)
[![Total Downloads](https://img.shields.io/packagist/dt/jane/swagger.svg?style=flat-square)](https://packagist.org/packages/jane/swagger)

Generate a PHP Client API (PSR7 compatible) given a [Swagger specification](https://github.com/OAI/OpenAPI-Specification/blob/master/versions/2.0.md).

## Disclaimer

The generated code may contain bug or incorrect behavior, use it as a base for your application but you should never trust it as is.

## Usage

// TODO

## Example

The [Docker PHP](https://github.com/stage1/docker-php) library has been built on this, you can see there a complete example of using this library.

## Installation

Use composer for installation

```
composer require jane/swagger
```

## Recommended workflow

Here is a recommended workflow when dealing with the generated code:

 1. Start from a clean revision on your project (no modified files);
 2. Update your Swagger file (edit or download new version);
 3. Generate the new code;
 4. Check the generated code with a diff tool: `git diff` for example;
 5. If all is well commit modifications.

An optional and recommanded practice is to separate the generated code in a specific directory
like creating a `generated` directory in your project and using jane inside. This allows other developers
to be aware that this part of the project is generated and must not be updated manually.

## Internal

Here is a quick presentation on how this library transforms a Json Schema file into models and normalizers:

 1. First step is to read and parse the Swagger Schema file;
 2. Second step is to guess classes and their associated properties and types;
 3. Once all things are guessed, classes and their properties are transformed into an AST (by using the [PHP-Parser library from nikic](https://github.com/nikic/PHP-Parser));
 4. Then the AST is written into PHP files.

## Credits

* [All contributors](https://github.com/jolicode/jane-swagger/graphs/contributors)

## License

View the [LICENSE](LICENSE) file attach to this project.
