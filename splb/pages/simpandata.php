<?php
// Langkah 1: Pastikan koneksi ke database sudah diatur
include("koneksi.php");

// Langkah 2: Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// Langkah 3: Siapkan array untuk menampung kolom dan nilainya
	$columns = [];
	$values = [];
	$params = [];

	// Langkah 4: Iterasi melalui setiap item POST
	foreach ($_POST as $key => $value) {
		// Cek apakah ini bukan tombol submit
		if ($key != 'simpen') {
			// Escape value menggunakan parameterized query untuk mencegah SQL injection
			$columns[] = "[$key]";  // Nama kolom di SQL Server menggunakan kurung siku

			// Tambahkan nilai ke array values (pakai placeholder untuk prepared statements)
			$values[] = '?';
			$params[] = $value; // Nilai akan dimasukkan ke dalam array params
		}
	}

	// Langkah 5: Susun query INSERT jika ada kolom dan nilai yang valid
	if (count($columns) > 0 && count($values) > 0) {
		$columns_list = implode(", ", $columns);
		$values_list = implode(", ", $values);
		$sql = "INSERT INTO db_brushing.tbl_splb ($columns_list) VALUES ($values_list)";

		// Langkah 6: Eksekusi query menggunakan sqlsrv_query dengan parameter
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