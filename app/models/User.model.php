<?php
/*
 User class - 
 
*/

class User extends Model
{


    protected $table = "users"; //database table variable.
    public $errors = []; // to hold the errors
    protected $allowedColumns = [
                'firstname',
                'lastname',
                'email',
                'role',
                'password',
                'create_date'];


    //function to validate the inputs.
    public function validate($data)
    {

        $this->errors = [];
        //validate the inputs
        if (empty($data["firstname"])) {

            $this->errors["firstname"] = "last is required";
        }
        if (empty($data["lastname"])) {

            $this->errors["lastname"] = "last is required";
        }
        //check if email already exist.
        // $query = "SELECT *FROM users WHERE email=:email LIMIT  1";
        if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {

            $this->errors["email"] = "Invalid email";
        }else{
            if($this->where(['email'=>$data["email"]])){

                $this->errors["email"] = "This email already exists";
            }
        }
        
        if(empty($data["password"])){

            $this->errors["password"] = "password is required";
        }
        if($data["password"] !== $data["retype_password"]){

            $this->errors["password"] = "Password do not match.";
        }
        if(empty($data["terms"])){

            $this->errors["terms"] = "Accept the terms and conditions";
        }

        if (empty($this->errors)) {
            return true;
        } else {
            return false;
        }
    }

    
}
