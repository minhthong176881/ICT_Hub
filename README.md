# ICT_Hub
Codding conventions:
  - Files name: snake case, no upper case
  - Variables name: camel case

Techologies:
  - Backend: php with MVC pattern + mongodb
  - Frontend: HTML/CSS/JS 
 
Requirements:
  - OS: linux
  - php 8.0, mongodb, composer
  - apache2 

Installation:
  - Install mongodb driver: 
    + $ sudo pecl install mongodb 
    + $ sudo apt install php-mongodb
    + Add "extension=mongodb.so" to php.ini file (/etc/php/8.0/apache2/php.ini)
  - Run _$ composer require mongodb/mongodb_ in the project folder
