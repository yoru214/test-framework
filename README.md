# Test Framework - Shopping Cart 
## Introduction

I was tasked to create a Shopping cart with some set of requirements. Primary requirement was it has to be built without using Frameworks either be of PHP or Javascript. This somehow gave me the oppurtunity to practice PHP 7.2 OOP which made me very greatful. I had been developing PHP for a couple of years and I sure never thought of some important aspects and feature of PHP OOP programming. In this application I made, it gave me a chance to relearn OOP, starting from using Autoloaders, Namespaces to Interfaces and etc.  

## Tools Needed
1. Docker Compose

### Docker Compose
You dont actually need to study Docker Compose in depth. What you need is just to install Docker Compose so you may run this application. I chose Docker Compose as it allows me to set My servers PHP Version as well as MySQL version, and switch to any version with ease. Thoug in this application it is PHP 7.2 and MySQL 5.7.

#### Running the Container
Once you have installed Docker Compose on any platform, all you need to do is to run the following command on the directory where you had extracted the applications file. 

(Note: it has to be where the docker-compose.yml is located.)

```bash
docker-compose up -d
```

<strong>IMPORTANT!!!</strong>

Ports 80 and 3306 must be available on the machine you had the docker container running. 

#### Accessing the Application
To access the application (Shopping Cart) just access http://localhost on your browser.

If it is your first time running the application, the database will be empty, and the application will throw an error. You will need to restore the database. A dump of the database is imcluded on this repo with the file name "mysqldump.sql".

##### Credentials to access the database:

>HOST : localhost

>USERNAME : root

>PASSWORD : root

>DATABASE : testdb

## Page Sections

![Alt-text](https://raw.githubusercontent.com/yoru214/test-framework/master/resources/images/Homepage.png)

1. Link to Home Page or Product List Gallery.
2. Select option to Rate product from 1 to 5.  
3. Button to submit rating.
4. Link to view products individualy. 
5. Reduce quantity to be added to Cart.
6. Input and Display for the quantity of items to be added to the Cart.
7. Add quantity to be added to the Cart.
8. Button to add the selected or set quantity to the cart.
9. Random Customer Name. Will be changed randomly when User Session is logged out.
10. Button to log out user session.
11. User/Customer initial fund. 
12. Cart Area
13. Add Quantity to product before checkout.
14. Reduce Quantity of product before checkout.
15. Shipping Modes
16. Button to Check out the Cart.

## Original Task Description
So let's say there are 4 products in an online shop, an apple is 0.3$, a beer is 2$, water is 1$ each bottle and cheese is 3.74$ each kg. They have been stored in Mysql DB

Create a simple interface where:
- I can add/remove products to my virtual shopping cart in any quantities
- I can see my current cart status
- I have to choose a shipping option between 'pick up' (USD 0) and 'UPS' (USD 5). No option is chosen by default, so if i don't choose one and click on “Pay”, the interface asks me to select one. 
- After clicking on 'pay' (Originally my balance is USD 100 and after the purchase the remaining balance is stored) I want to see the previous balance, total purchase cost and my remaining balance after paying. 
- The shop should be in English only including code comments
- Please write this shop using PHP7.2 OOP
- Near each product there is a rating scale from 1 to 5, I can rate it and I can see current average rating of each product. Rating should only be allowed once per session or once per user and rates are stored using Mysql DB.
- Some CSS/html/JS so it looks a little better

General requirements
- DRY;
- Neat and consistent style;
- Understandable names;
- Clear logic flow (avoiding spaghetti code), short methods;
- Minimal reliance on global state: e.g. usage of superglobals. A separate place processing them should be dedicated.

OOP requirements
- Logic should be fully inside classes including ajax controller (but except, maybe, Views);
- Separation of concerns: one class is responsible for a single thing;
- Minimum (or zero) amount of static methods;
- Encapsulation;
- Existence of entities / models like ShoppingCart;

Please DO NOT use anybody else’s work for this. EVERYTHING on this project should be written by you and it should be authentic work.
You can use external projects as reference for Jquery, Ajax and Bootstrap if needed. Using any PHP or JS framework is strictly forbidden, but you can use third-party libraries if you need them.
Please use Allman coding style, https://en.wikipedia.org/wiki/Indent_style#Allman_style
put it on our hosting https://www.cba.pl (registration is free) and give me the link.