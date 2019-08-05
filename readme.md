# Plaive API

<h3> Sever Requirements </h3>
<hr>
The Laravel framework has a few system requirements. All of these requirements are satisfied by the Laravel Homestead virtual machine, so it's hightly recommentded that you use Homestead as your local Laravel development environment.

However, if you are not using Homestead, you will need to make sure your server meets the following requirements:

* PHP >= 7.1.3
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension
* Ctype PHP Extension
* JSON PHP Extension
* BCMath PHP Extension

<h3>Installation</h3>
<hr>

* Download the repository and run composer install
* Directories within the storage and the bootstrap/cache directories should be writable by your web server or Laravel will not run.
* Rename the .env.example file to .env configure database access and the APP_URL value
* Run php artisan key:generate to generate the App's encryption keys
* Generate the database and seed some initial data php artisan migrate --seed

<h3>OAuth 2.0 Setup</h3>
<hr>
Create encryption keys to generate secure access tokens and create "personal access" and "password grant" clients which will
be used to generate access tokens: php artisan passport:install

<h3>Testing</h3>
<hr>
* Open phpunit.xml and make sure the environments are correct for your domain.
* Run the tests ./vendor/bin/phpunit

