<?php
include("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $columns_tbl1 = [];
    $sql1 = "SELECT COLUMN_NAME 
             FROM INFORMATION_SCHEMA.COLUMNS 
             WHERE TABLE_NAME = 'tbl_splb'";

    $stmt1 = sqlsrv_query($con, $sql1);

    while ($r = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)) {
        if ($r['COLUMN_NAME'] != "ID") {
            $columns_tbl1[] = $r['COLUMN_NAME'];
        }
    }

    $columns_tbl2 = [];
    $sql2 = "SELECT COLUMN_NAME 
             FROM INFORMATION_SCHEMA.COLUMNS 
             WHERE TABLE_NAME = 'tbl_splb2'";

    $stmt2 = sqlsrv_query($con, $sql2);

    while ($r2 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)) {
        if ($r2['COLUMN_NAME'] != "ID_SPLB2" && $r2['COLUMN_NAME'] != "ID_SPLB") {
            $columns_tbl2[] = $r2['COLUMN_NAME'];
        }
    }

    $columns1 = []; $values1 = []; $params1 = [];
    $columns2 = []; $values2 = []; $params2 = [];

    foreach ($_POST as $key => $value) {

        if ($key == "simpen") continue;

        if (in_array($key, $columns_tbl2)) {
            $columns2[] = "[$key]";
            $values2[]  = "?";
            $params2[]  = $value;
        }
        elseif (in_array($key, $columns_tbl1)) {
            $columns1[] = "[$key]";
            $values1[]  = "?";
            $params1[]  = $value;
        }
    }
    if (!empty($columns1)) {

        $sql_insert_1 = "
            INSERT INTO db_brushing.tbl_splb (" . implode(", ", $columns1) . ")
            OUTPUT INSERTED.ID
            VALUES (" . implode(", ", $values1) . ")
        ";

        $stmt_insert_1 = sqlsrv_query($con, $sql_insert_1, $params1);

        if (!$stmt_insert_1) {
            echo "Gagal insert tbl_splb<br>";
            print_r(sqlsrv_errors());
            exit;
        }

        $row_id = sqlsrv_fetch_array($stmt_insert_1, SQLSRV_FETCH_ASSOC);
        $id_splb = $row_id['ID'];
    } 
    else {
        echo "Tidak ada data untuk tbl_splb";
        exit;
    }

    if (!empty($columns2)) {

        // prepend kolom ID_SPLB
        array_unshift($columns2, "[ID_SPLB]");
        array_unshift($values2, "?");
        array_unshift($params2, $id_splb);

        $sql_insert_2 = "INSERT INTO db_brushing.tbl_splb2 (" . implode(", ", $columns2) . ")
            VALUES (" . implode(", ", $values2) . ")
        ";

        $stmt_insert_2 = sqlsrv_query($con, $sql_insert_2, $params2);

        if (!$stmt_insert_2) {
            echo "Gagal insert tbl_splb2<br>";
            print_r(sqlsrv_errors());
            exit;
        }
    } 
    else {
        echo "Tidak ada kolom yang masuk ke tbl_splb2<br>";
    }
	echo "Insert SPLB berhasil<br>";
	echo "<script>
        setTimeout(function() {
            window.location.href = '/index.php';
        }, 3000);
      </script>";
	exit;
}
?>
