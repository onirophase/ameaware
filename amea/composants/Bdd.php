<?php
define("SALT", "fdqkdghçà_çàosdf456456+sflyu_çuioàze,klmeth,klmaer!/kh456(" );
class Bdd 
{
	
// 	CREATE TABLE  `client` (
// 			`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
// 			`nom` VARCHAR( 100 ) NOT NULL ,
// 			`email` VARCHAR( 100 ) NOT NULL ,
// 			`mobile` VARCHAR( 100 ) NOT NULL
// 			) ENGINE = INNODB;
	
	
// 	private static $instance = 'crud_tutorial' ; 
// 	private static $serveur = 'localhost' ;
// 	private static $login = 'root';
// 	private static $pass = 'mysql07';
	
// 	private static $instance = 'AMATT2524_test';
// 	private static $serveur = 'localhost' ;
// 	private static $login = 'AMATT2524';
// 	private static $pass = '27u65w21';
	
	private static $instance = 'amea';
	private static $serveur = 'localhost' ;
	private static $login = 'root';
	private static $pass = 'root';
	
	
	private static $cont  = null;
	
	public function __construct() {
		exit('Init function is not allowed');
	}
	
	public static function connecter()
	{
	   // One connection through whole application
       if ( null == self::$cont )
       {      
        try 
        {
          self::$cont =  new PDO( "mysql:host=".self::$serveur.";"."dbname=".self::$instance, self::$login, self::$pass);  
        }
        catch(PDOException $e) 
        {
          die($e->getMessage());  
        }
       } 
       return self::$cont;
	}
	
	public static function deconnecter()
	{
		self::$cont = null;
	}
}
?>