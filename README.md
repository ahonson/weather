[![Latest Stable Version](https://poser.pugx.org/artes/weather/v)](//packagist.org/packages/artes/weather)
[![Total Downloads](https://poser.pugx.org/artes/weather/downloads)](//packagist.org/packages/artes/weather)
<!-- [![Latest Stable Version](https://poser.pugx.org/artes/weather/v/stable)](https://packagist.org/packages/artes/weather) -->
[![Build Status](https://travis-ci.com/ahonson/weather.svg?branch=main)](https://travis-ci.com/ahonson/weather)
[![Gitter](https://badges.gitter.im/ahonson/weather.svg)](https://gitter.im/ahonson/weather?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge)
[![Maintainability](https://api.codeclimate.com/v1/badges/37e71c6e5603861da840/maintainability)](https://codeclimate.com/github/ahonson/weather/maintainability)
[![CircleCI](https://circleci.com/gh/ahonson/weather.svg?style=svg)](https://circleci.com/gh/ahonson/weather)


[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ahonson/weather/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/ahonson/weather/?branch=main)
[![Code Coverage](https://scrutinizer-ci.com/g/ahonson/weather/badges/coverage.png?b=main)](https://scrutinizer-ci.com/g/ahonson/weather/?branch=main)
[![Build Status](https://scrutinizer-ci.com/g/ahonson/weather/badges/build.png?b=main)](https://scrutinizer-ci.com/g/ahonson/weather/build-status/main)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/ahonson/weather/badges/code-intelligence.svg?b=main)](https://scrutinizer-ci.com/code-intelligence)


Anax module for weather services and IP validation
==================================================

This module has been created for the course *Webbaserade ramverk och designmönster* at Blekinge Tekniska Högskola, fall 2020. The module is meant to be incorporated with the [Anax](https://github.com/canax/anax-ramverk1-me) framework.

## Usage

### Step 1: Install the module using composer.

`composer require artes/weather`

### Step 2: Integrate the module into your Anax base by copying the necessary files

`# Go to the root of your Anax base repo and run these two commands`

`rsync -av vendor/artes/weather/config ./`

`rsync -av vendor/artes/weather/view ./`

Run even these commands if you want to execute the unit tests of the module with `make test` from the root of you Anax base.

`rsync -av vendor/artes/weather/src ./`

`rsync -av vendor/artes/weather/test ./`

### Step 3: Add your API-keys

The module makes use of [ipstack](https://ipstack.com/) and [openweathermap](https://openweathermap.org/) to provide the user with information about a given IP-address or about a valid pair of geographical coordinates.

Create an account on both sites and save your API-keys in `config/api/apikeys.php` according to the instructions in the comments. If you miss this step certain classes may not work as expected.

### Step 4: Protect your API-keys

Update your `.gitignore` with the following line in your Anax base.

`/config/api`

### Step 5: Update your navbar

Add *IP* and *Weather* to your navbar via `config/navbar/header.php` and via `config/navbar/responsive.php`

You will need to insert the following lines of code into the `items`-key in the above files.

```
[
    "text" => "IP",
    "url" => "ip/init",
    "title" => "IP validator",
],
[
    "text" => "Väder",
    "url" => "weather",
    "title" => "Väder API",
],
```
