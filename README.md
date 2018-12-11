# my_api Usage:
Simple symphony api app
1. git clone https://github.com/Fa2it/my_api.git
2. cd into my_api/
3. run composer update
4. import "api.sql" file found in "public/"  folder
5. set up database login in the ".env" file
6. run the development server: php bin/console server:run
7. run phpunit tests/

# Task
Build a set of REST interfaces (no visual interfaces are needed) that allow us to do the following:

Manage a list of products that have prices.
1. Enable the administrator to set concrete prices (such as 10EUR) and discounts to prices either by a concrete amount (-1 EUR) or by percentage (-10%).
2. Enable the administrator to group products together to form bundles that have independent prices.
3. Enable customers to get the list of products and respective prices.
4. Enable customers to place an order for one or more products, and provide customers with the list of products and the total price.
