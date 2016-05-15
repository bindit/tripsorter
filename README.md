TRIP SORTER
============================

Installation
------------
Install the TRIP SORTER using [composer](http://getcomposer.org/).

```
$ composer.phar install
```

USAGE
------------
In main TRIP SORTER directory run index.php file with argument in JSON format.
Argument MUST be build with numbers of existing boarding cards.

EXAMPLE:

```
php index.php '["BC44212", "cbZ322", "BC33212", "BC33412", "zzz213"]'
```

PHPUNIT TESTS
------------
In order to execute PHPUnit tests run:

```
./vendor/phpunit/phpunit/phpunit -c phpunit.xml
```

DATA STORAGE
------------
All data are stored using "in memory" storage located in

```
src/App/Data/Persistence/InMemory.php
```

Edit this file in order to add/delete items.