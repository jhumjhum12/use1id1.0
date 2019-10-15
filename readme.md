# 1id Git Repo

## Starting Project

- create project folder
- git clone https://februarski@bitbucket.org/februarski/1id.git .
- composer install
- try to hit /localhost/project-folder/public folder
- if white screen appears
    - sudo chmod -R gu+w storage
    - sudo chmod -R guo+w storage
- open .env.example and create copy of file with name .env
- open .env, set up your local database connection and generate 32-bit key for APP_KEY
- php artisan migrate
- Let's seed the database with some data
    - composer dump-autoload
    - php artisan db:seed
(5/10)
- This will seed some fixed tables AND will create some users; password for all users is "password"
- User with id=1 will have admin access (temporary measure)
- manually import some screens from _data/dumps/screens-1id.sql
- If error is displayed on Translator screen or translating labels and messages is not working do: 
	- LAMP: sudo chown -R www-data resources/lang
	- XAMPP: sudo chown -R daemon resources/lang
    - After that hit 'Compile' button on Translator main screen 

