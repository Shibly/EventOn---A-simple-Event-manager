EventOn
============

EventOn is a simple yet powerful event management application backed with Symfony2. 

Features
====================
1. Admin panel for creating new events.
2. Display paginated event list
3. Event calender (cooming soon)
4. Attent event
5. Most popular event
6. More to come

Installation
=================

1) Update your vendor via composer

`php composer.phar install`

2) Copy your parameters.yml.dist file to parameters.yml and customize it

`cp app/config/parameters.yml.dist app/config/parameters.yml`

3) Fix your permissions

`chmod -R 777 app/cache app/logs`

4) Build your database

`php app/console doctrine:database:create`
`php app/console doctrine:schema:create`
`php app/console doctrine:fixtures:load`

5) Setup a virtualhost that points to the web/ directory and a hosts entry for your fake domain

6) Pop it open in your browser!
