
**Structure::** I have used an MVC type, due to the simplicity I have avoided adding controllers and methods in "App" or "Src" folders.  

**Php version:** I have developed the test using my work computer. The most of our projects run php 5.6 or 7.4, I haven't upgraded to v. 8 yet, so, I have
developed the test using php 7.4, but I can develop in Php 8.

**Virtual host:** in order to see it working you need to create a virtual host, pointing to the folder containing the project
(no file index.php, if not messes up the file paths). I have attached an example of the file in my local server with the VirtualHost 
configurations (howsy-project.conf)

**Database:** you find the dump of the database with offers and products on the howsy_test.sql. The connection parameters are found in inc/variables.php .

**Users:** considering test was to focus on the basket development, I have avoided to develop a registration or login code,
I assumed that the user was already logged in, so, the user id is manually passed (user_id = 1) when requesting data belonging to a user

**PHPUnit installation:** you can find composer.json, by running composer install should add PhpUnit. In case it fails  run "composer require --dev phpunit/phpunit ^7"
Test the app expected results running: "./vendor/bin/phpunit tests/BasketTest". Considering the app is not dveloped with a framework (usually PhpUnit
is ran and adapted for frameworks) the $this->get("/") and $this->post("/") methods don't work, but only comparison assertions on results returned


**Docker**: as you might have noticed I haven't used Docker as you requested. I have used it long time ago and I thought I could pick it up more quickly
when the recruiter informed me it was an important tool for you, but this was not the case unfortunately. I am quite sure in a few weeks I could start becoming confident using it, 
but it's your choice to take it into consideration or not. 

**Run the app:**
- the home shows the basket: "http://www.howsy-test.com". It basically returns a json with the basket contents, if empty otherwise. Every time you add a product
    the basket is populated, refreshing this page the json returned shows the total price and total price discounted according to the 
    promotion the user is entitled to. 
- to add a product: http://www.howsy-test.com?add_prod=P001. You will see a Json returned with a successful message and the product details, if the product code 
  does not exist a message is returned. If you want to see the basket being populated open the home again, http://www.howsy-test.com.
- to empty a cart: http://www.howsy-test.com?empty_cart
I could have added many other functionalities, but I understood you didn't have it to be too elaborated, but to see the structure 
of it and how different parts interacted with each other. 


