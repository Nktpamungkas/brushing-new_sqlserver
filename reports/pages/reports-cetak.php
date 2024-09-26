<?php
$tglawal = $_GET['tglawal'];
$tglakhir = $_GET['tglakhir'];
$jamawal = $_GET['jamawal'];
$jamakhir = $_GET['jamakhir'];
$shft = $_GET['shift'];
$nmesin = $_GET['mesin'];
$mc = $_GET['no_mesin'];

//  if ($tglakhir != "" and $tglawal != "") {
//    $tgl = "DATE_FORMAT(a.`tgl_update`,'%Y-%m-%d') BETWEEN '$tglawal' AND '$tglakhir' ";
//  } else {
//    $tgl = " ";
//  }
if ($tglakhir != "" and $tglawal != "" and $jamakhir != "" and $jamawal != "") {
    $tgl = "CONVERT(VARCHAR(16), a.tgl_update, 120)  BETWEEN'$tglawal $jamawal' AND '$tglakhir $jamakhir' ";
} else {
    $tgl = " ";
}
if ($shft == "ALL") {
    $shift = " ";
} else {
    $shift = " AND a.shift='$shft' ";
}
if ($nmesin != "") {
    $mesin = " AND a.nama_mesin='$nmesin'";
} else {
    $mesin = " ";
}
if ($mc != "ALL") {
    $nomesin = " AND a.no_mesin='$mc'";
} else if ($mc == "ALL") {
    $nomesin = " ";
} else {
    $nomesin = " ";
}
?>
<html>

<head>
    <title>:: Cetak Reports Produksi Dyeing</title>
    <link href="../../styles_cetak.css" rel="stylesheet" type="text/css">
    <style>
    input {
        text-align: center;
        border: hidden;
    }

    @media print {
        ::-webkit-input-placeholder {
            /* WebKit browsers */
            color: transparent;
        }

        :-moz-placeholder {
            /* Mozilla Firefox 4 to 18 */
            color: transparent;
        }

        ::-moz-placeholder {
            /* Mozilla Firefox 19+ */
            color: transparent;
        }

        :-ms-input-placeholder {
            /* Internet Explorer 10+ */
            color: transparent;
        }

        .pagebreak {
            page-break-before: always;
        }

        .header {
            display: block
        }

        table thead {
            display: table-header-group;
        }
    }
    </style>
</head>

