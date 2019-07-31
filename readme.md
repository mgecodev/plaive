# plaive (MagicEco LMS service)

#Server Requirement

The Laravel framework has a few system requirements. All of these requirements are satisfied by the Laravel <a href="https://laravel.com/docs/5.8/homestead">Homestead virtual machine</a>, so it's highly
recommended that you use Homestead as your local Laravel development environment.

However, if you are not using Homestead, you will need to make sure your server meets the following requirements.

* PHP >= 7.1.3 
* OpenSSL PHP Extension
* PDO PHP Extension 
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension
* Ctype PHP Extension 
* JSON PHP Extension
* BCMath PHP Extension 

# Installation
* Download the repository ```git clone https://github.com/mgecodev/plaive.git ```
* Run ```composer install``` in terminal
* Directories within the ```storage``` and the ```bootstrap/cache``` directories should be writable by your web server. Otherwise, Laravel will not run.
* Rename the ```.env.example``` file to ```.env```, configure database access and the ```APP_URL``` value
* Run ```php artisan key:generate``` to generate the App's encryption keys
* Generate the database and seed some initial data ```php artisan migrate --seed```

# OAuth 2.0 Setup
Create encryption keys to generate secure access tokens and create "personal access" and "password grant" clients wich will be
used to generate access tokens: ```php artisan passport:install```

#Testing
* Open phpunit.xml and make sure the environments are correct for your domain.
* Run the tests ```./vendor/bin/phpunit```

