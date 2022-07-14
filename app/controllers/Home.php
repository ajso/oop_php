<?php
/*
 Home class - 
 
*/

class Home extends Controller{

    // function __construct(){echo "Home Page";}

    //this is the home page
    public function index(){
        // echo "Home Page";
        $data['title'] = "UClone";

        $db = new Database();
       // $db->create_tables();
        // show($db);
        $this->view('home', $data);
    }


}