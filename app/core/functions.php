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

function secure_random_string($length){
    //define an empty random string.
    $random_string = '';
    //loop to generate the string.
    for($i = 0; $i<$length; $i++){
        
        $number = random_int(0, 999999); //generates a random integer in the range 0 to 999999.
        //convert the $number from base 10 to base 36.
        $character = base_convert($number, 10, 36);
        $random_string .= $character;    
    }
    //return the generated random value.
    return $random_string;
    
}
