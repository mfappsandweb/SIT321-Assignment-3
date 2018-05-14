<?php

	class Database{
	//a shared database connection
    const USER = "";
    const PASS = "";
    const DB = "SSID";
	
    private static $instance; // single static instance

    private function __construct() {
		$instance = oci_pconnect(self::ORACLE_USER, self::ORACLE_PASS, self::ORACLE_DB); 		} 

    private function __clone() { } // block cloning of the object
    

    public static function getConnection()
    {
        // create the instance if it does not exist
        if(!isset(self::$instance))
        { 			
			$instance = oci_pconnect(self::USER, self::PASS, self::DB); 
	
        }
        // return the connection
        return $instance;
    }
}
?>