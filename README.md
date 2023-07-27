<div align="center">
    <p>
        <h1>Git Ribbon<br/>A Laravel package that provides git status information</h1>
    </p>
</div>

<p align="center">
    <a href="https://github.com/Jithran/GitRibbon">Documentation</a> |
    <a href="#features">Features</a> |
    <a href="#installation">Installation</a> |
    <a href="#license">License</a>
</p>

<p align="center">
<a href="https://packagist.org/packages/jithran/git-ribbon"><img src="https://img.shields.io/packagist/v/jithran/git-ribbon.svg?style=flat-square" alt="Packagist"></a>
<img src="https://img.shields.io/badge/License-MIT-brightgreen.svg?style=flat-square" alt="License">
<a href="https://packagist.org/packages/jithran/git-ribbon"><img src="https://img.shields.io/packagist/php-v/jithran/git-ribbon.svg?style=flat-square" alt="PHP from Packagist"></a>
<img src="https://img.shields.io/badge/Laravel-10.x-brightgreen.svg?style=flat-square" alt="Laravel Version">
</p>

Git Ribbon is a Laravel package that creates a ribbon on the top of the page which gives information about the current status of the git work directory with a tooltip with project information. It helps developers to quickly understand the current git status without leaving the application.

## Features

- Displays the current git status in a ribbon
- Provides detailed project information in a tooltip
- Easy to install and use

## Requirements

- Laravel 10.x
- PHP 8.x

## Installation

To install the package via composer, Run:

```bash
composer require jithran/git-ribbon
```

The package will automatically register itself.

You can publish the config file with:

```bash 
php artisan vendor:publish --provider="Jithran\GitRibbon\GitRibbonServiceProvider" --tag="config"
``` 

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.