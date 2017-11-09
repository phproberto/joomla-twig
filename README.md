# Twig integration for Joomla!

[![Build Status](https://travis-ci.org/phproberto/joomla-twig.svg?branch=master)](https://travis-ci.org/phproberto/joomla-twig)

> [Twig 2.0](https://twig.symfony.com/doc/2.x/) && [Twig extensions](http://twig-extensions.readthedocs.io/en/latest/) integration for Joomla!

## Index <a id="index"></a>

* [Description](#description)
* [Installation](#installation)
* [Documentation](#documentation)
* [Requirements](#requirements)
* [Copyright & License](#license)

## Description <a id="description"></a>

After integrating Twig with some projects I found the need to create some kind of standard package that can be used & extended by anbody at any project.  

This Twig integration includes common global variables & functions required when using Twig in Joomla!  

Some highlights:  

* Integrates [Twig 2.0](https://github.com/twigphp/Twig)
* Integrates official [Twig extensions](http://twig-extensions.readthedocs.io/en/latest/)
* Global variables to access active application, active document, session, active user, etc.
* Functions to use JLayout, JProfiler, JRoute, JUri, JLanguage, JHtml, etc.
* Integrated cache.
* Integrated debug mode.
* All the extensions are integrated through plugins so you can extend/replace any plugin you need.
* [SonarCloud](https://sonarcloud.io/dashboard?id=phproberto%3Ajoomla-twig) for Quality Asurance.  

Example usage:  

```php
JLoader::import('twig.library');

// This will render a twig layout in: templates/{ACTIVE_TEMPLATE}/html/view.html.twig
echo Twig::render('@template/view.html.twig');  
```

You can find more examples/usages in the [documentation](./docs/README.md);  

## Installation <a id="installation"></a>

* Ensure that your site meets the requirements
* Download latest version from the [releases section](./releases)
* Install zip file in your site through Extension Manager

## Documentation <a id="documentation"></a>

See [documentation](./docs/README.md) for detailed documentation.

## Requirements <a id="requirements"></a>

* PHP 7.0+ or higher
* Joomla! 3.8.1 or higher

## Copyright & License <a id="license"></a>

This library is licensed under [GNU LESSER GENERAL PUBLIC LICENSE](./LICENSE).  

Copyright (C) 2017 [Roberto Segura López](http://phproberto.com) - All rights reserved.  
