## Comp586
Site to project: [Project Link](http://ec2-34-215-152-141.us-west-2.compute.amazonaws.com/ "http://ec2-34-215-152-141.us-west-2.compute.amazonaws.com/")

### Deployment, Branches & Installation
---
> Due to AWS having a very weak free tier, all assets were revisioned to avoid having to pull and build them in the production VM. I tried but the VM would crash.

> You need to have composer and npm installed on the host system you wish to install the client on. Minimum: `composer version (1.0.0-beta2) 2016-03-27` and `npm version 3.5.2`

> To install laravel cd into the comp586 directory and run `composer dumpautoload` this will download all the dependencies, then run `php artisan migrate --seed` to seed the database which is defined in `/comp586/.env`

> To install angular cd into the comp586/frontend folder and run `npm install` and `ng build --bh /dist/` to compile the front end files, they are automatically set to be placed in laravels public directory which should be the document root of the application.

### Extras
---
* for Laravel I created factories to help with the databases seeders, but in the end just ended up creating manual seed files. the factories work but are commented out. Location: `/comp586/database/factories` and `/comp586/database/seeds`

* At the bottom of the page is a log that displays all the api calls that are made to the server when you interact with the app. I thought this was a nifty way to show case and test all the api calls.

* Link to similar project, also made using angular and laravel [Other Project Site Link](http://ec2-34-216-138-204.us-west-2.compute.amazonaws.com/ "http://ec2-34-216-138-204.us-west-2.compute.amazonaws.com/") [Other Project Repo Link](https://github.com/iliabenson/comp467 "https://github.com/iliabenson/comp467")

* CORS I used a package and middleware to handle all CORS issues that I had during development, the app in production is served by larael so no CORS issues there but during development they were ran on different local servers, the middleware can be seen `/comp586/routes/api.php`, `Route::group(['middleware' => ['cors']], function () {` the plugin can be configured but I left in the default settings, disabling it is as easy as deleting the middleware bind.

### Short Comings
---
* In this project I was new to angular and auth0, it was the main reason for choosing them, I wanted to learn something new, unfortunately due to poor time management on my part and being a bit overloaded with work I did not get authorization to fully work. none of the api calls or front end links are guarded. Authentication is fully working though, JWT is sent over the network and can be viewed in the network tab in browser developer tools.

### Required Features
___

* Authentication/Authorization front end only, used auth0 `/comp586/frontend/src/app/auth.service.ts` no backend implementation see short comings above.

* DI Laravel, `/comp586/app/Controllers/HeroController.php` the store and update functions inject a request

* DI Angular, `/comp586/frontend/src/app/[ANY SERVICE]` all my services have the `@Injectable` decorator

* Testing Laravel, `/comp586/tests/Feature/HeroesTest.php` to run the test just run `phpunit` from `/comp586`

* Testing Angular, `/comp586/frontend/src/app/hero.service.spec.ts` to run the test just run `npm test` from `/comp586/frontend`

* ORM Laravel, the eloquent ORM allows you access your models from anywhere as long as you use a Facade or their namespace. The models can be found `/comp586/app/Hero.php` and `/comp586/app/User.php` User demonstration is can be found in the factories and seeder files listed under the Extras section. Migrations can be found in `/comp586/database/migrations`. Laravel also supports route model binding but this was not featured to keep things simple.

* Table foreign key access, in the heroes migration you can see that there is another schema that links the user_id from the user table to the heroes table, the use is demonstrated in the heroes seeder. `/comp586/database/migrations/2017_11_25_231822_create_heroes_table.php` and `/comp586/database/seeds/HeroesTableSeeder.php`. it is defaulted to use the first user because authentication was not set up fro the backend, see short comings section, however in the seeder you can easily use the User::Auth() facade to get the currently logged in user and access it's data via the model as shown in the seeder.

* MVC Laravel, Models and Controllers have been covered already, the view is located `/comp586/resources/views/welcome.blade.php` this view just echos the contents of the compiled frontend, essentially serving the angular application upon first connection and eliminating the need for CORS mitigation. The routs for this can be found `/comp586/routes/web.php` and the API routes are located `/comp586/routes/api.php`

* MVC Angular, the services are controllers, the components poses the models as variables and the competes' HTML templates use them, the views are the components' HTML and CSS templates. all components, templates and specs are located under the component directories and the services are in the same directory as the component directories, `/comp586/frontend/src/app/`

* CLI Tools, both angular and laravel have command line tools. `ng` for angular and `artisan` for laravel, both have package managers, `npm` for angular and `composer` for laravel. Both have staging environments `ng serve` for angular and `artisan tinker` for laravel.
