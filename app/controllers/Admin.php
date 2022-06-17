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
        $uid = $id ?? Auth::getId();
        $user = new User();
        $data['row'] =$row= $user->first(['id' => $uid]); //return the required user 

        if($_SERVER['REQUEST_METHOD'] == 'POST' && $row){

            $user->update($uid, $_POST);
            redirect('admin/profile/'. $uid);
        }
        $this->view('admin/profile', $data);
    }
}
