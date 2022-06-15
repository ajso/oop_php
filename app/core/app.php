<?php

// This file will launch the application.
class App
{

    protected $controller = "_404"; //default in case no controller found.
    protected $method = "index"; //default method/function.

    public static $page = "_404"; //to access

    //special function method __construct to automatically run when the app runs.
    function __construct()
    {  
        //=======================================Routing Stage=======================
        $arr = $this->getUrl();

        //defining the first file page(home page)
        $filename = "../app/controllers/" . ucfirst($arr[0]) . ".php"; //the first item. e.g home.php
        //check if the home page extists
        if (file_exists($filename)) {

            require $filename;
            $this->controller = $arr[0]; //updating the controller from 404 to a new controller.
            self::$page =$arr[0]; //accessing a static variable
            unset($arr[0]);

        } else {
            require "../app/controllers/" . $this->controller . ".php"; //404 error
        }

        //instantiating the controller
        $mycontroller = new $this->controller();
        $mymethod = $arr[1] ?? $this->method;

        if(!empty($arr[1])){
                //check if the function/method required exists.
            if(method_exists($mycontroller, strtolower($mymethod))){
                $this->method = strtolower($mymethod);
                unset($arr[1]); //remove item from the array.
            }
        }
        
        //show($arr);

        $arr = array_values($arr); //cleaning the array.
        //calling a function to run.
        call_user_func_array([$mycontroller, $this->method] , $arr);

        // =================================End Routing Stage====================
    }

    //function to get the URL
    private function getUrl()
    {
        $url = $_GET['url'] ?? 'home';
        $url = filter_var($url, FILTER_SANITIZE_URL); //cleaning up the url, removing space and unwanted characters.
        $arr = explode('/', $url); //using explode() to split the url by '/'
        return $arr;
    }
}
