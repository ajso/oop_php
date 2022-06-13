<?php
//include a file if not found. auto loader registers a file if not found.
spl_autoload_register('myloarder');

function myloarder($class_name){ //will auto run when there's a missing class.
   require "../app/models/".$class_name.".model.php";
}
require "config.php";
require "functions.php";
require "database.php";
require "model.php";
require "controller.php";
require "app.php";