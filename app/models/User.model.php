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
        'create_date',
        //added while implementing the update profile page.
        'bio',
        'company',
        'job',
        'country',
        'address',
        'phone',
        'img_url',
        'slug_url',
        'twitter_link',
        'linkedIn_link'
    ];


    //function to validate the inputs.
    public function validate($data)
    {

        $this->errors = [];
        //validate the inputs
        if (empty($data["firstname"])) {

            $this->errors["firstname"] = "last is required";
        } else if (!preg_match("/^[a-zA-Z]+$/", trim($data['firstname']))) {
            $this->errors['firstname'] = "first name can only have letters without spaces";
        }

        if (empty($data["lastname"])) {

            $this->errors["lastname"] = "last is required";
        } else if (!preg_match("/^[a-zA-Z]+$/", trim($data['lastname']))) {
            $this->errors['lastname'] = "last name can only have letters without spaces";
        }
        //check if email already exist.
        // $query = "SELECT *FROM users WHERE email=:email LIMIT  1";
        if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {

            $this->errors["email"] = "Invalid email";
        } else {
            if ($this->where(['email' => $data["email"]])) {

                $this->errors["email"] = "This email already exists";
            }
        }

        if (empty($data["password"])) {

            $this->errors["password"] = "password is required";
        }
        if ($data["password"] !== $data["retype_password"]) {

            $this->errors["password"] = "Password do not match.";
        }
        if (empty($data["terms"])) {

            $this->errors["terms"] = "Accept the terms and conditions";
        }

        if (empty($this->errors)) {
            return true;
        } else {
            return false;
        }
    }

    public function edit_validate($data, $id)
    {

        $this->errors = [];
        //validate the inputs
        if (empty($data["firstname"])) {

            $this->errors["firstname"] = "last is required";
        } else if (!preg_match("/^[a-zA-Z]+$/", trim($data['firstname']))) {
            $this->errors['firstname'] = "first name can only have letters without spaces";
        }

        if (empty($data["lastname"])) {

            $this->errors["lastname"] = "last is required";
        } else if (!preg_match("/^[a-zA-Z]+$/", trim($data['lastname']))) {
            $this->errors['lastname'] = "last name can only have letters without spaces";
        }

        //check email
		if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL))
		{
			$this->errors['email'] = "Email is not valid";
		}else
		if($results = $this->where(['email'=>$data['email']]))
		{
			foreach ($results as $result) {
				if($id != $result->id)
					$this->errors['email'] = "That email already exists";
			}
			
		}

        if(!empty($data['phone']))
		{
			if(!preg_match("/^(09|\+2609)*[0-9]{8,14}$/", trim($data['phone'])))
			{
				$this->errors['phone'] = "Phone number not valid";
			}
		}

        if (!empty($data["twitter_link"])) {

            if (!filter_var($data["twitter_link"], FILTER_VALIDATE_URL)) {
                $this->errors["twitter_link"] = "Invalid Twitter Link";
            }
        }

        if (!empty($data["linkedin_link"])) {

            if (!filter_var($data["linkedin_link"], FILTER_VALIDATE_URL)) {
                $this->errors["linkedin_link"] = "Invalid LinkedIn Link";
            }
        }

        if (empty($this->errors)) {
            return true;
        } else {
            return false;
        }
    }
}
