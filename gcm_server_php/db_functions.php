<?php

class DB_Functions {

    private $db;

    //put your code here
    // constructor
    function __construct() {
        include_once './db_connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->db->connect();
    }

    // destructor
    function __destruct() {
        
    }

    /**
     * Storing new user
     * returns user details
     */
    public function storeUser($numprofesor, $dni, $regid) {
        // insert user into database
        $result = mysql_query("INSERT INTO profesores(numprofesor, dni, regid, fecha_alta) 
		VALUES('$numprofesor', '$dni', '$regid', NOW())");
        // check for successful store
        if ($result) {
            // get user details
            $id = mysql_insert_id(); // last inserted id
            $result = mysql_query("SELECT * FROM profesores WHERE id = $id") or die(mysql_error());
            // return user details
            if (mysql_num_rows($result) > 0) {
                return mysql_fetch_array($result);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    /**
     * Storing new user
     * returns user details
     */
    public function updateUser($numprofesor, $dni, $regid) {
        // insert user into database
        $result = mysql_query("SELECT count(*) FROM profesores WHERE dni='$dni'");
		
		$num_rows = mysql_num_rows($result);
        file_put_contents("E:\ko1", $num_rows);

		// check for successful store
        if ($num_rows==0) {
			return false;
		}
		else{
			mysql_query("UPDATE profesores SET regid = '$regid' WHERE dni='$dni'") or die(mysql_error());
             if(mysql_affected_rows()>0)
				return true;
			else 
				return false;
		}
    }


    /**
     * Get user by email and password
     */
    public function getUserByEmail($email) {
        $result = mysql_query("SELECT * FROM profesores WHERE email = '$email' LIMIT 1");
        return $result;
    }
    public function getUserByRegId($id) {
        $result = mysql_query("SELECT regid FROM profesores		WHERE id = '$id'");
		$row = mysql_fetch_assoc($result);
        return $row['gcm_regid'];
    }

    public function downUser($dni) {
        mysql_query("UPDATE profesores SET regid='vacio' WHERE dni ='$dni'");
		if(mysql_affected_rows()>0)
				return true;
			else 
				return false;
    }

    /**
     * Getting all users
     */
    public function getAllUsers() {
        $result = mysql_query("select * FROM profesores");
        return $result;
    }

    /**
     * Check user is existed or not
     */
    public function isUserExisted($email) {
        $result = mysql_query("SELECT email from profesores WHERE email = '$email'");
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            // user existed
            return true;
        } else {
            // user not existed
            return false;
        }
    }

}

?>