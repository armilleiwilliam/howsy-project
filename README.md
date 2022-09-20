

Php version: I have developed the test using my work computer. The most of our projects run php 5.6 or 7.4, I haven't upgraded to  v. 8 yet, so, I have
developed the test using php 7.4

Virtual host: in order to see it working you need to create a virtual host, pointing to the folder containing the project
(no file index.php in the folder). I have attached an example of the file in my local server with the VirtualHost configurations (howsy-project.conf)

Database: you find the dump of the database with offers and products on the howsy_test.sql. The connection parameters are found in inc/variables.php .

Users: considering the type of test was to concentrate on the basket development, I have avoided to develop a registration or login code,
I assumed that the user was already logged in, forcing, when needed, to enter user_id = 1 when requesting a user related data

To see it working:
- the home shows the basket: http://www.howsy-test.com. It basically returns a json with the basket contents, if empty otherwise. Every time you add a product
    the basket is populated and refreshing this page the json returned shows the total price and total price discounted according to the 
    promotion the user is registered to. 
- to add a product: http://www.howsy-test.com?add_prod=P001. You will see a Json returned with a successful message, if the product code 
  does not exist a message is returned. If you want to see the basket being populated open http://www.howsy-test.com.
- to empty a cart: http://www.howsy-test.com?empty_cart


