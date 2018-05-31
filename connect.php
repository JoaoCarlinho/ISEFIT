<?php
$conn_error = 'Could not connect';

function connect(){
    
$host = 'theho014.mysql.guardedhost.com';
$user = 'theho014_JoaoTC';
$password = 'g3t$MONEY16uk';
$database='theho014_iseFit';

	try{
		$db = new PDO('mysql:host='.$host.';dbname='.$database.';charset=utf8', $user, $password);
		// set the PDO error mode to exception
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		return $db;
	}
	catch(PDOException $e)
	{
		echo "Connection failed: " . $e->getMessage();
	}
}

?>