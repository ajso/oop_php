<?php

/*

Will hold all functions required by the app.

*/

function show($stuff)
{

    echo "<pre>";
    print_r($stuff);
    echo "</pre>";
}

function setValue($key, $default = '')
{

    if (!empty($_POST[$key])) { //first check if its a post
        return $_POST[$key];
    } else 
        if (!empty($default)) {
        return $default;
    }
    return "";
}

//================for select option
function setSelect($key,$value, $default = '')
{

    if (!empty($_POST[$key])) { //first check if its a post

        //compare the value to the item in the post
        if($value == $_POST[$key]){
            return ' selected ';
        }
        
    } else 
        if (!empty($default)) {
            //compare the value to the default value
            if($value == $default){
                return ' selected ';
            }
    }
    return "";
}




function secure_random_string($length)
{
    //define an empty random string.
    $random_string = '';
    //loop to generate the string.
    for ($i = 0; $i < $length; $i++) {

        $number = random_int(0, 999999); //generates a random integer in the range 0 to 999999.
        //convert the $number from base 10 to base 36.
        $character = base_convert($number, 10, 36);
        $random_string .= $character;
    }
    //return the generated random value.
    return $random_string;
}

//function to redirect.
function redirect($link)
{
    header("Location: " . ROOT . "/" . $link);
    die;
}

//function to show a massage to a user.
function message($msg = '', $erase = false)
{
    //check if the message is not empty
    if (!empty($msg)) {

        //save the message in the sessions
        $_SESSION['massage'] = $msg;
    } else {
        if (!empty($_SESSION['massage'])) {

            $msg = $_SESSION['massage'];

            if ($erase) {
                unset($_SESSION['massage']); //remove the msg
            }

            return $msg; //show the msg

        }
    }
    return false;
}


//function to clean the text from '` or "
function esc($str)
{

    return nl2br(htmlspecialchars($str));
}

//function to clean the url, i.e text slugs etc.
function str_to_url($url)
{

    $url = str_replace("'", "", $url);
    $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
    $url = trim($url, "-");
    $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
    $url = strtolower($url);
    $url = preg_replace('~[^-a-z0-9_]+~', '', $url);

    return $url;
}


//function to resize the image
function resize_image($filename, $max_size = 700)
{
    $ext = explode(".", $filename);
    $ext = strtolower(end($ext));

    if (file_exists($filename)) {
        switch ($ext) {

            case 'png':
                $image = imagecreatefrompng($filename);
                break;

            case 'gif':
                $image = imagecreatefromgif($filename);
                break;

            case 'jpg':
            case 'jpeg':
                $image = imagecreatefromjpeg($filename);
                break;

            default:
                $image = imagecreatefromjpeg($filename);
                break;
        }

        $src_w = imagesx($image);
        $src_h = imagesy($image);

        if ($src_w > $src_h) { // if the width is the highest
            $dst_w = $max_size;
            $dst_h = ($src_h / $src_w) * $max_size;
        } else {
            $dst_w = ($src_w / $src_h) * $max_size;
            $dst_h = $max_size;
        }

        $dst_image = imagecreatetruecolor($dst_w, $dst_h); //creates and empty image
        imagecopyresampled($dst_image, $image, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);

        imagedestroy($image);// destroy the original image.

        imagejpeg($dst_image, $filename, 90); //save the image resource.
        switch ($ext) {

            case 'png':
                imagepng($dst_image, $filename);
                break;

            case 'gif':
                imagegif($dst_image, $filename);
                break;

            case 'jpg':
            case 'jpeg':
                imagejpeg($dst_image, $filename, 90);
                break;

            default:
                imagejpeg($dst_image, $filename, 90);
                break;
        }

        imagedestroy($dst_image);
    }


    return $filename;
}

//function to convert the date to a human readable value.
function get_date($date){
    return date("jS M, Y H:i:s a", strtotime($date));
}
