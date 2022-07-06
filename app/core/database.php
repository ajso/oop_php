<?php

/*

Database class

*/
class Database
{

    private function connect()
    {

        //database connection. "mysql:hostname=localhost;dbname="dbname";
        $str = DB_DRIVER . ":hostname=" . DB_HOST . "; dbname=" . DB_NAME;
        return new PDO($str, DB_USER, DB_PASSWORD);

    }

    //prepare the query function. This function will do both read() and write()
    public function query($query, $data = [], $type = 'object')
    {
        //running the connect function.
        $conn = $this->connect();
        
        // show($conn);
        $stmt = $conn->prepare($query);
        
        //var_dump($stmt);
        //if the stmt is true
        if ($stmt) {

            //execute the query. $ceck_stmt will be used to check if the query worked or not.
            $check_stmt = $stmt->execute($data);

            if ($check_stmt) { // if the query is executed, get the results.

                if ($type == 'object') {

                     $type = PDO::FETCH_OBJ; //default reuturn type is an object.
                     
                }else{
                    
                    $type = PDO::FETCH_ASSOC; //array return type
                   
                }
                $result = $stmt->fetchAll($type); //fetch objects. instead of arrays.

                if (is_array($result) && count($result) > 0) { //if something is returned.

                    return $result;
                }
            }
        }

        return false;
    }


    public function create_tables()
    {

        //store the statements

        //users table
        $query = "CREATE TABLE `users` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `firstname` varchar(50) NOT NULL,
            `lastname` varchar(50) NOT NULL,
            `email` varchar(100) NOT NULL,
            `role` varchar(10) NOT NULL,
            `password` varchar(100) NOT NULL,
            `create_date` datetime NOT NULL,
            `bio` text DEFAULT NULL,
            `company` varchar(100) DEFAULT NULL,
            `job` varchar(100) DEFAULT NULL,
            `country` varchar(100) DEFAULT NULL,
            `address` varchar(100) DEFAULT NULL,
            `phone` varchar(20) DEFAULT NULL,
            `img_url` varchar(225) DEFAULT NULL,
            `slug_url` varchar(100) NOT NULL,
            `twitter_link` varchar(225) DEFAULT NULL,
            `linkedin_link` varchar(225) DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `firstname` (`firstname`),
            KEY `lastname` (`lastname`),
            KEY `email` (`email`),
            KEY `slug_url` (`slug_url`)
           ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4";

        // runn the query
        $this->query($query);


        //courses table
        $query = "CREATE TABLE `courses` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `title` varchar(100) NOT NULL,
            `description` text DEFAULT NULL,
            `user_id` int(11) NOT NULL,
            `category_id` int(11) NOT NULL,
            `sub_category_id` int(11) DEFAULT NULL,
            `level_id` int(11) DEFAULT NULL,
            `language_id` int(11) DEFAULT NULL,
            `price_id` int(11) DEFAULT NULL,
            `promo_link` varchar(1024) DEFAULT NULL,
            `welcome_message` varchar(255) DEFAULT NULL,
            `congratulation_message` varchar(255) DEFAULT NULL,
            `primary_subject` varchar(100) DEFAULT NULL,
            `course_promo_video` varchar(1024) DEFAULT NULL,
            `course_image` varchar(1024) DEFAULT NULL,
            `tags` varchar(255) DEFAULT NULL,
            `date_created` datetime NOT NULL,
            PRIMARY KEY (`id`),
            KEY `title` (`title`),
            KEY `user_id` (`user_id`),
            KEY `category_id` (`category_id`),
            KEY `sub_category_id` (`sub_category_id`),
            KEY `level_id` (`level_id`),
            KEY `primary_subject` (`primary_subject`),
            KEY `date_created` (`date_created`)
           ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
           ";

        // runn the query
        $this->query($query);
    }
}
