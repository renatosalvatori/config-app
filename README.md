Config App
=======================

Introduction
------------
This is a simple application using Zend Framework 2, Doctrine 2 and ExtJS 4.2. This application
allows the user to retrieve configuration settings from a MySQL table and also save them.

When finished, the aim is to have an example of how to create a very simple application that is
fully covered by unit tests, both client side and server side.

Installation (Windows)
----------------------
Ensure that you have both git and composer installed. Ensure that git is in your PATH environment
variable (check by typing 'git' into the command line and see if it works!).

Copy or clone this repository into a directory accessible by your web server. Open a command line
window and navigate to the directory. Run the following command:

```
composer install
```

All dependencies will now be installed.

The next step is to setup the database. Do this by opening a command window and navigating to
the following directory:

```
path/to/my/app/vendor/bin/
```

Then execute the following command:

```
doctrine-module orm:schema-tool:create
```

