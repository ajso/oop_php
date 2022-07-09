<?php
/*
 signup class - 
 
*/

class SignUp extends Controller{

    public function index(){
       
        
        $data['page_title'] = "SignUp to our App";
        $data['errors'] = [];
        $user = new User();
        // $es = secure_random_string(3);
        // show($es); die;
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            if($user->validate($_POST)){
                
                
                $_POST['create_date'] = date('Y-m-d H:i:s');
                $_POST['role'] = 'user';
                //$_POST['url_link'] = $user->secure_random_string(3);
                $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

                $user->insert($_POST);
                message("Account successfully created, Login.");
                redirect('login');
             }
             
        }

        $data['errors'] = $user->errors;
        //show($_POST);
        $this->view('signup', $data);
    }


}