<body>

    <?php
    //   $con=mysqli_connect("10.0.0.10","dit","4dm1n","db_brushing");
    include("../../koneksi.php");

    ini_set("error_reporting", 1);
    ?>
    <table width="100%" border="0" class="table-list1">
        <thead>
            <tr valign="top">
                <td colspan="17">
                    <table width="100%" border="0" class="table-list1">
                        <thead>
                            <tr>
                                <td width="6%" rowspan="2"><img src="IndoBaru.jpg" alt="" width="60" height="60"></td>
                                <td width="75%" height="41" align="center" valign="middle">
                                    <h2>FORM LAPORAN PRODUKSI HARIAN </h2>
                                </td>
                            </tr>
                            <tr>
                                <td align="center"><strong>FW – 14 – BRS – 01 / 05</strong></td>
                            </tr>
                            <thead>
                    </table>
                </td>
            </tr>
            <tr valign="top">
                <td colspan="3"><strong>DEPARTEMEN: BRUSHING</strong></td>
                <td colspan="7"><strong>GROUP SHIFT: <?php echo $shft; ?></strong></td>
                <td colspan="7"><strong>TANGGAL: <?php echo $tglawal . " " . $jamawal; ?> s/d
                        <?php echo $tglakhir . " " . $jamakhir; ?></strong></td>
            </tr>
            <tr valign="top">
                <td colspan="3"><strong>MESIN: <?php echo strtoupper($nmesin); ?></strong></td>
                <td colspan="7"><strong>NO MESIN: <?php echo strtoupper($mc); ?></strong></td>
                <td colspan="7">&nbsp;</td>
            </tr>
            <tr>
                <td rowspan="2">
                    <div align="center">NO MESIN</div>
                </td>
                <td rowspan="2">
                    <div align="center">LANGGANAN</div>
                </td>
                <td rowspan="2">
                    <div align="center">ORDER</div>
                </td>
                <td rowspan="2">
                    <div align="center">JENIS KAIN</div>
                </td>
                <td rowspan="2">
                    <div align="center">WARNA</div>
                </td>
                <td rowspan="2">
                    <div align="center">ROLL</div>
                </td>
                <td rowspan="2">
                    <div align="center">QUANTITY</div>
                </td>
                <td rowspan="2">
                    <div align="center">NO. KARTU KERJA</div>
                </td>
                <td rowspan="2">
                    <div align="center">LOT</div>
                </td>
                <td rowspan="2">
                    <div align="center">JENIS PROSES</div>
                </td>
                <td colspan="2">
                    <div align="center">JAM PROSES</div>
                </td>
                <td colspan="2">
                    <div align="center">STOP MESIN</div>
                </td>
                <td rowspan="2">
                    <div align="center">TOTAL STOP</div>
                </td>
                <td rowspan="2">
                    <div align="center">KODE</div>
                </td>
                <td rowspan="2">KET</td>
            </tr>
            <tr>
                <td>
                    <div align="center">IN</div>
                </td>
                <td>
                    <div align="center">OUT</div>
                </td>
                <td>
                    <div align="center">JAM</div>
                </td>
                <td>
                    <div align="center">S/D</div>
                </td>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = sqlsrv_query($con, "SELECT * FROM db_brushing.tbl_produksi a WHERE " . $tgl . $shift . $mesin . $nomesin . " ORDER BY a.no_mesin ASC");
            $no = 1;
            $c = 0;
            $totrol = 0;
            $totberat = 0;
            while ($rowd = sqlsrv_fetch_array($sql)) {
                ?>
            <tr valign="top">
                <td>
                    <div align="center"><?php echo $rowd['no_mesin']; ?></div>
                </td>
                <td><?php echo $rowd['langganan']; ?></td>
                <td><?php echo $rowd['no_order']; ?></td>
                <td><?php echo $rowd['jenis_kain']; ?></td>
                <td><?php echo $rowd['warna']; ?></td>
                <td>
                    <div align="center"><?php echo $rowd['rol']; ?></div>
                </td>
                <td>
                    <div align="right"><?php echo $rowd['qty']; ?></div>
                </td>
                <td><?php echo $rowd['nokk']; ?></td>
                <td>
                    <div align="center"><?php echo $rowd['lot']; ?></div>
                </td>
                <td><?php echo $rowd['proses']; ?></td>
                <td>
                    <div align="right"><?php echo $rowd['jam_in']; ?></div>
                </td>
                <td>
                    <div align="right"><?php echo $rowd['jam_out']; ?></div>
                </td>
                <td>
                    <div align="right"><?php echo $rowd['stop_l']; ?></div>
                </td>
                <td>
                    <div align="right"><?php echo $rowd['stop_r']; ?></div>
                </td>
                <td>
                    <div align="center">
                        <?php
                            date_default_timezone_set('Asia/Jakarta');
                            // var_dump($rowd['tgl_stop_l']);
                            // var_dump($rowd['stop_l']);
                            $time1 = strtotime(cek($rowd['tgl_stop_l'], 'Y-m-d') . " " . $rowd['stop_l']);
                            $time2 = strtotime(cek($rowd['tgl_stop_r'], 'Y-m-d') . " " . $rowd['stop_r']);
                            $diff = $time2 - $time1;
                            // var_dump($time1);
                        
                            $jam = floor($diff / (60 * 60));
                            $menit = $diff - $jam * (60 * 60);
                            echo $jam . ' jam ' . floor($menit / 60) . ' menit';
                            // echo $time1;
                            // echo $time2;
                            // echo $rowd['tgl_stop_l'] . " " . $rowd['stop_l'];
                            ?>
                    </div>
                </td>
                <td>
                    <div align="center"><?php echo $rowd['kd_stop']; ?></div>
                </td>
                <td><?php echo $rowd['ket']; ?></td>
            </tr>
            <?php
                $totrol += $rowd['rol'];
                $totberat += $rowd['qty'];
                $no++;
            } ?>

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
            </tr>
        </tbody>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>Total</td>
            <td>
                <div align="right"><?php echo $totrol; ?></div>
            </td>
            <td>
                <div align="right"><?php echo $totberat; ?></div>
            </td>
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

    </table>
    <table width="100%" border="0" class="table-list1">
        <tr>
            <td width="15%">&nbsp;</td>
            <td width="31%">
                <div align="center">DIBUAT OLEH:</div>
            </td>
            <td width="27%">
                <div align="center">DIPERIKSA OLEH:</div>
            </td>
            <td width="27%">
                <div align="center">DIKETAHUI OLEH:</div>
            </td>
        </tr>
        <tr>
            <td>NAMA</td>
            <td>
                <div align="center">
                    <input name=nama type=text placeholder="Ketik disini" size="33" maxlength="30">
                </div>
            </td>
            <td>
                <div align="center">
                    <input name=nama3 type=text placeholder="Ketik disini" size="33" maxlength="30">
                </div>
            </td>
            <td>
                <div align="center">
                    <input name=nama5 type=text placeholder="Ketik disini" size="33" maxlength="30">
                </div>
            </td>
        </tr>
        <tr>
            <td>JABATAN</td>
            <td>
                <div align="center">
                    <input name=nama2 type=text placeholder="Ketik disini" size="33" maxlength="30">
                </div>
            </td>
            <td>
                <div align="center">
                    <input name=nama4 type=text placeholder="Ketik disini" size="33" maxlength="30">
                </div>
            </td>
            <td>
                <div align="center">
                    <input name=nama6 type=text placeholder="Ketik disini" size="33" maxlength="30">
                </div>
            </td>
        </tr>
        <tr>
            <td>TANGGAL</td>
            <td>
                <div align="center">
                    <input type="text" name="date" placeholder="dd-mm-yyyy" onKeyUp="
  var date = this.value;
  if (date.match(/^\d{2}$/) !== null) {
     this.value = date + '-';
  } else if (date.match(/^\d{2}\-\d{2}$/) !== null) {
     this.value = date + '-';
  }" maxlength="10">
                </div>
            </td>
            <td>
                <div align="center">
                    <input type="text" name="date" placeholder="dd-mm-yyyy" onKeyUp="
  var date = this.value;
  if (date.match(/^\d{2}$/) !== null) {
     this.value = date + '-';
  } else if (date.match(/^\d{2}\-\d{2}$/) !== null) {
     this.value = date + '-';
  }" maxlength="10">
                </div>
            </td>
            <td>
                <div align="center">
                    <input type="text" name="date" placeholder="dd-mm-yyyy" onKeyUp="
  var date = this.value;
  if (date.match(/^\d{2}$/) !== null) {
     this.value = date + '-';
  } else if (date.match(/^\d{2}\-\d{2}$/) !== null) {
     this.value = date + '-';
  }" maxlength="10">
                </div>
            </td>
        </tr>
        <tr>
            <td height="60" valign="top">TANDA TANGAN</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
    </table>

</body>

</html>