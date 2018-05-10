<?php
 $dbtype = 'mssql';//getenv("DB_TYPE");


 /*[‎10-‎05-‎2018 17:49] Debasish Deo: 
$DB_HOST        = "10.244.17.144";          // Database Host Server
//$DB_HOST      = "10.244.2.2";         // Database Host Server
$DB_USERNAME        = "sa";             // Database Username 
$DB_PASSWORD        = 'adminw2ksql';        // Password for the Db User
//$DB_PASSWORD      = 'gatekeeper';         // Password for the Db User
$DB_NAME        = "Confer_billing";     // Database1 name 
*/
$dbhost = '10.244.17.144';//getenv("DB_HOST");
$dbport = '1433';//getenv("DB_PORT");
$dbuser = 'sa';//getenv("DB_USER");
$dbname = 'Confer_billing';//getenv("DB_NAME");
$dbpwd = 'adminw2ksql';//getenv("DB_PASSWORD");;

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
   try{
    $this->db = new PDO ("dblib:host=$this->hostname:$this->port;dbname=$this->dbname", "$this->username", "$this->pwd");
   echo "In side MSSQL";
        } catch (PDOException $e) {
	echo "Failed to get DB handle: " . $e->getMessage(); 
            $this->logsys .= "Failed to get DB handle: " . $e->getMessage() . "\n";}
exit;

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
	if ($getResults == FALSE){
	die(FormatErrors(sqlsrv_errors()));}
	else{
	echo "Hello All.. Here is the list of users: <br>";
	while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
    		echo "User Id: ".$row['user_id'] . " User Name: " . $row['username'] . "<br>";
	}
	}
	sqlsrv_free_stmt($getResults);	
	break;
}
        
?>
