<?php
//The main model class
//This will contain functions that are common
class Model extends Database{

    protected $table = "";

    //function to insert anything into the database.
    public function insert($data){

            //remove unwanted columns
            if(!empty($this->allowedColumns)){

                foreach($data as $key => $value){

                    if(!in_array($key, $this->allowedColumns)){ //if the key is not in the allowed arrays.
                        unset($data[$key]); //remove that key
                    }

                }
            }
            //show($data);
            //if all removed constructa query.
            $keys = array_keys($data); //returns only the keys of the input
            
            $query = "INSERT INTO " . $this->table;
            $query .= "(".implode(",", $keys).") VALUES (:".implode(",:", $keys).")"; //i.e :firstname,:lastname etc
            $this->query($query, $data); //inserts into the database.

        }

        //Where clause function.
        //$query = "SELECT *FROM users WHERE email=:email && id=:id LIMIT 1";
        public function where($data, $order='desc'){

            $keys = array_keys($data);
            $query = "SELECT *FROM ".$this->table ." WHERE ";
            foreach ($keys as $key) {
                $query .= $key . "=:" . $key . " && ";
            }

            $query = trim($query, "&& "); //removes the extra && and space.
            $query .= " order by id $order"; //adding to the query
            $res = $this->query($query, $data); //selects from the database with the where clause.
            if(is_array($res)){

                //implementting/ run the after select functions
                if(property_exists($this, 'afterSelect')){

                    foreach ($this->afterSelect as $func) { //values are the functions.
                        # run the function.
                        $res = $this->$func($res); 
                    }
                }

                return $res;
            }
            return false;

        }

        //function to return only one item.
        public function first($data, $order='desc'){

            $keys = array_keys($data);
            $query = "SELECT *FROM ".$this->table ." WHERE ";
            foreach ($keys as $key) {
                $query .= $key . "=:" . $key . " && ";
            }

            $query = trim($query, "&& "); //removes the extra && and space.
            $query .= " ORDER BY id $order LIMIT 1"; //Add to the query
            $res = $this->query($query, $data); //selects from the database with the where clause.
            if(is_array($res)){

                
                //implementting/ run the after select functions
                if(property_exists($this, 'afterSelect')){

                    foreach ($this->afterSelect as $func) { //values are the functions.
                        # run the function.
                        $res = $this->$func($res); 
                    }
                }
                return $res[0]; //RETURN THE FIRST ITEM
            }
            return false;

        }


        //function to update database records.
        public function update($id, $data){

            //remove unwanted columns
            if(!empty($this->allowedColumns)){

                foreach($data as $key => $value){

                    if(!in_array($key, $this->allowedColumns)){ //if the key is not in the allowed arrays.
                        unset($data[$key]); //remove that key
                    }

                }
            }
            //show($data);
            //if all removed constructa query.
            $keys = array_keys($data); //returns only the keys of the input
            
            $query = "UPDATE " .$this->table." SET ";
            foreach ($keys as $key) {
                $query .= $key. "=:".$key.",";
            }
            $query = trim($query, ","); //removing the ',' at the end of the query.
            $query .= " WHERE id=:id";
            $data['id'] = $id;

            // show($query);
            // show($data); die;
            $this->query($query, $data); //inserts into the database.

        }


        // Function to select all from the database.
        public function findAll($order='desc'){

            $query = "SELECT *FROM ".$this->table ." ORDER BY id $order ";
            
            $res = $this->query($query); //selects all from the database.
            if(is_array($res)){

                //implementting/ run the after select functions
                if(property_exists($this, 'afterSelect')){

                    foreach ($this->afterSelect as $func) { //values are the functions.
                        # run the function.
                        $res = $this->$func($res); 
                    }
                }
                
                return $res;
            }
            return false;

        }
}