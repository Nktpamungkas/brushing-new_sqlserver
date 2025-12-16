<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Laporan IN-OUT Kartu Kerja Finishing</title>
  <link rel="stylesheet" type="text/css" href="../css/datatable.css" />
  <link rel="stylesheet" type="text/css" href="../css/jquery-ui.css" />
  <script src="../js/jquery.js" type="text/javascript"></script>
  <script src="../js/jquery.dataTables.js" type="text/javascript"></script>
  <script>
    $(document).ready(function () {
      $('#datatables').dataTable({
        "sScrollY": "400px",
        "sScrollX": "100%",
        "bScrollCollapse": true,
        "bPaginate": false,
        "bJQueryUI": true,

      });
    })
  </script>
  <style>
    tr,
    th,
    td {
      color: #333;
      font-size: 9px;
      border-color: #fff;
      border-collapse: collapse;
      vertical-align: center;
      border-bottom: 1px #000 solid;
      border-top: 1px #000 solid;
      border-left: 1px #000 solid;
      border-right: 1px #000 solid;
    }
  </style>
</head>

<body>
  <?php
  ini_set("error_reporting", 1);
  session_start();
  include("../../koneksi.php");
  include("../../utils/helper.php");
  if ($_POST['jenis'] == "Harian" or $_GET['jenis'] == "Harian") {
    function jumlah_hari($bulan = 0, $tahun = 0)
    {

      $bulan = $bulan > 0 ? $bulan : date("m");
      $tahun = $tahun > 0 ? $tahun : date("Y");

      switch ($bulan) {
        case 1:
        case 3:
        case 5:
        case 7:
        case 8:
        case 10:
        case 12:
          return 31;
          break;
        case 4:
        case 6:
        case 9:
        case 11:
          return 30;
          break;
        case 2:
          return $tahun % 4 == 0 ? 29 : 28;
          break;
      }
    }
    $jml = jumlah_hari($_POST['bln'], $_POST['thn']);
    function bulan($bulan)
    {
      switch ($bulan) {
        case 1:
          $bulan = "Jan";
          break;
        case 2:
          $bulan = "Feb";
          break;
        case 3:
          $bulan = "Mar";
          break;
        case 4:
          $bulan = "Apr";
          break;
        case 5:
          $bulan = "Mei";
          break;
        case 6:
          $bulan = "Jun";
          break;
        case 7:
          $bulan = "Jul";
          break;
        case 8:
          $bulan = "Agu";
          break;
        case 9:
          $bulan = "Sep";
          break;
        case 10:
          $bulan = "Okt";
          break;
        case 11:
          $bulan = "Nov";
          break;
        case 12:
          $bulan = "Des";
          break;
      }
      return $bulan;
    }
    $bln = bulan($_POST['bln']);
    $thn = substr($_POST['thn'], 2, 2);
    ?>

    <table width="100%" border="1" id="" class="display">
      <thead>
        <tr>
          <th width="5%" rowspan="2" bgcolor="#fff">TANGGAL</th>
          <th width="1%" rowspan="2" bgcolor="#fff">SHIFT</th>
          <th colspan="14" bgcolor="#fff">JENIS PROSES</th>
          <th width="6%" rowspan="2" bgcolor="#fff">TOTAL</th>
          <th colspan="3" bgcolor="#fff">PROSES BANTU PEACH SKIN &amp; SISIR BANTU</th>
          <th width="6%" rowspan="2" bgcolor="#fff">TOTAL</th>
        </tr>
        <tr>
          <th width="5%" bgcolor="#fff">GARUK FLEECE</th>
          <th width="7%" bgcolor="#fff">POTONG BULU FLEECE</th>
          <th width="6%" bgcolor="#fff">GARUK ANTI PILLING</th>
          <th width="6%" bgcolor="#fff">SISIR ANTI PILLING</th>
          <th width="7%" bgcolor="#fff">POTONG BULU ANTI PILLING</th>
          <th width="6%" bgcolor="#fff">ANTI PILLING</th>
          <th width="5%" bgcolor="#fff">PEACH SKIN</th>
          <th width="7%" bgcolor="#fff">POTONG BULU PEACH SKIN</th>
          <th width="4%" bgcolor="#fff">AIRO</th>
          <th width="7%" bgcolor="#fff">POTONG BULU LAIN2 KHUSUS</th>
          <th width="7%" bgcolor="#fff">POTONG BULU LAIN2 BANTU</th>
          <th width="7%" bgcolor="#fff">ANTI PILLING LAIN2 KHUSUS</th>
          <th width="7%" bgcolor="#fff">ANTI PILLING LAIN2 BIASA</th>
          <th width="7%" bgcolor="#fff">ANTI PILLING LAIN2 BANTU</th>
          <th width="6%" bgcolor="#fff">SISIR BANTU</th>
          <th width="6%" bgcolor="#fff">PEACH SKIN 01/02</th>
          <th width="6%" bgcolor="#fff">PEACH SKIN 03/02</th>
        </tr>
      </thead>
      <tbody>
        <?php for ($i = 1; $i <= $jml; $i++) {
          $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';

          ?>
          <tr bgcolor="<?php echo $bgcolor; ?>">
            <td rowspan="3"><?php echo $i . "-" . $bln . "-" . $thn;
            $tgl = $_POST['thn'] . "-" . $_POST['bln'] . "-" . $i; ?></td>
            <td>
              <?php
              $sqlA = sqlsrv_query($con, "SELECT 
            SUM(CASE WHEN proses='GARUK FLEECE (Normal)' THEN qty ELSE 0 END) AS Garuk_Fleece,
        SUM(CASE WHEN proses='POTONG BULU PEACH SKIN (Normal)' THEN qty ELSE 0 END) AS Potong_Bulu_Peach_Skin,
        SUM(CASE WHEN proses='POTONG BULU ANTI PILLING (Normal)' THEN qty ELSE 0 END) AS Potong_Bulu_Anti_Pilling,
        SUM(CASE WHEN proses='GARUK GREY (Normal)' THEN qty ELSE 0 END) AS Garuk_Grey,
        SUM(CASE WHEN proses='POTONG BULU FLEECE (Normal)' THEN qty ELSE 0 END) AS Potong_Bulu_Fleece,
        SUM(CASE WHEN proses='GARUK Anti PILLING (Normal)' THEN qty ELSE 0 END) AS Garuk_Anti_Pilling,
        SUM(CASE WHEN proses='AIRO (Normal)' THEN qty ELSE 0 END) AS Airo,
        SUM(CASE WHEN proses='SISIR ANTI PILLING (Normal)' THEN qty ELSE 0 END) AS Sisir_Anti_Pilling,
        SUM(CASE WHEN proses='PEACH SKIN (Normal)' THEN qty ELSE 0 END) AS Peach_Skin,
        SUM(CASE WHEN proses='POTONG BULU LAIN-LAIN (Bantu)' THEN qty ELSE 0 END) AS Potong_Bulu_Lain_Lain_Bantu,
        SUM(CASE WHEN proses='POTONG BULU LAIN-LAIN (Khusus)' THEN qty ELSE 0 END) AS Potong_Bulu_Lain_Lain_Khusus
    FROM db_brushing.tbl_produksi 
    WHERE tgl_update='$tgl' AND shift='A'");

              $rA = sqlsrv_fetch_array($sqlA);
              ?>
              A
            </td>

            <td><?php if ($rA['Garuk_Fleece'] > 0) {
              echo $rA['Garuk_Fleece'];
            } else {
              echo "-";
            } ?></td>
            <td><?php if ($rA['Potong_Bulu_Fleece'] > 0) {
              echo $rA['Potong_Bulu_Fleece'];
            } else {
              echo "-";
            } ?></td>
            <td><?php if ($rA['Garuk_Anti_Pilling'] > 0) {
              echo $rA['Garuk_Anti_Pilling'];
            } else {
              echo "-";
            } ?></td>
            <td><?php if ($rA['Sisir_Anti_Pilling'] > 0) {
              echo $rA['Sisir_Anti_Pilling'];
            } else {
              echo "-";
            } ?></td>
            <td><?php if ($rA['Potong_Bulu_Anti_Pilling'] > 0) {
              echo $rA['Potong_Bulu_Anti_Pilling'];
            } else {
              echo "-";
            } ?></td>
            <td><?php if ($rA['Anti_Pilling'] > 0) {
              echo $rA['Anti_Pilling'];
            } else {
              echo "-";
            } ?></td>
            <td><?php if ($rA['Peach_Skin'] > 0) {
              echo $rA['Peach_Skin'];
            } else {
              echo "-";
            } ?></td>
            <td><?php if ($rA['Potong_Bulu_Peach_Skin'] > 0) {
              echo $rA['Potong_Bulu_Peach_Skin'];
            } else {
              echo "-";
            } ?></td>
            <td><?php if ($rA['Airo'] > 0) {
              echo $rA['Airo'];
            } else {
              echo "-";
            } ?></td>
            <td>
              <?php if ($rA['Potong_Bulu_Lain_Lain_Bantu_Khusus'] > 0) {
                echo $rA['Potong_Bulu_Lain_Lain_Bantu_Khusus'];
              } else {
                echo "-";
              } ?>
            </td>
            <td><?php if ($rA['Potong_Bulu_Lain_Lain_Bantu'] > 0) {
              echo $rA['Potong_Bulu_Lain_Lain_Bantu'];
            } else {
              echo "-";
            } ?>
            </td>
            <td><?php if ($rA['Fleece'] > 0) {
              echo $rA['Fleece'];
            } else {
              echo "-";
            } ?></td>
            <td><?php if ($rA['Fleece'] > 0) {
              echo $rA['Fleece'];
            } else {
              echo "-";
            } ?></td>
            <td><?php if ($rA['Fleece'] > 0) {
              echo $rA['Fleece'];
            } else {
              echo "-";
            } ?></td>
            <td><?php $trA = $rA['Garuk_Fleece'] + $rA['Potong_Bulu_Fleece'] + $rA['Garuk_Anti_Pilling'] + $rA['Sisir_Anti_Pilling'] + $rA['Potong_Bulu_Anti_Pilling'] + $rA['Anti_Pilling'] + $rA['Peach_Skin'] + $rA['Potong_Bulu_Peach_Skin'] + $rA['Airo'] + $rA['Potong_Bulu_Lain_Lain_Bantu_Khusus'] + $rA['Potong_Bulu_Lain_Lain_Bantu'];
            if ($trA > 0) {
              echo number_format($trA, '2', '.', '');
            } else {
              echo "-";
            } ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr bgcolor="<?php echo $bgcolor; ?>">
            <td>
              <?php
              $sqlB = sqlsrv_query($con, " SELECT 
        SUM(CASE WHEN proses='GARUK FLEECE (Normal)' THEN qty ELSE 0 END) AS Garuk_Fleece,
        SUM(CASE WHEN proses='POTONG BULU PEACH SKIN (Normal)' THEN qty ELSE 0 END) AS Potong_Bulu_Peach_Skin,
        SUM(CASE WHEN proses='POTONG BULU ANTI PILLING (Normal)' THEN qty ELSE 0 END) AS Potong_Bulu_Anti_Pilling,
        SUM(CASE WHEN proses='GARUK GREY (Normal)' THEN qty ELSE 0 END) AS Garuk_Grey,
        SUM(CASE WHEN proses='POTONG BULU FLEECE (Normal)' THEN qty ELSE 0 END) AS Potong_Bulu_Fleece,
        SUM(CASE WHEN proses='GARUK Anti PILLING (Normal)' THEN qty ELSE 0 END) AS Garuk_Anti_Pilling,
        SUM(CASE WHEN proses='AIRO (Normal)' THEN qty ELSE 0 END) AS Airo,
        SUM(CASE WHEN proses='SISIR ANTI PILLING (Normal)' THEN qty ELSE 0 END) AS Sisir_Anti_Pilling,
        SUM(CASE WHEN proses='PEACH SKIN (Normal)' THEN qty ELSE 0 END) AS Peach_Skin,
        SUM(CASE WHEN proses='POTONG BULU LAIN-LAIN (Bantu)' THEN qty ELSE 0 END) AS Potong_Bulu_Lain_Lain_Bantu,
        SUM(CASE WHEN proses='POTONG BULU LAIN-LAIN (Khusus)' THEN qty ELSE 0 END) AS Potong_Bulu_Lain_Lain_Khusus
    FROM db_brushing.tbl_produksi 
    WHERE tgl_update='$tgl' AND shift='B'");
              $rB = sqlsrv_fetch_array($sqlB);
              ?>
              B
            </td>

            <td><?php if ($rB['Garuk_Fleece'] > 0) {
              echo $rB['Garuk_Fleece'];
            } else {
              echo "-";
            } ?></td>
            <td><?php if ($rB['Potong_Bulu_Fleece'] > 0) {
              echo $rB['Potong_Bulu_Fleece'];
            } else {
              echo "-";
            } ?></td>
            <td><?php if ($rB['Garuk_Anti_Pilling'] > 0) {
              echo $rB['Garuk_Anti_Pilling'];
            } else {
              echo "-";
            } ?></td>
            <td><?php if ($rB['Sisir_Anti_Pilling'] > 0) {
              echo $rB['Sisir_Anti_Pilling'];
            } else {
              echo "-";
            } ?></td>
            <td><?php if ($rB['Potong_Bulu_Anti_Pilling'] > 0) {
              echo $rB['Potong_Bulu_Anti_Pilling'];
            } else {
              echo "-";
            } ?></td>
            <td><?php if ($rB['Anti_Pilling'] > 0) {
              echo $rB['Anti_Pilling'];
            } else {
              echo "-";
            } ?></td>
            <td><?php if ($rB['Peach_Skin'] > 0) {
              echo $rB['Peach_Skin'];
            } else {
              echo "-";
            } ?></td>
            <td><?php if ($rB['Potong_Bulu_Peach_Skin'] > 0) {
              echo $rB['Potong_Bulu_Peach_Skin'];
            } else {
              echo "-";
            } ?></td>
            <td><?php if ($rB['Airo'] > 0) {
              echo $rB['Airo'];
            } else {
              echo "-";
            } ?></td>
            <td>
              <?php if ($rB['Potong_Bulu_Lain_Lain_Bantu_Khusus'] > 0) {
                echo $rB['Potong_Bulu_Lain_Lain_Bantu_Khusus'];
              } else {
                echo "-";
              } ?>
            </td>
            <td><?php if ($rB['Potong_Bulu_Lain_Lain_Bantu'] > 0) {
              echo $rB['Potong_Bulu_Lain_Lain_Bantu'];
            } else {
              echo "-";
            } ?>
            </td>
            <td><?php if ($rB['Fleece'] > 0) {
              echo $rB['Fleece'];
            } else {
              echo "-";
            } ?></td>
            <td><?php if ($rB['Fleece'] > 0) {
              echo $rB['Fleece'];
            } else {
              echo "-";
            } ?></td>
            <td><?php if ($rB['Fleece'] > 0) {
              echo $rB['Fleece'];
            } else {
              echo "-";
            } ?></td>
            <td><?php $trB = $rB['Garuk_Fleece'] + $rB['Potong_Bulu_Fleece'] + $rB['Garuk_Anti_Pilling'] + $rB['Sisir_Anti_Pilling'] + $rB['Potong_Bulu_Anti_Pilling'] + $rB['Anti_Pilling'] + $rB['Peach_Skin'] + $rB['Potong_Bulu_Peach_Skin'] + $rB['Airo'] + $rB['Potong_Bulu_Lain_Lain_Bantu_Khusus'] + $rB['Potong_Bulu_Lain_Lain_Bantu'];
            if ($trB > 0) {
              echo number_format($trB, '2', '.', '');
            } else {
              echo "-";
            } ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr bgcolor="<?php echo $bgcolor; ?>">
            <td>
              <?php
              $sqlC = sqlsrv_query($con, "SELECT 
             SUM(CASE WHEN proses='GARUK FLEECE (Normal)' THEN qty ELSE 0 END) AS Garuk_Fleece,
        SUM(CASE WHEN proses='POTONG BULU PEACH SKIN (Normal)' THEN qty ELSE 0 END) AS Potong_Bulu_Peach_Skin,
        SUM(CASE WHEN proses='POTONG BULU ANTI PILLING (Normal)' THEN qty ELSE 0 END) AS Potong_Bulu_Anti_Pilling,
        SUM(CASE WHEN proses='GARUK GREY (Normal)' THEN qty ELSE 0 END) AS Garuk_Grey,
        SUM(CASE WHEN proses='POTONG BULU FLEECE (Normal)' THEN qty ELSE 0 END) AS Potong_Bulu_Fleece,
        SUM(CASE WHEN proses='GARUK Anti PILLING (Normal)' THEN qty ELSE 0 END) AS Garuk_Anti_Pilling,
        SUM(CASE WHEN proses='AIRO (Normal)' THEN qty ELSE 0 END) AS Airo,
        SUM(CASE WHEN proses='SISIR ANTI PILLING (Normal)' THEN qty ELSE 0 END) AS Sisir_Anti_Pilling,
        SUM(CASE WHEN proses='PEACH SKIN (Normal)' THEN qty ELSE 0 END) AS Peach_Skin,
        SUM(CASE WHEN proses='POTONG BULU LAIN-LAIN (Bantu)' THEN qty ELSE 0 END) AS Potong_Bulu_Lain_Lain_Bantu,
        SUM(CASE WHEN proses='POTONG BULU LAIN-LAIN (Khusus)' THEN qty ELSE 0 END) AS Potong_Bulu_Lain_Lain_Khusus
    FROM db_brushing.tbl_produksi 
    WHERE tgl_update='$tgl' AND shift='C'");
              $rC = sqlsrv_fetch_array($sqlC);
              ?>
              C
            </td>

            <td><?php if ($rC['Garuk_Fleece'] > 0) {
              echo $rC['Garuk_Fleece'];
            } else {
              echo "-";
            } ?></td>
            <td><?php if ($rC['Potong_Bulu_Fleece'] > 0) {
              echo $rC['Potong_Bulu_Fleece'];
            } else {
              echo "-";
            } ?></td>
            <td><?php if ($rC['Garuk_Anti_Pilling'] > 0) {
              echo $rC['Garuk_Anti_Pilling'];
            } else {
              echo "-";
            } ?></td>
            <td><?php if ($rC['Sisir_Anti_Pilling'] > 0) {
              echo $rC['Sisir_Anti_Pilling'];
            } else {
              echo "-";
            } ?></td>
            <td><?php if ($rC['Potong_Bulu_Anti_Pilling'] > 0) {
              echo $rC['Potong_Bulu_Anti_Pilling'];
            } else {
              echo "-";
            } ?></td>
            <td><?php if ($rC['Anti_Pilling'] > 0) {
              echo $rC['Anti_Pilling'];
            } else {
              echo "-";
            } ?></td>
            <td><?php if ($rC['Peach_Skin'] > 0) {
              echo $rC['Peach_Skin'];
            } else {
              echo "-";
            } ?></td>
            <td><?php if ($rC['Potong_Bulu_Peach_Skin'] > 0) {
              echo $rC['Potong_Bulu_Peach_Skin'];
            } else {
              echo "-";
            } ?></td>
            <td><?php if ($rC['Airo'] > 0) {
              echo $rC['Airo'];
            } else {
              echo "-";
            } ?></td>
            <td>
              <?php if ($rC['Potong_Bulu_Lain_Lain_Bantu_Khusus'] > 0) {
                echo $rC['Potong_Bulu_Lain_Lain_Bantu_Khusus'];
              } else {
                echo "-";
              } ?>
            </td>
            <td><?php if ($rC['Potong_Bulu_Lain_Lain_Bantu'] > 0) {
              echo $rC['Potong_Bulu_Lain_Lain_Bantu'];
            } else {
              echo "-";
            } ?>
            </td>
            <td><?php if ($rC['Fleece'] > 0) {
              echo $rC['Fleece'];
            } else {
              echo "-";
            } ?></td>
            <td><?php if ($rC['Fleece'] > 0) {
              echo $rC['Fleece'];
            } else {
              echo "-";
            } ?></td>
            <td><?php if ($rC['Fleece'] > 0) {
              echo $rC['Fleece'];
            } else {
              echo "-";
            } ?></td>
            <td><?php $trC = $rC['Garuk_Fleece'] + $rC['Potong_Bulu_Fleece'] + $rC['Garuk_Anti_Pilling'] + $rC['Sisir_Anti_Pilling'] + $rC['Potong_Bulu_Anti_Pilling'] + $rC['Anti_Pilling'] + $rC['Peach_Skin'] + $rC['Potong_Bulu_Peach_Skin'] + $rC['Airo'] + $rC['Potong_Bulu_Lain_Lain_Bantu_Khusus'] + $rC['Potong_Bulu_Lain_Lain_Bantu'];
            if ($trC > 0) {
              echo number_format($trC, '2', '.', '');
            } else {
              echo "-";
            } ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <?php
          $totA1 = $totA1 + $rA['Garuk_Fleece'];
          $totB1 = $totB1 + $rB['Garuk_Fleece'];
          $totC1 = $totC1 + $rC['Garuk_Fleece'];
          $totA2 = $totA2 + $rA['Potong_Bulu_Fleece'];
          $totB2 = $totB2 + $rB['Potong_Bulu_Fleece'];
          $totC2 = $totC2 + $rC['Potong_Bulu_Fleece'];
          $totA3 = $totA3 + $rA['Garuk_Anti_Pilling'];
          $totB3 = $totB3 + $rB['Garuk_Anti_Pilling'];
          $totC3 = $totC3 + $rC['Garuk_Anti_Pilling'];
          $totA4 = $totA4 + $rA['Sisir_Anti_Pilling'];
          $totB4 = $totB4 + $rB['Sisir_Anti_Pilling'];
          $totC4 = $totC4 + $rC['Sisir_Anti_Pilling'];
          $totA5 = $totA5 + $rA['Potong_Bulu_Anti_Pilling'];
          $totB5 = $totB5 + $rB['Potong_Bulu_Anti_Pilling'];
          $totC5 = $totC5 + $rC['Potong_Bulu_Anti_Pilling'];
          $totA6 = $totA6 + $rA['Anti_Pilling'];
          $totB6 = $totB6 + $rB['Anti_Pilling'];
          $totC6 = $totC6 + $rC['Anti_Pilling'];
          $totA7 = $totA7 + $rA['Peach_Skin'];
          $totB7 = $totB7 + $rB['Peach_Skin'];
          $totC7 = $totC7 + $rC['Peach_Skin'];
          $totA8 = $totA8 + $rA['Potong_Bulu_Peach_Skin'];
          $totB8 = $totB8 + $rB['Potong_Bulu_Peach_Skin'];
          $totC8 = $totC8 + $rC['Potong_Bulu_Peach_Skin'];
          $totA9 = $totA9 + $rA['Airo'];
          $totB9 = $totB9 + $rB['Airo'];
          $totC9 = $totC9 + $rC['Airo'];
          $totA10 = $totA10 + $rA['Potong_Bulu_Lain_Lain_Bantu_Khusus'];
          $totB10 = $totB10 + $rB['Potong_Bulu_Lain_Lain_Bantu_Khusus'];
          $totC10 = $totC10 + $rC['Potong_Bulu_Lain_Lain_Bantu_Khusus'];
          $totA11 = $totA11 + $rA['Garuk_Fleece'];
          $totB11 = $totB11 + $rB['Garuk_Fleece'];
          $totC11 = $totC11 + $rC['Garuk_Fleece'];
          $totA12 = $totA12 + $rA['Garuk_Fleece'];
          $totB12 = $totB12 + $rB['Garuk_Fleece'];
          $totC12 = $totC12 + $rC['Garuk_Fleece'];
          $totA13 = $totA13 + $rA['Garuk_Fleece'];
          $totB13 = $totB13 + $rB['Garuk_Fleece'];
          $totC13 = $totC13 + $rC['Garuk_Fleece'];
          $totA14 = $totA14 + $rA['Garuk_Fleece'];
          $totB14 = $totB14 + $rB['Garuk_Fleece'];
          $totC14 = $totC14 + $rC['Garuk_Fleece'];

          $totTrA = $totTrA + $trA;
          $totTrB = $totTrB + $trB;
          $totTrC = $totTrC + $trC;

          ?>
        <?php } ?>
      </tbody>
    </table>
    <table width="100%" border="1">
      <tbody>
        <tr>
          <th bgcolor="#fff">TOTAL 1 BULAN</th>
          <th bgcolor="#fff" class="display">GARUK FLEECE</th>
          <th bgcolor="#fff" class="display">POTONG BULU FLEECE</th>
          <th bgcolor="#fff" class="display">GARUK ANTI PILLING</th>
          <th bgcolor="#fff" class="display">SISIR ANTI PILLING</th>
          <th bgcolor="#fff" class="display">POTONG BULU ANTI PILLING</th>
          <th bgcolor="#fff" class="display">ANTI PILLING</th>
          <th bgcolor="#fff" class="display">PEACH SKIN</th>
          <th bgcolor="#fff" class="display">POTONG BULU PEACH SKIN</th>
          <th bgcolor="#fff" class="display">AIRO</th>
          <th bgcolor="#fff" class="display">POTONG BULU LAIN2 KHUSUS</th>
          <th bgcolor="#fff" class="display">POTONG BULU LAIN2 BANTU</th>
          <th bgcolor="#fff" class="display">ANTI PILLING LAIN2 KHUSUS</th>
          <th bgcolor="#fff" class="display">ANTI PILLING LAIN2 BIASA</th>
          <th bgcolor="#fff" class="display">ANTI PILLING LAIN2 BANTU</th>
          <th bgcolor="#fff">TOTAL</th>
          <th bgcolor="#fff" class="display">SISIR BANTU</th>
          <th bgcolor="#fff" class="display">PEACH SKIN 01/02</th>
          <th bgcolor="#fff" class="display">PEACH SKIN 03/02</th>
          <th bgcolor="#fff">TOTAL</th>
        </tr>
        <tr bgcolor="#FFCC99">
          <td>A</td>
          <td><?php echo $totA1; ?></td>
          <td><?php echo $totA2; ?></td>
          <td><?php echo $totA3; ?></td>
          <td><?php echo $totA4; ?></td>
          <td><?php echo $totA5; ?></td>
          <td><?php echo $totA6; ?></td>
          <td><?php echo $totA7; ?></td>
          <td><?php echo $totA8; ?></td>
          <td><?php echo $totA9; ?></td>
          <td><?php echo $totA10; ?></td>
          <td><?php echo $totA11; ?></td>
          <td><?php echo $totA12; ?></td>
          <td><?php echo $totA13; ?></td>
          <td><?php echo $totA14; ?></td>
          <td><?php echo $totTrA; ?></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr bgcolor="#33CCFF">
          <td>B</td>
          <td><?php echo $totB1; ?></td>
          <td><?php echo $totB2; ?></td>
          <td><?php echo $totB3; ?></td>
          <td><?php echo $totB4; ?></td>
          <td><?php echo $totB5; ?></td>
          <td><?php echo $totB6; ?></td>
          <td><?php echo $totB7; ?></td>
          <td><?php echo $totB8; ?></td>
          <td><?php echo $totB9; ?></td>
          <td><?php echo $totB10; ?></td>
          <td><?php echo $totB11; ?></td>
          <td><?php echo $totB12; ?></td>
          <td><?php echo $totB13; ?></td>
          <td><?php echo $totB14; ?></td>
          <td><?php echo $totTrB; ?></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr bgcolor="#FFCC99">
          <td>C</td>
          <td><?php echo $totC1; ?></td>
          <td><?php echo $totC2; ?></td>
          <td><?php echo $totC3; ?></td>
          <td><?php echo $totC4; ?></td>
          <td><?php echo $totC5; ?></td>
          <td><?php echo $totC6; ?></td>
          <td><?php echo $totC7; ?></td>
          <td><?php echo $totC8; ?></td>
          <td><?php echo $totC9; ?></td>
          <td><?php echo $totC10; ?></td>
          <td><?php echo $totC11; ?></td>
          <td><?php echo $totC12; ?></td>
          <td><?php echo $totC13; ?></td>
          <td><?php echo $totC14; ?></td>
          <td><?php echo $totTrC; ?></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr bgcolor="#fff">
          <td><strong>TOTAL</strong></td>
          <td><?php echo $totA1 + $totB1 + $totC1; ?></td>
          <td><?php echo $totA2 + $totB2 + $totC2; ?></td>
          <td><?php echo $totA3 + $totB3 + $totC3; ?></td>
          <td><?php echo $totA4 + $totB4 + $totC4; ?></td>
          <td><?php echo $totA5 + $totB5 + $totC5; ?></td>
          <td><?php echo $totA6 + $totB6 + $totC6; ?></td>
          <td><?php echo $totA7 + $totB7 + $totC7; ?></td>
          <td><?php echo $totA8 + $totB8 + $totC8; ?></td>
          <td><?php echo $totA9 + $totB9 + $totC9; ?></td>
          <td><?php echo $totA10 + $totB10 + $totC10; ?></td>
          <td><?php echo $totA11 + $totB11 + $totC11; ?></td>
          <td><?php echo $totA12 + $totB12 + $totC12; ?></td>
          <td><?php echo $totA13 + $totB13 + $totC13; ?></td>
          <td><?php echo $totA14 + $totB14 + $totC14; ?></td>
          <td><?php echo $totTrA + $totTrB + $totTrC; ?></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </tbody>
    </table>

  <?php } else if ($_POST['jenis'] == "Bulanan" or $_GET['jenis'] == "S") { ?>

    <?php
  }
  ?>
</body>

</html>