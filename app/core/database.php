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
        $query = "CREATE TABLE IF NOT EXISTS `users` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(255) NOT NULL,
            `email` int(100) NOT NULL,
            `password` int(100) NOT NULL,
            PRIMARY KEY (`id`),
            KEY `name` (`name`),
            KEY `email` (`email`)
           ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ";

        // runn the query
        $this->query($query);
    }
}
