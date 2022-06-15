<?php
/*
 Logout class - 
 
*/

class Logout extends Controller{

    // function __construct(){echo "Home Page";}

    //this is the home page
    public function index(){
        Auth::logout();
        redirect('home');
    }


}