# PHP test

## 1. Installation

  - create an empty database named "phptest" on your MySQL server
  - import the dbdump.sql in the "phptest" database
  - put your MySQL server credentials in the constructor of DB class
  - you can test the demo script in your shell: "php index.php"

## 2. Expectations

This simple application works, but with very old-style monolithic codebase, so do anything you want with it, to make it:

  - easier to work with
  - more maintainable

## Fixes/Changes

1. Upgraded to latest version of PHP 8
2. Install PHP composer package manager
    reference: https://getcomposer.org
3. Install some library like collect for collection manipulation and phpdotenv for environment
4. Code cleanup (Refactor code and remove hard code)
