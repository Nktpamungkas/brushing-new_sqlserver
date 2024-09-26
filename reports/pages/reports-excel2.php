<?php
// header("Content-type: application/octet-stream");
// header("Content-Disposition: attachment; filename=report-produksi-".date($_GET['tglawal']).".xls");//ganti nama sesuai keperluan
// header("Pragma: no-cache");
// header("Expires: 0");
//disini script laporan anda
?>
<?php
// $con=mysqli_connect("10.0.0.10","dit","4dm1n","db_brushing");
// $con=mysqli_connect("localhost","root","","db_brushing");
include("../../koneksi.php");
ini_set("error_reporting", 1);
?>

<body>
    <?php

  $tglawal = $_GET['tglawal'];
  $tglakhir = $_GET['tglakhir'];
  $shft = $_GET['shift'];
  $nmesin = $_GET['mesin'];
  $mc = $_GET['no_mesin'];
  if ($tglakhir != "" and $tglawal != "") {
    $tgl = " DATE_FORMAT(a.`tgl_update`,'%Y-%m-%d') BETWEEN '$tglawal' AND '$tglakhir' ";
  } else {
    $tgl = " ";
  }
  if ($shft == "ALL") {
    $shift = " ";
  } else {
    $shift = " AND a.shift ='$shft' ";
  }
  if ($nmesin != "") {
    $mesin = " AND a.nama_mesin ='$nmesin'";
  } else {
    $mesin = " ";
  }
  if ($mc != "ALL") {
    $nomesin = " AND a.no_mesin ='$mc'";
  } else if ($mc == "ALL") {
    $nomesin = " ";
  } else {
    $nomesin = " ";
  }
  ?>
    <strong>Periode: <?php echo $tglawal; ?> s/d <?php echo $tglakhir; ?></strong><br>
    <strong>Shift: <?php echo $shft; ?> <br>
        Mesin: <?php echo $nmesin; ?> <br>
        No. Mesin: <?php echo $mc; ?></strong><br />
    <table width="100%" border="1">
        <tr>
            <th rowspan="2" bgcolor="#99FF99">NO.</th>
            <th rowspan="2" bgcolor="#99FF99">SHIFT</th>
            <th rowspan="2" bgcolor="#99FF99">NO MESIN</th>
            <th rowspan="2" bgcolor="#99FF99">LANGGANAN</th>
            <th rowspan="2" bgcolor="#99FF99">BUYER</th>
            <th rowspan="2" bgcolor="#99FF99">NO ORDER</th>
            <th rowspan="2" bgcolor="#99FF99">JENIS KAIN</th>
            <th rowspan="2" bgcolor="#99FF99">WARNA</th>
            <th rowspan="2" bgcolor="#99FF99">LOT</th>
            <th rowspan="2" bgcolor="#99FF99">ROLL</th>
            <th rowspan="2" bgcolor="#99FF99">QTY</th>
            <th rowspan="2" bgcolor="#99FF99">PROSES</th>
            <th rowspan="2" bgcolor="#99FF99">KETERANGAN</th>
            <th colspan="4" bgcolor="#99FF99">JAM PROSES</th>
            <th rowspan="2" bgcolor="#99FF99">LAMA PROSES</th>
            <th colspan="4" bgcolor="#99FF99">STOP MESIN 1</th>
            <th rowspan="2" bgcolor="#99FF99">LAMA STOP 1</th>
            <th colspan="4" bgcolor="#99FF99">STOP MESIN 2</th>
            <th rowspan="2" bgcolor="#99FF99">LAMA STOP 2</th>
            <th colspan="4" bgcolor="#99FF99">STOP MESIN 3</th>
            <th rowspan="2" bgcolor="#99FF99">LAMA STOP 3</th>
            <th rowspan="2" bgcolor="#99FF99">KODE STOP 1</th>
            <th rowspan="2" bgcolor="#99FF99">KODE STOP 2</th>
            <th rowspan="2" bgcolor="#99FF99">KODE STOP 3</th>
            <th rowspan="2" bgcolor="#99FF99">OPERATOR</th>
            <th rowspan="2" bgcolor="#99FF99">NO GEROBAK</th>
            <th rowspan="2" bgcolor="#99FF99">JENIS KARTU</th>
            <th rowspan="2" bgcolor="#99FF99">JUMLAH GEROBAK</th>
        </tr>
        <tr>
            <th bgcolor="#99FF99">TGL</th>
            <th bgcolor="#99FF99">IN</th>
            <th bgcolor="#99FF99">TGL</th>
            <th bgcolor="#99FF99">OUT</th>
            <th bgcolor="#99FF99">TGL</th>
            <th bgcolor="#99FF99">JAM</th>
            <th bgcolor="#99FF99">TGL</th>
            <th bgcolor="#99FF99">S/D</th>
            <th bgcolor="#99FF99">TGL</th>
            <th bgcolor="#99FF99">JAM</th>
            <th bgcolor="#99FF99">TGL</th>
            <th bgcolor="#99FF99">S/D</th>
            <th bgcolor="#99FF99">TGL</th>
            <th bgcolor="#99FF99">JAM</th>
            <th bgcolor="#99FF99">TGL</th>
            <th bgcolor="#99FF99">S/D</th>
        </tr>
        <?php

    $sql = sqlsrv_query($con, " SELECT 
	a.*
FROM
	db_brushing.tbl_produksi a
	
WHERE
	" . $tgl . $shift . $mesin . $nomesin . " ORDER BY a.no_mesin ASC");

    $no = 1;
    $totrol = 0;
    $totberat = 0;
    $c = 0;
    while ($rowd = sqlsrv_fetch_array($sql)) {
      ?>
        <tr valign="top">
            <td><?php echo $no; ?></td>
            <td><?php echo $rowd['shift']; ?></td>
            <td>'<?php echo $rowd['no_mesin']; ?></td>
            <td>
                <?php $pos = strpos($rowd['langganan'], "/");
          if ($pos > 0) {
            $pos1 = $pos;
            echo $result = substr($rowd['langganan'], 0, $pos1);
          } else {
            echo $rowd['langganan'];
          }
          ?>
            </td>
            <td>
                <?php $pos = strpos($rowd['langganan'], "/");
          if ($pos > 0) {
            $pos1 = $pos + 1;
            echo $result1 = substr($rowd['langganan'], $pos1);
          }
          ?>
            </td>
            <td><?php echo $rowd['no_order']; ?></td>
            <td><?php echo $rowd['jenis_kain']; ?></td>
            <td><?php echo $rowd['warna']; ?></td>
            <td>'<?php echo $rowd['lot']; ?></td>
            <td><?php echo $rowd['rol']; ?></td>
            <td><?php echo $rowd['qty']; ?></td>
            <td><?php echo $rowd['proses']; ?></td>
            <td><?php echo $rowd['ket']; ?></td>
            <td><?php if ($rowd['jam_in'] != "") {
          echo $rowd['tgl_proses_in'];
        } ?></td>
            <td><?php echo $rowd['jam_in']; ?></td>
            <td><?php if ($rowd['jam_out'] != "") {
          echo $rowd['tgl_proses_out'];
        } ?></td>
            <td><?php echo $rowd['jam_out']; ?></td>
            <td><?php
        date_default_timezone_set('Asia/Jakarta');
        $time3 = strtotime(cek($rowd['tgl_proses_in'], 'Y-m-d') . " " . $rowd['jam_in']);
        $time4 = strtotime(cek($rowd['tgl_proses_out'], 'Y-m-d') . " " . $rowd['jam_out']);
        $diff1 = $time4 - $time3;

        $jam1 = floor($diff1 / (60 * 60));
        $menit1 = $diff1 - $jam1 * (60 * 60);
        echo $jam1 . ' jam ' . floor($menit1 / 60) . ' menit';
        ?></td>
            <td><?php if ($rowd['stop_l'] != "") {
          echo $rowd['tgl_stop_l'];
        } ?></td>
            <td><?php echo $rowd['stop_l']; ?></td>
            <td><?php if ($rowd['stop_r'] != "") {
          echo $rowd['tgl_stop_r'];
        } ?></td>
            <td><?php if ($rowd['stop_r'] != "") {
          echo $rowd['stop_r'];
        } ?></td>
            <td><?php
        date_default_timezone_set('Asia/Jakarta');
        $time1 = strtotime(cek($rowd['tgl_stop_l'], 'Y-m-d') . " " . $rowd['stop_l']);
        $time2 = strtotime(cek($rowd['tgl_stop_r'], 'Y-m-d') . " " . $rowd['stop_r']);
        $diff_1 = $time2 - $time1;

        $jam = floor($diff / (60 * 60));
        $menit = $diff - $jam * (60 * 60);
        echo $jam . ' jam ' . floor($menit / 60) . ' menit';
        ?></td>

            <td><?php if ($rowd['stop_2'] != "") {
          echo $rowd['tgl_stop_2'];
        } ?></td>
            <td><?php echo $rowd['stop_2']; ?></td>
            <td><?php if ($rowd['stop_r_2'] != "") {
          echo $rowd['tgl_stop_r_2'];
        } ?></td>
            <td><?php if ($rowd['stop_r_2'] != "") {
          echo $rowd['stop_r_2'];
        } ?></td>
            <td><?php
        date_default_timezone_set('Asia/Jakarta');
        $time1 = strtotime(cek($rowd['tgl_stop_2'], 'Y-m-d') . " " . $rowd['stop_2']);
        $time2 = strtotime(cek($rowd['tgl_stop_r_2'], 'Y-m-d') . " " . $rowd['stop_r_2']);
        $diff = $time2 - $time1;

        $jam = floor($diff / (60 * 60));
        $menit = $diff - $jam * (60 * 60);
        echo $jam . ' jam ' . floor($menit / 60) . ' menit';
        ?></td>

            <td><?php if ($rowd['stop_3'] != "") {
          echo $rowd['tgl_stop_3'];
        } ?></td>
            <td><?php echo $rowd['stop_3']; ?></td>
            <td><?php if ($rowd['stop_r_3'] != "") {
          echo $rowd['tgl_stop_r_3'];
        } ?></td>
            <td><?php if ($rowd['stop_r_3'] != "") {
          echo $rowd['stop_r_3'];
        } ?></td>
            <td><?php
        date_default_timezone_set('Asia/Jakarta');
        $time1 = strtotime(cek($rowd['tgl_stop_3'], 'Y-m-d') . " " . $rowd['stop_3']);
        $time2 = strtotime(cek($rowd['tdatetime: gl_stop_r_3'], 'Y-m-d') . " " . $rowd['stop_r_3']);
        $diff = $time2 - $time1;

        $jam = floor($diff / (60 * 60));
        $menit = $diff - $jam * (60 * 60);
        echo $jam . ' jam ' . floor($menit / 60) . ' menit';
        ?></td>

            <td><?php echo $rowd['kd_stop']; ?></td>
            <td><?php echo $rowd['kd_stop2']; ?></td>
            <td><?php echo $rowd['kd_stop3']; ?></td>
            <td><?php echo $rowd['acc_staff']; ?></td>
            <td><?php echo $rowd['no_gerobak']; ?></td>
            <td><?php echo $rowd['jenis_kartu']; ?></td>
            <td><?php echo $rowd['jumlah_gerobak']; ?></td>
        </tr>


        <?php
      $totrol += $rowd['rol'];
      $totberat += $rowd['qty'];
      $no++;
    } ?>
        <tr>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
        </tr>
        <tr>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">Total</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99"><?php echo $totrol; ?></td>
            <td bgcolor="#99FF99"><?php echo $totberat; ?></td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
            <td bgcolor="#99FF99">&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>

        </tr>
        <tr>
            <th colspan="3">&nbsp;</th>
            <th colspan="7">DIBUAT OLEH:</th>
            <th colspan="3">DIPERIKSA OLEH:</th>
            <th colspan="27">DIKETAHUI OLEH:</th>
        </tr>
        <tr>
            <td colspan="3">NAMA</td>
            <td colspan="7">&nbsp;</td>
            <td colspan="3">&nbsp;</td>
            <td colspan="27">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3">JABATAN</td>
            <td colspan="7">&nbsp;</td>
            <td colspan="3">&nbsp;</td>
            <td colspan="27">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3">TANGGAL</td>
            <td colspan="7">&nbsp;</td>
            <td colspan="3">&nbsp;</td>
            <td colspan="27">&nbsp;</td>
        </tr>
        <tr>
            <td height="60" colspan="3" valign="top">TANDA TANGAN</td>
            <td colspan="7">&nbsp;</td>
            <td colspan="3">&nbsp;</td>
            <td colspan="27">&nbsp;</td>
        </tr>
    </table>
</body>