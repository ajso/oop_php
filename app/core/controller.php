<?php

/*
Main Controller Class
*/
class Controller{

    public function view($view_name, $data=[]){ //view_name is the name of the view in the views.

        extract($data); //extract whatever will be in data.
        $filename = "../app/views/".$view_name.".view.php"; //path to the file name.

        if(file_exists($filename)){

            require $filename;
        }else{
            echo "Could not find the view file: " .$filename;
        }

    }
}