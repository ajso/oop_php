<?php
/*
 Admin class - 
 
*/

class Admin extends Controller{

    //this is the home page
    public function index(){
        // echo "Home Page";
        $data['title'] = "Administrator";

        $db = new Database();
        $db->create_tables();
        // show($db);
        $this->view('admin/dashboard', $data);
    }


    //this is the profile page
    public function profile(){
        // echo "Home Page";
        $data['title'] = "Profile";

        $db = new Database();
        $db->create_tables();
        // show($db);
        $this->view('admin/profile', $data);
    }
}