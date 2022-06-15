<?php

class Auth{


    public static function authenticate($row){

        //check if $row is obj
        if(is_object($row)){
            $_SESSION['USER_DATA'] = $row;
        }
        
    }


    //Logout function
    public static function logout(){

        //unset
        if(!empty($_SESSION['USER_DATA'])){

            unset($_SESSION['USER_DATA']);
            //session_unset(); erase the entire session
            //session_regenerate_id();
        }
        
    }

    //check if someone is already logged in.
    public static function logged_in(){

        if(!empty($_SESSION['USER_DATA'])){
            return true;
        }
        return false;

    }

    //check if logged user is admin
    public static function is_admin(){
        if(!empty($_SESSION['USER_DATA'])){
            if($_SESSION['USER_DATA']->role == 'admin'){
                return true;
            }
        }
    }

    //function to get a database column /getter()
    public static function __callStatic($name, $arguments)
    {
        $key = str_replace("get", "", strtolower($name));
        if(!empty($_SESSION['USER_DATA']->$key)){

            return $_SESSION['USER_DATA']->$key;
        }
        return "Guest";
    }
    
}