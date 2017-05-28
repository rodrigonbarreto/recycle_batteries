Recycle Batteries
=======
case: Idea of “Recycle batteries” web application is to count amount of collected batteries. 
      There is a box for used batteries and a computer near the box, with our web application. When someone brings old batteries – he throws them into the box and submit a form in application. The form is about “I added 2 batteries of type AAA to the box”.
      After a couple of days, when the box is almost full, we could get a statistics, what is inside the box? For example, there would be 12 AAA batteries, 20 AA batteries and 5 “undefined” ones. No idea, whether this statistics was important or not, but it is a good example to build a simple web application on Symfony.

funcionality: 

* 1.1.	Create a page with form to add information about batteries. 
              Form must contain fields: “battery type”, “count”, “name”. “Name” is not required field, even anonymous user can give us used batteries. After form is submitted, the record about added batteries is stored in database.
              
* 2.2 Create a page with statistics of collected batteries. There must be a table on this page with two columns: “battery type” and “total count”
             
* 3.3 Write functional test for “statistics” feature. 
      Test case:
       
      •	Submit “Battery form” with 4 AA batteries
      •	Submit “Battery form” with 3 AAA batteries
      •	Submit “Battery form” with 1 AA battery.
      •	Open statistics page and check that there are 2 rows in the table, with counts: AA – 5, AAA – 3.
             
      
      

# setup
 1 - composer install
 
 2 - php bin/console doctrine:database:create 
 
 3 - php bin/console doctrine:migrations:migrate -
 -no-interaction
 
 4 - php bin/console server:run
 
    - endpoints:
        
    http://localhost:8000/app_dev.php/ - statistic page

    
# Run test
 * vendor/bin/phpunit


