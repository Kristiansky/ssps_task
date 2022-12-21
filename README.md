## SSPS Task

###How to set up this project

1. Clone this repo on your local machine in a certain dir: `$ git clone https://github.com/Kristiansky/ssps_task`
2. CD to the dir and run `composer install`
3. On the same dir run `cp .env.example .env` then `php artisan key:generate`
4. Create a database on your local server and remember its name
5. Create a VirtualHost with the path pointing to `/spss_task/public/`
6. In the root folder there will be a new file: **.env**, open it with an editor and complete the DB_* constants with your custom ones, for example for `DB_DATABASE=laravel_db` as you use the name from point **4.**
7. Finally, run the command `php artisan migrate`

Head to your browser, enter the virtual host that you made from point **5** and view the project.
