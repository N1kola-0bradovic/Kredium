<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## About Repository

This repository contains a Laravel app test for managing Loans.
Description is roughly as follows:

The idea is to build a small CRM (Custom Relationship Management) software for a
company that specializes in connecting their clients with banks and lenders that can
provide them with two types of loans:
- Cash loan
- Home loan

The business flow is as follows:
- The client calls in and leaves his details over the phone to an adviser
- Adviser takes client's data and enters it into the system
- Adviser fills in loan application data for a loan that the client chose
(cash/home, or both)
- At the end of the day, advisers want to make a report of clients and products
that they have entered in so far

## Building Project

This software is made via technologies:
- Laravel
- MySql
- Xampp
- AdminLte

For setuping the project commands shold be as follows:
- Composer install
- Npm install
- Npm run build (or dev)
- Php artisan migrate
- Php artisan db:seed

Some optional commands if needed are:
- Php artisan adminlte:install
- Php artisan ui bootstrap --auth
- Php artisan vendor:publish --tag=adminlte-dg-plugins
- Composer require dgvai/laravel-adminlte-components
- Php artisan adminlte::install --only=auth_views
- Composer require laravel/ui
- Composer require jeroennoten/laravel-adminlte

## Visuals

In the app, we can find initial visual pages:
- Login
- Register

After successfull login, we land on dashboard where we have:
- View All clients
- View report
- Logout (click on user name in upper right corner)

In View all clients page we can:
- See all clients
- Edit client (by adding and managing their loans)
- Delete a client

In View report page we can:
- See culminated and calculated reports
- Export the report

## Structure

Code structure contain all the fundamentals of an Laravel app:
- MVC with blades as pages (AdminLte boilerplate)
- Migrations, Models, Relations
- Controllers implementing Repository and Service logics
- Validations, Interfaces, Dependency injections
- Routes that are grouped by two groups - Client and Report
- Seeders for dummy/testing data
- Configurational files, etc.
