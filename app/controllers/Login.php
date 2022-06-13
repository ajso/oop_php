<?php
/*
 Login class - 
 
*/

class Login extends Controller{

    //this is the home page
    public function index(){
        // echo "Home Page";
        $data['title'] = "Login to our App";

        $db = new Database();
        $db->create_tables();
        // show($db);
        $this->view('login', $data);
    }


}