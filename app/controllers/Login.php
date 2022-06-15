<?php
/*
 Login class - 
 
*/

class Login extends Controller{

    //this is the home page
    public function index(){
        // echo "Home Page";
        $data['title'] = "Login to our App";

        $data['errors'] = [];
        $user = new User(); //user object.
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            //validate.
            $row = $user->first([
                'email'=>$_POST['email'], //check if the email was posted
            ]);
            if($row){
                
                //check if the password is correct. password_verify(string, hash)
                if(password_verify($_POST['password'], $row->password)){
                    //authenticate user
                    //$_SESSION['USER_DATA'] = $row;
                    Auth::authenticate($row);
                    //redirect to the home page.
                    redirect('home');
                }

            }
            $data['errors']['email'] = "Invalid email or password";
            //show($row); die;
        }
       
        $this->view('login', $data);
    }


}