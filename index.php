<?php
$dbtype = getenv("DB_TYPE");
$dbhost = getenv("DB_HOST");
$dbport = getenv("DB_PORT");
$dbuser = getenv("DB_USER");
$dbname = getenv("DB_NAME");
$dbpwd = getenv("DB_PASSWORD");;

switch ($dbtype) {

   case "mysql": 
	$connection = mysqli_connect($dbhost.":".$dbport, $dbuser, $dbpwd, $dbname) or die("Error " . mysqli_error($connection));
	$query = "SELECT * from users" or die("Error in the consult.." . mysqli_error($connection));
	echo "Hello All.. Here is the list of users: <br>";
	$rs = $connection->query($query);
	while ($row = mysqli_fetch_assoc($rs)) {
    		echo "User Id: ".$row['user_id'] . " User Name: " . $row['username'] . "<br>";
	}
	echo "End of the list <br>";
	mysqli_close($connection);
        break;

   case "mssql":
	//$connection = mssql_connect($dbhost.":".$dbport, $dbuser, $dbpwd) or die("Could not connect to SQL Server " . mssql_get_last_message());
        //mssql_select_db($dbname, $connection) or die("Could not select database" . mssql_get_last_message());
        //$query = "SELECT * from users";

$serverName = $dbhost.":".$dbport;
	//$serverName = $dbhost;
        $connectionOptions = array(
                "Database" => $dbname,
                "Uid" => $dbuser,
                "PWD" => $dbpwd
        );
        //Establishes the connection
        $conn = sqlsrv_connect($serverName, $connectionOptions);
        if($conn)
                echo "Connected!";        
        $tsql= "SELECT * from users";
        $getResults= sqlsrv_query($conn, $tsql);
	echo ("Reading data from table" . PHP_EOL);
	if ($getResults == FALSE)
    		die(FormatErrors(sqlsrv_errors()));
	while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
    	echo ($row['user_id'] . " " . $row['username'] . PHP_EOL);
	}
	sqlsrv_free_stmt($getResults);	
	break;
}
        
?>
