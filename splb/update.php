<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
if (isset($_POST['pk'])) {
    $name = $_POST['name'];
    $value = $_POST['value'];
    $pk = $_POST['pk'];

    if (!empty($name) && !empty($value) && !empty($pk)) {
        $query = "UPDATE db_brushing.tbl_splb SET [$name] = ? WHERE ID = ?";
        $params = array($value, $pk);
        $stmt = sqlsrv_prepare($con, $query, $params);

        if ($stmt && sqlsrv_execute($stmt)) {
            $data = array('kode' => 200); // Berhasil
        } else {
            $data = array('kode' => 404); // Gagal
        }
    } else {
        $data = array('kode' => 400, 'message' => 'Invalid input');
    }
} else {
    $data = array('kode' => 400, 'message' => 'No primary key provided');
}

header('Content-Type: application/json');
echo json_encode($data);
?>