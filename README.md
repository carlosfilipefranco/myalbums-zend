# MyAlbums

## Introduction

This is a simple application using the ZF2 MVC layer and module
systems. This application is meant to be used as a starting place for those
looking to get their feet wet with ZF2.

Clone this repository and run Composer:

    composer install

## Database

    mysql -u '<your_user'> -p
    CREATE DATABASE myalbums;
    mysql -u '<your_user>' -p myalbums < data/db.sql

## PHP CLI server

The simplest way to get started if you are using PHP 5.4 or above is to start the internal PHP cli-server in the root
directory:

    php -S 0.0.0.0:8080 -t public/ public/index.php
