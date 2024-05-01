<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

$db_conn = mysqli_connect("localhost", "root", "", "reactphp");
if ($db_conn === false) {
    die("ERROR: Could Not Connect" . mysqli_connect_error());
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "GET":
        $path = explode('/', $_SERVER['REQUEST_URI']);

        if (isset($path[4]) && is_numeric($path[4])) {
            $json_array = array();
            $userid = $path[4];
            $getuserrow = mysqli_query($db_conn, "SELECT * FROM tbl_product WHERE p_id='$userid' ");







            

            
            $userrow = mysqli_fetch_assoc($getuserrow);
            if ($userrow) {
                echo json_encode($userrow);
            } else {
                echo json_encode(["error" => "Product not found"]);
            }
        } else {//echo "return all Data"; die;
          $destination= $_SERVER['DOCUMENT_ROOT']."/reactcrudphp"."/";
          $allproduct= mysqli_query($db_conn, "SELECT * FROM tbl_product");
          if(mysqli_num_rows($allproduct) > 0)
          {
             while($row= mysqli_fetch_array($allproduct))
             {
              $json_array["productdata"][]= array("id"=>$row['p_id'], 
              "ptitle"=>$row["ptitle"],
              "pprice"=>$row["pprice"],
              "pimage"=>$row["pfile"],
              "status"=>$row["pstatus"]
             );
             }
             echo json_encode($json_array["productdata"]);
             return;
          } else {
           echo json_encode(["result"=>"please check the Data"]);
           return;
          }
        }
        break;

    case "POST":
        $ptitle = $_POST['ptitle'] ?? '';
        $pprice = $_POST['pprice'] ?? '';
        $pstatus = $_POST['pstatus'] ?? '';
        $pfile = '';

        if (isset($_FILES['pfile'])) {
            $pfile_name = $_FILES['pfile']['name'];
            $pfile_tmp = $_FILES['pfile']['tmp_name'];
            $destination = $_SERVER['DOCUMENT_ROOT'] . '/reactcrudphp/images/' . $pfile_name;
            if (move_uploaded_file($pfile_tmp, $destination)) {
                $pfile = $pfile_name;
            } else {
                echo json_encode(["error" => "Failed to move uploaded file"]);
                return;
            }
        }

        $result = mysqli_query($db_conn, "INSERT INTO tbl_product (ptitle, pprice, pfile, pstatus)
        VALUES('$ptitle','$pprice','$pfile','$pstatus')");

        if ($result) {
            echo json_encode(["success" => "Product Inserted Successfully"]);
        } else {
            echo json_encode(["error" => "Product Not Inserted"]);
        }
        break;

    case "DELETE":
        $path = explode('/', $_SERVER['REQUEST_URI']);
        $product_id = $path[4] ?? null;

        if ($product_id && is_numeric($product_id)) {
            $result = mysqli_query($db_conn, "DELETE FROM tbl_product WHERE p_id='$product_id'");
            if ($result) {
                echo json_encode(["success" => "Product Deleted Successfully"]);
            } else {
                echo json_encode(["error" => "Failed to delete product"]);
            }
        } else {
            echo json_encode(["error" => "Invalid product ID"]);
        }
        break;

    default:
        echo json_encode(["error" => "Invalid HTTP Method"]);
}
?>