<?php
/*

404, page not found page.

*/
class _404 extends Controller{

    //this is the home page
    public function index(){
        // echo "Home Page";
        $data['title'] = "404 Page Not found.";
        $this->view('404', $data);
    }
}