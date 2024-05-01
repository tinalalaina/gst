<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
header("Access-Control-Allow-Origin:* ");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
$db_conn= mysqli_connect("localhost","root", "", "reactphp");
if($db_conn===false)
{
  die("ERROR: Could Not Connect".mysqli_connect_error());
}

// Récupérer les données depuis la base de données
//$result= mysqli_query($db_conn, "SELECT label, value FROM data_table");

$result= mysqli_query($db_conn, "SELECT ptitle, pstock FROM tbl_product");
$data = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    echo "0 results";
}


// Retourner les données au format JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
