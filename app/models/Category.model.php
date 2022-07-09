<?php
/*
 Category class - 
 
*/

class Category extends Model
{


    protected $table = "categories"; //database table variable.
    public $errors = []; // to hold the errors
    protected $allowedColumns = [
        'category',
        'disabled',
        
    ];


    //function to validate the inputs.
    public function validate($data)
    {
        $this->errors = [];
        //validate the inputs
        if (empty($data["category"])) {

            $this->errors["category"] = "Category is required";
        } else if (!preg_match("/^[a-zA-Z \-\_\&\']+$/", trim($data['category']))) {
            $this->errors['category'] = "Category can only have letters and spaces";
        }

        if (empty($this->errors)) {
            return true;
        } else {
            return false;
        }
    }
}
