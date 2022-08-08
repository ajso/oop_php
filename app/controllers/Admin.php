<?php
/*
 Admin class - 
 
*/

class Admin extends Controller
{

    //this is the admin page
    public function index()
    {
        //if statement to implement some security.
        if (!Auth::logged_in()) {
            message("Please login to access the admin section.");
            redirect('login');
        }

        $user = new User();

        //show($user); die;
        $data['title'] = "Administrator";
        $this->view('admin/dashboard', $data);
    }


    //===============================================this is the profile page
    public function profile($id = null)
    {

        if (!Auth::logged_in()) {
            message("Please login to access the admin section.");
            redirect('login');
        }

        $data['title'] = "Profile";
        $id = $id ?? Auth::getId();
        $user = new User();
        $data['row'] = $row = $user->first(['id' => $id]); //return the required user 

        //show($data); die;

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $row) {

            //check if an image exists. before uploading
            //show($_POST); die;

            $folder = "uploads/images/";

            if (!file_exists($folder)) {

                //if it doesn't exist create one.
                mkdir($folder, 0777, true);
                file_put_contents($folder . "index.php", "<?php //silence"); //adding an index.php to $folder.
                file_put_contents("uploads/index.php", "<?php //silence");
            }


            if ($user->edit_validate($_POST, $id)) { //validate the edited fields before submission
                // show($_POST); die;
                $allowedImgType = ['image/jpeg', 'image/png']; //allow image types
                if (!empty($_FILES['image']['name'])) {
                    if ($_FILES['image']['error'] == 0) { //if there are no errors
                        if (in_array($_FILES['image']['type'], $allowedImgType)) { //if the file type is correct

                            //all good
                            $destination = $folder . time() . $_FILES['image']['name']; //destination
                            move_uploaded_file($_FILES['image']['tmp_name'], $destination); //move the image to the destination

                            resize_image($destination); //implementing the file resize

                            $_POST['img_url'] = $destination;
                            //deleting a file if a new one is added.
                            if (file_exists($row->img_url)) { //if updated delete the previous image and replace with the new one.
                                unlink($row->img_url);
                            }
                        } else {
                            $user->errors['image'] = "Require jpeg or png image type.";
                        }
                    } else {
                        $user->errors['image'] = "An error Occured while uploading image.";
                    }
                }

                show($_POST); die;
                //upload content.
                $user->update($id, $_POST); // save to the DB
                message("Profile Successfully Updated!!");

                redirect('admin/profile/' . $id);
            }
        }

        $data['errors'] = $user->errors; //display errors
        $this->view('admin/profile', $data);
    }
    //=====================================End Profile===============

    //====================================Courses Page================
    public function courses($action = null, $id = null)
    {

        //making sure a user is looged in
        if (!Auth::logged_in()) {
            message("Please login to access the admin section.");
            redirect('login');
        }

        $user_id = Auth::getId(); //logged user id
        $course = new Course(); //intantiate the course model class
        $data = [];
        $data['title'] = "Courses";
        $data['id'] = $id;
        $data['action'] = $action;

        if ($action == 'add') {


            $category = new Category(); //intantiate the category model class

            $data['categories'] = $category->findAll('asc'); //gets and populates all categories

            //to submit inputs to the database. Is executed while adding to the database.
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                if ($course->validate($_POST)) {


                    $_POST['date_created'] = date('Y-m-d H:i:s'); //date
                    $_POST['user_id'] = $user_id; //logged user id

                    $_POST['price_id'] = 1;
                    $course->insert($_POST);

                    //retrieve the last record inserted by this user
                    $row = $course->first(['user_id' => $user_id, 'is_published' => 0]);
                    message("Course is successfully created.");

                    if ($row) { //if the row is not available
                        redirect('admin/courses/edit/' . $row->id);
                    } else {
                        redirect('admin/courses');
                    }
                }
                //display errors if data is not validated.
                $data['errors'] = $course->errors;
            }
        } elseif ($action == 'edit') { //statement to implement the edit

            //get course information
            $data['row'] = $course->first(['user_id' => $user_id, 'id' => $id]); //1 record, course id created by the current user id.



        } else { // courses view display

            //========to read user entered courses from the database
            $data['rows'] = $course->where(['user_id' => $user_id]);

            //show($data['rows']); die;

        }

        //loading the page
        $this->view('admin/courses', $data);
    }
}
