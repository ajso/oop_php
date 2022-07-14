<?php
/*
 Course class - 
 
*/

class Course extends Model
{


    protected $table = "courses"; //database table variable.
    public $errors = []; // to hold the errors


    //array of functions the will run after data processing.
    protected $afterSelect = [
        'get_category',
        'get_user',
        'get_price',
        'get_subcategory',
        'get_level',
        'get_language',

    ];

    //array of functions that will run before data processing.
    protected $beforeSelect = [];


    protected $allowedColumns = [
        'title',
        'description',
        'user_id',
        'category_id',
        'sub_category_id',
        'level_id',
        'language_id',
        'price_id',
        'promo_link',
        'welcome_message',
        'congratulation_message',
        'primary_subject',
        'course_promo_video',
        'course_image',
        'tags',
        'approved',
        'is_published',
        'date_created',

    ];


    //function to validate the inputs.
    public function validate($data)
    {

        $this->errors = [];
        //validate the inputs
        if (empty($data["title"])) {

            $this->errors["title"] = "title is required";
        } else if (!preg_match("/^[a-zA-Z \-\_\&\']+$/", trim($data['title']))) {
            $this->errors['title'] = "title can only have letters without spaces";
        }

        if (empty($data["primary_subject"])) {

            $this->errors["primary_subject"] = "primary subject is required";
        } else if (!preg_match("/^[a-zA-Z \-\_\&\']+$/", trim($data['primary_subject']))) {
            $this->errors['primary_subject'] = "primary subject can only have letters without spaces";
        }

        if (empty($data["category_id"])) {

            $this->errors["category_id"] = "Category is required";
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
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Email is not valid";
        } else
		if ($results = $this->where(['email' => $data['email']])) {
            foreach ($results as $result) {
                if ($id != $result->id)
                    $this->errors['email'] = "That email already exists";
            }
        }

        if (!empty($data['phone'])) {
            if (!preg_match("/^(09|\+2609)*[0-9]{8,14}$/", trim($data['phone']))) {
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

    protected function get_category($rows)
    {
        //instantiate the database for this purpose.
        $db = new Database();
        if (!empty($rows[0]->category_id)) { //check if the id exists.

            foreach ($rows as $key => $row) {
                # code... Read from the database.
                $query = "SELECT * FROM categories WHERE id=:id LIMIT 1";
                $cat = $db->query($query, ['id' => $row->category_id]); //returns and array of objects. $cat[0] returns the first item.

                if (!empty($cat)) {
                    $rows[$key]->category_id_row = $cat[0];
                }
            }
        }

        return $rows;
    }

    protected function get_user($rows)
    {
        //instantiate the database for this purpose.
        $db = new Database();
        if (!empty($rows[0]->user_id)) { //check if the id exists.

            foreach ($rows as $key => $row) {
                # code... Read from the database.
                $query = "SELECT id, firstname, lastname, role FROM users WHERE id=:id LIMIT 1";
                $user = $db->query($query, ['id' => $row->user_id]); //returns and array of objects. $cat[0] returns the first item.

                if (!empty($user)) {

                    $user[0]->name = $user[0]->firstname . ' ' . $user[0]->lastname; //property 'name'
                    $rows[$key]->user_id_row = $user[0];
                }
            }
        }

        return $rows;
    }
    protected function get_price($rows)
    { //instantiate the database for this purpose.
        $db = new Database();
        if (!empty($rows[0]->price_id)) { //check if the id exists.

            foreach ($rows as $key => $row) {
                # code... Read from the database.
                $query = "SELECT *FROM prices WHERE id=:id LIMIT 1";
                $price = $db->query($query, ['id' => $row->price_id]); //returns and array of objects. $cat[0] returns the first item.

                if (!empty($price)) {

                    $price[0]->name = $price[0]->price_name . ' ($' . $price[0]->actual_price . ')';
                    $rows[$key]->price_id_row = $price[0];
                }
            }
        }

        return $rows;
    }
    protected function get_subcategory($rows)
    {

        return $rows;
    }
    protected function get_level($rows)
    {

        return $rows;
    }
    protected function get_language($rows)
    {

        return $rows;
    }
}
