# Inpsyde Filters [![Latest Stable Version](https://poser.pugx.org/inpsyde/filter/v/stable)](https://packagist.org/packages/inpsyde/filter) [![Project Status](http://opensource.box.com/badges/active.svg)](http://opensource.box.com/badges) [![Build Status](https://travis-ci.org/inpsyde/inpsyde-filter.svg?branch=master)](http://travis-ci.org/inpsyde/MetaboxOrchestra) [![License](https://poser.pugx.org/inpsyde/filter/license)](https://packagist.org/packages/inpsyde/filter)

This package provides a collection of filters for WordPress. 

## Contents

* [Installation](#installation)
* [Usage](#usage)
    * [Changing Options](#changing-options)
    * [Available Filters](#available-filters)
* [Create your own Filter](#create-your-own-filter)
* [Factory](#factory)
* [Other Notes](#other-notes)
    * [Bugs, technical hints or contribute](#bugs-technical-hints-or-contribute)
    * [Copyright and License](#copyright-and-license)
    * [Changelog](#changelog)

## Installation

```cli
$ composer require --dev [--prefer-dist] inpsyde/filter 
```

## Usage
Each filter filters a value with a given configuration. 

```php
$filter = new Inpsyde\Filter\DateTime();
$value = $filter->filter( '21.06.1987' ); // converts to: 1987-06-21
```

### Changing Options

Some filters are having additional options which can be overwritten in constructor.

```php
$options = [
    'format' => 'd.m.Y'
];
$filter = new Inpsyde\Filter\DateTime( $options );
$value = $filter->filter( '1987-06-21' ); // 21.06.1987
```

### Available Filters
Following basic filters are available:

* `ArrayValue`
* `DateTime`

In addition, there are filters which are wrappers for well known WordPress-functions:

* `WordPress\Absint`
* `WordPress\AutoP`
* `WordPress\EscHtml`
* `WordPress\EscUrlRaw`
* `WordPress\NormalizeWhitespace`
* `WordPress\RemoveAccents`
* `WordPress\SanitizeFileName`
* `WordPress\SanitizeKey`
* `WordPress\SanitizePostField`
* `WordPress\SanitizeTextField`
* `WordPress\SanitizeTitle`
* `WordPress\SanitizeTitleWithDashes`
* `WordPress\SanitizeUser`
* `WordPress\SpecialChars`
* `WordPress\StripTags`
* `WordPress\Unslash`

## Create your own Filter

### File `My\Own\Filter\YourFilter.php`

```php
namespace My\Own\Filter;

use Inpsyde\Filter\AbstractFilter;

class YourFilter extends AbstractFilter {

    /**
     * Optional: set some options, which can be overwritten by constructor.
      
     * @var array
     */
    protected $options = [
        'key' => 'value'
    ];

    /**
     * {@inheritdoc}
     */
    public function filter( $value ) {
       // do something
       return $value;
    }

}
```

### Usage

```php
// Optional: set "new value" to Filter.
$options = [ 'key' => 'new value' ];

$filter = new YourFilter( $options );
$value = $filter->filter( 'my value' );
```

## Factory

The library comes with a `FilterFactory` which allows you to create instances of new filters.

```php
$factory = new \Inpsyde\Filter\FilterFactory();
$filter = $factory->create( 'DateTime' ); // returns instance of \Inpsyde\Filter\DateTime
```

The factory is also able to create instances of external classes, if they implement the `\Inpsyde\Filter\FilterInterface`:

```php
$factory = new \Inpsyde\Filter\FilterFactory();
$filter = $factory->create( My\Own\Filter\YourFilter::class ); // Creates an instance of your own filter.
```

## Other Notes

### Bugs, technical hints or contribute

Please give us feedback, contribute and file technical bugs on [GitHub Repo](https://github.com/inpsyde/Inpsyde-Filter).

### Copyright and License

This package is [free software](https://www.gnu.org/philosophy/free-sw.en.html) distributed under the terms of the GNU General Public License version 2 or (at your option) any later version. For the full license, see [LICENSE](./LICENSE).

### Changelog

See [commits](https://github.com/inpsyde/Inpsyde-Filter/commits/master) or read [short version](https://github.com/inpsyde/Inpsyde-Filter/blob/master/CHANGELOG.md).
