<?php

/*

Will hold all functions required by the app.

*/

function show($stuff){

    echo "<pre>";
    print_r($stuff);
    echo "</pre>";

}

function setValue($key){

    if(!empty($_POST[$key])){
        return $_POST[$key];
    }
    return "";
}