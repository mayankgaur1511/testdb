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

        $serverName = $dbhost.",".$dbport;
        
        $connectionOptions = array(
                "Database" => $dbname,
                "Uid" => $dbuser,
                "PWD" => $dbpwd 
        );
        //Establishes the connection
        $conn = sqlsrv_connect($serverName, $connectionOptions);
        if($conn) {
                echo "Connected! <br>"; }
        else {
          echo "Connection could not be established.<br />";
         die( print_r( sqlsrv_errors(), true));
        }       
        $tsql= "SELECT * from users";
        $getResults= sqlsrv_query($conn, $tsql);
	if ($getResults == FALSE)
    		die(FormatErrors(sqlsrv_errors()));
	echo "Hello All.. Here is the list of users: <br>";
	while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
    		echo "User Id: ".$row['user_id'] . " User Name: " . $row['username'] . "<br>";
	}
	sqlsrv_free_stmt($getResults);	
	break;
}
        
?>
