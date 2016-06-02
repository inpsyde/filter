# Inpsyde Filters

This package provides a collection of filters for WordPress. 

## Contents

* [Installation](#installation)
* [Usage](#usage)
    * [Changing Options](#changing-options)
    * [Available Filters](#available-filters)
* [Create your own Filter](#create-your-own-filter)
* [Factory](#factory)
* [Other Notes](#other-notes)
    * [Crafted by Inpsyde](#crafted-by-inpsyde)
    * [Bugs, technical hints or contribute](#bugs-technical-hints-or-contribute)
    * [License](#license)
    * [Changelog](#changelog)

## Installation

```cli
$ composer require --dev [--prefer-dist] inpsyde/filter 
```

## Usage
Each Filters filters a value with a given configuration. 

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
Following basic Filters are available:

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

```php
namespace My\Own\Filter;

use Inpsyde\Filter\AbstractFilter;

class YourFilter extends AbstractFilter {

    /**
     * @var array
     */
    protected $options = [
        'key' => 'value'
    ];

    public function filter( $value ) {
       // do something
       return $value;
    }

}

$filter = new My\Own\Filter\YourFilter();
$value = $filter->filter( 'my value' );
```

## Factory

The library comes with an `FilterFactory` which allows you to create instances of new Filters.

```php
$factory = new \Inpsyde\Filter\FilterFactory();
$filter = $factory->create( 'DateTime' ); // returns instance of \Inpsyde\Filter\DateTime
```

The factory is also able to create instances of external classe, if they implement the `\Inpsyde\Filter\FilterInterface`:

```php
$factory = new \Inpsyde\Filter\FilterFactory();
$filter = $factory->create( My\Own\Filter\YourFilter::class ); // Creates an instance of your own filter.
```

## Other Notes

### Crafted by Inpsyde
    
The team at [Inpsyde](http://www.inpsyde.com) is engineering the Web since 2006.

### Bugs, technical hints or contribute

Please give us feedback, contribute and file technical bugs on [GitHub Repo](https://github.com/inpsyde/Inpsyde-Filter).

### License

Good news, this plugin is free for everyone! Since it's released under the [MIT](https://github.com/inpsyde/Inpsyde-Filter/blob/master/LICENSE), you can use it free of charge on your personal or commercial blog.

### Changelog

See [commits](https://github.com/inpsyde/Inpsyde-Filter/commits/master) or read [short version](https://github.com/inpsyde/Inpsyde-Filter/blob/master/CHANGELOG.md).