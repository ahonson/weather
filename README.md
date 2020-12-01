Anax module for weather services and IP validation
==================================================

This module has been created for the course *Webbaserade ramverk och designmönster* at Blekinge Tekniska Högskola, fall 2020. The module is meant to be incorporated with the [Anax](https://github.com/canax/anax-ramverk1-me) framework.

## Usage

### Step 1: install the module using composer.

`composer require arte/weather`

### Step 2: integrate the module into your Anax base by copying the necessary files

`# Go to the root of your Anax base repo
rsync -av vendor/arte/weather/config ./`

### Step 3: Add your API-keys

The module makes use of [ipstack](https://ipstack.com/) and [openweathermap](https://openweathermap.org/) to provide the user with information about a given IP-address or about a valid pair of geographical coordinates.

Create an account on both sites and save your API-keys in `config/api/apikeys.php` according to the instructions in the comments.

### Step 4: Protect your API-keys

Update your `.gitignore` with the following line in your Anax base.

`/config/api`
