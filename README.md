# Algolia scout laravel

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.5/installation#installation)

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Now we need to set configuration queue is true in your env file:

    SCOUT_QUEUE=true
    

Install all the dependencies using composer

    composer install

Generate a new application key

    php artisan key:generate

Ok, now we have to install package for "algolia", so let's run bellow command:
    
    composer require algolia/algoliasearch-client-php
    
migration with add data

    php artisan migrate --seed    
    
Now we have to set id and secret of algolia, so first you have to create new account in algolia.com. So if you haven't account on algolia.com site then click here and create new account : www.algolia.com

After login we have to get application id and secret so click here and open that web page: www.algolia.com/api-keys GET APP ID and SECRET. After open you will see bellow screen and copy your id and secret.
   
now open your .env file and paste id and secret key like as bellow:

    ALGOLIA_APP_ID=paste app id
    ALGOLIA_SECRET=paste app secret
    
 If you have already added few records on your table then you can index that records by run following command:
 
    php artisan scout:import "app\Contact" 
    
for run the project

     php artisan server
