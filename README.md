# Craft Mix plugin for Craft CMS 3.x

![Screenshot](resources/img/plugin-logo.svg)

## Requirements

This plugin requires Craft CMS 3.x or later.


## Installation

### 1. Install with Composer

From the terminal

```
cd /path/to/project
composer require bryaneschultz/craft-mix
```


### 2. Install through Craft CMS

In the Control Panel, go to `Settings` → `Plugins` → `Craft Mix` → `Install`


## Craft Mix Overview

Lightweight Twig utility function to handle Laravel Mix files for Craft CMS.


## Configuring Craft Mix

Nothing to configure at this time.


## Using Craft Mix

### Basic Usage.

By default, Craft Mix will use the version supplied by Laravel Mix.

```
<link rel="stylesheet" href="{{ mix('css/app.css') }}" />
<script src="{{ mix('js/manifest.js') }}"></script>
<script src="{{ mix('js/vendor.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>
```

If you want to disallow the versioning, pass `false` as a second parameter.
```
<link rel="stylesheet" href="{{ mix('css/app.css', false) }}" />
<script src="{{ mix('js/manifest.js', false) }}"></script>
<script src="{{ mix('js/vendor.js', false) }}"></script>
<script src="{{ mix('js/app.js', false) }}"></script>
```

### Advanced Usage.

If you want twig to handle the html for your asset, pass `true` as a third parameter.

```
{{ mix('css/app.css', true, true) }}
{{ mix('js/manifest.js', true, true) }}
{{ mix('js/vendor.js', true, true) }}
{{ mix('js/app.js', true, true) }}
```

## License
Craft Mix is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT/).

## Craft Mix Roadmap

* [Initial release](https://github.com/bryaneschultz/craft-mix/blob/main/CHANGELOG.md)

Brought to you by [Bryan E. Schultz](https://github.com/bryaneschultz)
