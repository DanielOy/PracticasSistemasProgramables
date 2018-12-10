<?php
$host="localhost";
$port=3306;
$socket="";
$user="root";
$password="";
$dbname="arduino";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());
if (mysqli_get_connection_stats($con)){
    //echo "Conexion establecida";
}else
{
    echo"Error de conexion";
}

?>
