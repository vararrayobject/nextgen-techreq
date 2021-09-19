Laravel Project Deployment Documentation

Server Requirements :

    • LAMP OR LEMP Stack
    • PHP: 7.1.3 or greater
    • PDO PHP extension
    • JSON PHP extension
    • OpenSSL PHP extension
    • Tokenizer PHP extension
    • XML PHP extension
    • Mbstring PHP extension
    • Ctype PHP extension
    • BCMath PHP extension

Step 1 . Clone the git repo inside server (eg. /var/www/html/)

Step 2 . Install composer dependencies , cd to the root dir of the project and execute composer install in terminal

Step 3 . Install npm dependencies , cd to the root dir of the project and execute npm install in terminal

Step 4 . Create a copy of .env file from .env.example file from the root project dir , and replace the database and mailing configurations
Change below details in env file

    • DB_DATABASE=YOUR_DB_NAME
    • DB_USERNAME=YOUR_DB_USERNAME
    • DB_PASSWORD=YOUR_DB_PASSWORD

Step 5 . Generate an app encryption key, necessary for encoding various elements of cookies, password hashes and more, execute php artisan key:generate

Step 6 . Create a database, and make sure the Step 4. is done properly, run the below command
command: php artisan migrate --seed

Step 7 . Passport security keys generation , execute the command from the root dir of the project php artisan passport:install(Not required for this particular project you can skip this step)

Step 8 . From .env change the APP_NAME to the desired name, also change the APP_ENV to prod if on production enviornment else on local, if local or uat environment, also change APP_DEBUG to false if on production enviornment.

Step 9 . Give read and write permission to storage and bootstrap/cache directory.
Command: sudo chgrp -R www-data /var/www/example-project-name/storage /var/www/example-project-name/bootstrap/cache

Command: sudo chmod -R ug+rwx /var/www/example-project-name/storage /var/www/example-project-name/bootstrap/cache

Step 10 . Run command: php artisan serve
this will run the project on default server.

Step 11 . Run the application with YOUR_URL/ and you will be redirected to /login where you can register new user.
