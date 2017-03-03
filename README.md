# Social Network - Written In PHP
This is a small project that I started in my A Level computer science class. Its fairly neat and tidy, taking an MVC approach to produce responsive, self updating interfaces.

# The Database
The system uses the PDO libary to access data stored in the database. Please configure the lib/config.php file with the connection details of your database.

When a request is made to index.php, an sql init script, located at /lib/sql/init.sql will automatically be executed, to generate the tables for you.

Feel free to make a pull request.
