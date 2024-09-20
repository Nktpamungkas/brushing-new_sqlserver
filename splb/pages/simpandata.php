<?php
include("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$columns = [];
	$values = [];
	$params = [];

	foreach ($_POST as $key => $value) {
		if ($key != 'simpen') {
			$columns[] = "[$key]";  // Nama kolom di SQL Server menggunakan kurung siku

			$values[] = '?';
			$params[] = $value; // Nilai akan dimasukkan ke dalam array params
		}
	}

	if (count($columns) > 0 && count($values) > 0) {
		$columns_list = implode(", ", $columns);
		$values_list = implode(", ", $values);
		$sql = "INSERT INTO db_brushing.tbl_splb ($columns_list) VALUES ($values_list)";

		$stmt = sqlsrv_query($con, $sql, $params);

		if ($stmt) {
			echo "Data berhasil disimpan";
		} else {
			// Menangani dan menampilkan error lebih detail
			if (($errors = sqlsrv_errors()) != null) {
				foreach ($errors as $error) {
					echo "SQLSTATE: " . $error['SQLSTATE'] . "<br />";
					echo "Code: " . $error['code'] . "<br />";
					echo "Message: " . $error['message'] . "<br />";
				}
			}
		}
	} else {
		echo "Tidak ada data valid yang dimasukkan.";
	}
}
?>