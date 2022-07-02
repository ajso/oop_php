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
        $data['title'] = "Administrator";
        $this->view('admin/dashboard', $data);
    }


    //this is the profile page
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

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $row) {

            //check if an image exists. before uploading
            //show($_FILES['image']); die;
            $folder = "uploads/images/";
            if (!file_exists($folder)) {

                //if it doesn't exist create one.
                mkdir($folder, 0777, true);
                file_put_contents($folder . "index.php", "<?php //silence"); //adding an index.php to $folder.
                file_put_contents("uploads/index.php", "<?php //silence");
            }


            if ($user->edit_validate($_POST, $id)) { //validate the edited fields before submission

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
                //upload content.
                $user->update($id, $_POST); // save to the DB
                message("Profile Successfully Updated!!");
                redirect('admin/profile/' . $id);
                
            }
        }
         $data['errors'] = $user->errors; //display errors
        $this->view('admin/profile', $data);
       
    }
}
