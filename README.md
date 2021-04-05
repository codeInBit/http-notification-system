## HTTP Notification System

This application accept urls (endpoints) to subscribe to topics on a server and when messages are published on those topics, the urls (endpoints) recieve the messages.

When the endpoint - [http-notification-system.test/api/publish/{topic}](http-notification-system.test/api/publish/{topic}) to publish the message is hit, a job is dispatched to push the messages via HTTP request to all subscribed urls.

## Technology
This project was built with Laravel PHP while PHPCS and PHPStan are setup and configured in the codebase as static analysis tool to ensure clean, good code quality and uniform standards across the codebase.

Test are written for the endpoints using PHPUnit.


Github Actions is also setup and configured on the code base to handle continous integration, when ever a push is made to master, Github Actions checks the codebase against some set of rules (some of which is PHPCS and PHPStan, Tests) and passes if everything is fine and if otherwise, it fails.

- To run test on the codebase locally, run the command *php artisan test*
- To run PHPCS configuration against the codebase locally, run the command *./vendor/bin/phpcs*
- To run PHPStan configuration against the codebase locally, run the command *./vendor/bin/phpstan analyse*


## Installation
- Clone the project to your local machine
- Run the command *composer install*, to install dependencies
- Run the command *php artisan key:generate*
- If .env file diesn't exist, run the command *cp .env.example .env*
- In the .env file, update the necessary information to allow connection to a database
- Run the command *php artisan serve* to start the publisher application server
- Run the command *php artisan queue:work* to start the queue worker


The [POSTMAN COLLECTION](https://documenter.getpostman.com/view/13007176/TzCQbn14) for this project contains sample request and also sample responce to better understand the endpoint and see how it works.