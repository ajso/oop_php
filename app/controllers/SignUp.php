<?php
/*
 signup class - 
 
*/

class SignUp extends Controller{

    public function index(){
       
        $data['page_title'] = "SignUp to our App";
        $data['errors'] = [];
        $user = new User();
        
        if($user->validate($_POST)){
            
            $user->insert($_POST);
        }

        $data['errors'] = $user->errors;
        //show($_POST);
        
    
        // show($db);
        $this->view('signup', $data);
    }


}