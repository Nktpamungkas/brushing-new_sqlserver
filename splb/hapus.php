<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");

if (isset($_POST['id'])) {
    $sql = "DELETE FROM db_brushing.tbl_splb WHERE ID = ?";
    $params = array($_POST['id']);
    $stmt = sqlsrv_query($con, $sql, $params);

    if ($stmt) {
        $data = array(
            'kode' => 200,
            'message' => 'Record deleted successfully'
        );
    } else {
        $errors = sqlsrv_errors();
        $data = array(
            'kode' => 404,
            'message' => 'Error deleting record',
            'error' => $errors
        );
    }
} else {
    $data = array(
        'kode' => 400,
        'message' => 'ID is missing'
    );
}

echo json_encode($data);

?>