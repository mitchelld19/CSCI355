<?php
class Database 
{
	private static $dbName = 'my_mitchelld19' ;
	    private static $dbHost = 'daytona.birdnest.org' ;
	    private static $dbUsername = 'my.mitchelld19';
	    private static $dbUserPassword = 'winthropgurl4life';
		private static $cont;
	
	public function __construct() {
		exit('Init function is not allowed');
	}
	
	public static function connect()
	{
	   // One connection through whole application
       if ( null == self::$cont )
       {      
        try 
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);  
        }
        catch(PDOException $e) 
        {
          die($e->getMessage());  
        }
       } 
       return self::$cont;
	}
	
	public static function disconnect()
	{
		self::$cont = null;
	}
}
?>