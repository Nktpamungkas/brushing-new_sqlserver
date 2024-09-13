<?php
// $host="10.0.0.174";
// $username="ditprogram";
// $password="Xou@RUnivV!6";
// $db_name="TM";
// $connInfo = array( "Database"=>$db_name, "UID"=>$username, "PWD"=>$password);
// $conn     = sqlsrv_connect( $host, $connInfo);
// $con=mysqli_connect("10.0.0.10","dit","4dm1n","db_brushing");
// $con=mysqli_connect("localhost","root","","db_brushing");

$hostname="10.0.0.21";
// $database = "NOWTEST"; // SERVER NOW 20
$database = "NOWPRD"; // SERVER NOW 22
$user = "db2admin";
$passworddb2 = "Sunkam@24809";
$port="25000";
$conn_string = "DRIVER={IBM ODBC DB2 DRIVER}; HOSTNAME=$hostname; PORT=$port; PROTOCOL=TCPIP; UID=$user; PWD=$passworddb2; DATABASE=$database;";
$conn_db2 = db2_connect($conn_string,'', '');

$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri_segments = explode('/', $uri_path);
if ($uri_segments[2] == "index.php") {
    if ($_SESSION['Brs_Uname']) {
        header("Location: /brushing-new/home.php");
    }
} else {
    if (empty($_SESSION['Brs_Uname'])) {
        header("Location: /brushing-new_sqlserver/index.php");
    } else {
        if ((time() - $_SESSION['last_login_timestamp']) > 3600) {
            header("location: /brushing-new_sqlserver/logout.php");
        } else {
            $_SESSION['last_login_timestamp'] = time();
        }
    }
}


$hostSVR19 = "10.0.0.221";
$usernameSVR19 = "sa";
$passwordSVR19 = "Ind@taichen2024";
$brushing = "db_brushing";

$db_brushing = array("Database" => $brushing, "UID" => $usernameSVR19, "PWD" => $passwordSVR19);

$con = sqlsrv_connect($hostSVR19, $db_brushing);

if ($con) {
} else {
    exit("SQLSVR19 Connection failed");
}