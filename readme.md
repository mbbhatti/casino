# About
Casino board application.

## Requirements
- PHP >= 7.2
- Lumen >= 6.0

## Installation 
Composer used to manage application dependencies. So, before using this application, make sure you have composer installed on your machine. To download all required packages run these commands or you can download [Composer](https://getcomposer.org/doc/00-intro.md).
- composer install

## Setup
You need to create a .env file from .env.example if it is not exists through this command.
-  cp .env.example .env

Then, run this command to create key in .env file if not exists.
- php artisan key:generate

## Run
Use this command to run this project 
- php artisan serve