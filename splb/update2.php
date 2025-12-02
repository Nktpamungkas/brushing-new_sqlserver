<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");

header('Content-Type: application/json');

if (isset($_POST['pk'])) {

    $name  = $_POST['name'];
    $value = $_POST['value'];
    $pk    = $_POST['pk'];

    if (!empty($name) && !empty($pk)) {
        $cekQuery  = "SELECT COUNT(*) AS JML FROM db_brushing.tbl_splb2 WHERE ID_SPLB = ?";
        $cekParams = array($pk);
        $cekStmt   = sqlsrv_query($con, $cekQuery, $cekParams);
        $cekRow    = sqlsrv_fetch_array($cekStmt, SQLSRV_FETCH_ASSOC);

        $jml = $cekRow['JML'];
        if ($jml > 0) {
            $query  = "UPDATE db_brushing.tbl_splb2 SET [$name] = ? WHERE ID_SPLB = ?";
            $params = array($value, $pk);

            $stmt = sqlsrv_prepare($con, $query, $params);

            if ($stmt && sqlsrv_execute($stmt)) {
                $data = array('kode' => 200); // Update sukses
            } else {
                $data = array('kode' => 404); // Update gagal
            }
        }
        else {
            $query  = "INSERT INTO db_brushing.tbl_splb2 (ID_SPLB, [$name]) VALUES (?, ?)";
            $params = array($pk, $value);

            $stmt = sqlsrv_prepare($con, $query, $params);

            if ($stmt && sqlsrv_execute($stmt)) {
                $data = array('kode' => 201); // Insert sukses
            } else {
                $data = array('kode' => 404); // Insert gagal
            }
        }

    } else {
        $data = array('kode' => 400, 'message' => 'Invalid input');
    }

} else {
    $data = array('kode' => 400, 'message' => 'No primary key provided');
}
echo json_encode($data);
exit;
?>
