<?php

/* 

will hold the configurations of the system.
1. Check server, i.e is it a local serve or a live server.

*/

/* 
=========App info.

*/
define('APP_NAME', 'Udemy Clone');
define('DESC', 'The best app ever.');

// echo "<pre>";
// print_r($_SERVER);

if($_SERVER['SERVER_NAME'] == 'localhost'){ 
    //local machine configurations.
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_DRIVER', 'mysql');
    define('DB_NAME', 'udemy_clone');


}else{
    // Database config for a live server.
    define('HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_DRIVER', 'mysql');
    define('DB_NAME', 'udemy_clone');

}