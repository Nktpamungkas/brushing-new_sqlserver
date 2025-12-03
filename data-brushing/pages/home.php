<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
include("../utils/helper.php")
	?>
<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Home</title>
	<script>
		function roundToTwo(num) {
			return +(Math.round(num + "e+2") + "e-2");
		}

		function jumlah() {
			var lebar = document.forms['form1']['lebar'].value;
			var berat = document.forms['form1']['gramasi'].value;
			var netto = document.forms['form1']['qty'].value;
			var x, yard;
			x = ((parseInt(lebar)) * parseInt(berat)) / 43.056;
			x1 = (1000 / x);
			yard = x1 * parseFloat(netto);
			document.form1.qty2.value = roundToTwo(yard).toFixed(2);

		}
	</script>
</head>
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>

<body>
	<?php
	function nourut()
	{
		include("../koneksi.php");
		$format = date("ymd");
		$sql = sqlsrv_query($con, "SELECT TOP 1 nokk FROM db_brushing.tbl_produksi WHERE SUBSTRING(nokk,1,6) like '%" . $format . "%' ORDER BY nokk DESC", array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET)) or die(sqlsrv_errors());
		$d = sqlsrv_num_rows($sql);
		if ($d > 0) {
			$r = sqlsrv_fetch_array($sql);
			$d = $r['nokk'];
			$str = substr($d, 6, 2);
			$Urut = (int) $str;
		} else {
			$Urut = 0;
		}
		$Urut = $Urut + 1;
		$Nol = "";
		$nilai = 2 - strlen($Urut);
		for ($i = 1; $i <= $nilai; $i++) {
			$Nol = $Nol . "0";
		}
		$nipbr = $format . $Nol . $Urut;
		return $nipbr;
	}
	$nou = nourut();
	if ($_REQUEST['kk'] != '') {
		$idkk = "";
	} else {
		$idkk = $_GET['idkk'];
	}

	if ($_GET['typekk'] == "KKLama") {
		if ($_GET['id'] != "") {
			$idk = $_GET['id'];
		} else {
			$idk = $_POST['id'];
		}
		$qry = sqlsrv_query($con, "SELECT TOP 1 * FROM db_brushing.tbl_produksi WHERE id='$idk' ORDER BY id DESC");
		$rw = sqlsrv_fetch_array($qry);
		if ($idkk != "") {
			date_default_timezone_set('Asia/Jakarta');
			$rc = sqlsrv_num_rows($qry);
			// $tglsvr = sqlsrv_query($conn, "select CONVERT(VARCHAR(10),GETDATE(),105) AS  tgk");
			// $sr = sqlsrv_fetch_array($tglsvr);
	
			// $sqlLot = sqlsrv_query($conn, " SELECT
			//         x.*,dbo.fn_StockMovementDetails_GetTotalWeightPCC(0, x.PCBID) as Weight,
			//         dbo.fn_StockMovementDetails_GetTotalRollPCC(0, x.PCBID) as RollCount
			//       FROM( SELECT
			//         so.CustomerID, so.BuyerID, 
			//         sod.ID as SODID, sod.ProductID, sod.UnitID, sod.WeightUnitID, 
			//         pcb.ID as PCBID,pcb.UnitID as BatchUnitID,
			//         pcblp.DepartmentID,pcb.PCID,pcb.LotNo,pcb.ChildLevel,pcb.RootID
			//       FROM
			//         SalesOrders so INNER JOIN
			//         JobOrders jo ON jo.SOID=so.ID INNER JOIN
			//         SODetails sod ON so.ID = sod.SOID INNER JOIN
			//         SODetailsAdditional soda ON sod.ID = soda.SODID LEFT JOIN
			//         ProcessControlJO pcjo ON sod.ID = pcjo.SODID LEFT JOIN
			//         ProcessControlBatches pcb ON pcjo.PCID = pcb.PCID LEFT JOIN
			//         ProcessControlBatchesLastPosition pcblp ON pcb.ID = pcblp.PCBID LEFT JOIN
			//         ProcessFlowProcessNo pfpn ON pfpn.EntryType = 2 and pcb.ID = pfpn.ParentID AND pfpn.MachineType = 24 LEFT JOIN
			//         ProcessFlowDetailsNote pfdn ON pfpn.EntryType = pfdn.EntryType AND pfpn.ID = pfdn.ParentID
			//       WHERE pcb.DocumentNo='$idkk' AND pcb.Gross<>'0'
			//         GROUP BY
			//           so.SONumber, so.SODate, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
			//           sod.ID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID,
			//           soda.RefNo,pcb.DocumentNo,pcb.Dated,sod.RequiredDate,
			//           pcb.ID, pcb.DocumentNo, pcb.Gross,
			//           pcb.Quantity, pcb.UnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
			//           pcblp.DepartmentID,pcb.LotNo,pcb.PCID,pcb.ChildLevel,pcb.RootID
			//         ) x INNER JOIN
			//         ProductMaster pm ON x.ProductID = pm.ID LEFT JOIN
			//         Departments dep ON x.DepartmentID  = dep.ID LEFT JOIN
			//         Departments pdep ON dep.RootID = pdep.ID LEFT JOIN				
			//         Partners cust ON x.CustomerID = cust.ID LEFT JOIN
			//         Partners buy ON x.BuyerID = buy.ID LEFT JOIN
			//         UnitDescription udq ON x.UnitID = udq.ID LEFT JOIN
			//         UnitDescription udw ON x.WeightUnitID = udw.ID LEFT JOIN
			//         UnitDescription udb ON x.BatchUnitID = udb.ID
			//       ORDER BY
			//         x.SODID, x.PCBID ", array(), array("Scrollable" => 'static'));
			// $sLot = sqlsrv_fetch_array($sqlLot);
			// $cLot = sqlsrv_num_rows($sqlLot);
			// $child = $sLot['ChildLevel'];
	
			// if ($child > 0) {
			//   $sqlgetparent = sqlsrv_query($conn, "select ID,LotNo from ProcessControlBatches where ID='$sLot[RootID]' and ChildLevel='0'");
			//   $rowgp = sqlsrv_fetch_array($sqlgetparent);
	
			//$nomLot=substr("$row2[LotNo]",0,1);
			// $nomLot = $rowgp['LotNo'];
			// $nomorLot = "$nomLot/K$sLot[ChildLevel]";
			// } else {
			//   $nomorLot = $sLot['LotNo'];
			// }
	
			// $sqlLot1 = "Select count(*) as TotalLot From ProcessControlBatches where PCID='$sLot[PCID]' and RootID='0' and LotNo < '1000'";
			// $qryLot1 = sqlsrv_query($conn, $sqlLot1) or die('A error occured : ');
			// $rowLot = sqlsrv_fetch_array($qryLot1);
	
			// $sqls = sqlsrv_query($conn, "select processcontrolJO.SODID,salesorders.ponumber,processcontrol.productid,salesorders.customerid,joborders.documentno,
			//                                 salesorders.buyerid,processcontrolbatches.lotno,productcode,productmaster.color,colorno,description,weight,cuttablewidth from Joborders 
			//                                 left join processcontrolJO on processcontrolJO.joid = Joborders.id
			//                                 left join salesorders on soid= salesorders.id
			//                                 left join processcontrol on processcontrolJO.pcid = processcontrol.id
			//                                 left join processcontrolbatches on processcontrolbatches.pcid = processcontrol.id
			//                                 left join productmaster on productmaster.id= processcontrol.productid
			//                                 left join productpartner on productpartner.productid= processcontrol.productid
			//                                 where processcontrolbatches.documentno='$idkk'", array(), array("Scrollable" => 'static'));
			// $ssr = sqlsrv_fetch_array($sqls);
			// $cek = sqlsrv_num_rows($sqls);
			// $lgn1 = sqlsrv_query($conn, "select partnername from partners where id='$ssr[customerid]'");
			// $ssr1 = sqlsrv_fetch_array($lgn1);
			// $lgn2 = sqlsrv_query($conn, "select partnername from partners where id='$ssr[buyerid]'");
			// $ssr2 = sqlsrv_fetch_array($lgn2);
		}
	} elseif ($_GET['typekk'] == "NOW") {
		if ($idkk != "") {
			include_once("../now.php");
			$qry = sqlsrv_query($con, "SELECT TOP 1 * FROM db_brushing.tbl_adm WHERE nokk='$idkk' and nodemand = '$_GET[demand]' and [status]='1' and tgl_out <> NULL ORDER BY id DESC");
			$rw = sqlsrv_fetch_array($qry);
		} else { // EDIT
			if ($_GET['id'] != "") {
				$idk = $_GET['id'];
			} else {
				$idk = $_POST['id'];
			}
			$qry = sqlsrv_query($con, "SELECT TOP 1 * FROM db_brushing.tbl_produksi WHERE id='$idk' ORDER BY id DESC");
			$rw = sqlsrv_fetch_array(stmt: $qry);
		}
	}
	?>

	<?php
	if (isset($_POST['btnSimpan']) and $_GET['id'] == "") {
		if ($_POST['nokk'] != "") {
			$nokk = $_POST['nokk'];
			$idkk = $_POST['nokk'];
		} else {
			$nokk = $nou;
			$idkk = $nou;
		}
		if ($_POST['demand'] != NULL or $_POST['demand'] != '') {
			$nodemand = $_POST['demand'];
		} else {
			$nodemand = NULL;
		}
		if ($_POST['shift'] != NULL or $_POST['shift'] != '') {
			$shift = $_POST['shift'];
		} else {
			$shift = NULL;
		}
		if ($_POST['shift2'] != NULL or $_POST['shift2'] != '') {
			$shift1 = $_POST['shift2'];
		} else {
			$shift1 = NULL;
		}
		if ($_POST['buyer'] != NULL or $_POST['buyer'] != '') {
			$langganan = $_POST['buyer'];
		} else {
			$langganan = NULL;
		}
		if ($_POST['no_order'] != NULL or $_POST['no_order'] != '') {
			$order = $_POST['no_order'];
		} else {
			$order = NULL;
		}
		if ($_POST['lot'] != NULL or $_POST['lot'] != '') {
			$lot = $_POST['lot'];
		} else {
			$lot = NULL;
		}
		if ($_POST['qty'] != NULL or $_POST['qty'] != '') {
			$qty = $_POST['qty'];
		} else {
			$qty = NULL;
		}
		if ($_POST['qty2'] != NULL or $_POST['qty2'] != '') {
			$qty2 = $_POST['qty2'];
		} else {
			$qty2 = NULL;
		}
		if ($_POST['rol'] != NULL or $_POST['rol'] != '') {
			$rol = $_POST['rol'];
		} else {
			$rol = NULL;
		}
		//   $shift = $_POST['shift'];
		//   $shift1 = $_POST['shift2'];
		//   $langganan = $_POST['buyer'];
		//   $order = $_POST['no_order'];
		$jenis_kain = cek_input('jenis_kain');
		$warna = cek_input('warna');
		//   $lot = $_POST['lot'];
		//   $qty = $_POST['qty'];
		// $qty2 = $_POST['qty2'];	
		//   $rol = $_POST['rol'];
		//   $mesin = $_POST['no_mesin'];
		$mesin = cek_input('no_mesin');
		$nmmesin = cek_input('nama_mesin');
		$proses = cek_input('proses');
		$jam_in = cek_input('proses_in');
		$jam_out = cek_input('proses_out');
		if ($_POST['proses_jam'] != NULL or $_POST['proses_jam'] != '') {
			$proses_jam = $_POST['proses_jam'];
		} else {
			$proses_jam = 0;
		}
		if ($_POST['proses_menit'] != NULL or $_POST['proses_menit'] != '') {
			$proses_menit = $_POST['proses_menit'];
		} else {
			$proses_menit = 0;
		}
		//   $proses_menit = cek_input('proses_menit');
		$tgl_proses_in = cek_input('tgl_proses_m');
		$tgl_proses_out = cek_input('tgl_proses_k');

		if ($_POST['stop_jam'] != NULL or $_POST['stop_jam'] != '') {
			$stop_jam = $_POST['stop_jam'];
		} else {
			$stop_jam = 0;
		}
		if ($_POST['stop_menit'] != NULL or $_POST['stop_menit'] != '') {
			$stop_menit = $_POST['stop_menit'];
		} else {
			$stop_menit = 0;
		}
		//   $stop_jam = cek_input('stop_jam');
		//   $stop_menit = cek_input('stop_menit');
	
		// Tambahan
		$no_gerobak = cek_input('no_gerobak');
		$jenis_kartu = cek_input('jenis_kartu');
		$jumlah_gerobak = cek_input('jumlah_gerobak');
		$mulai = cek_input('stop_mulai');
		$mulai2 = cek_input('stop_mulai2');
		$mulai3 = cek_input('stop_mulai3');
		$selesai = cek_input('stop_selesai');
		$selesai2 = cek_input('stop_selesai2');
		$selesai3 = cek_input('stop_selesai3');
		$tgl_stop_m = cek_input('tgl_stop_m');
		$tgl_stop_m2 = cek_input('tgl_stop_m2');
		$tgl_stop_m3 = cek_input('tgl_stop_m3');
		$tgl_stop_s = cek_input('tgl_stop_s');
		$tgl_stop_s2 = cek_input('tgl_stop_s2');
		$tgl_stop_s3 = cek_input('tgl_stop_s3');

		$kd = cek_input('kd_stop');
		$kd2 = cek_input('kd_stop2');
		$kd3 = cek_input('kd_stop3');
		// End
	

		$tgl = cek_input('tgl');
		$acc_kain = cek_input('acc_kain');
		$ket = cek_input('ket');
		$speed = cek_input('speed');
		$lebar = cek_input('lebar');
		$gramasi = cek_input('gramasi');
		$item = cek_input('no_item');
		$now = new DateTime();
		$data = [
			$nokk,
			$nodemand,
			$shift,
			$shift1,
			$mesin,
			$nmmesin,
			$langganan,
			$order,
			$jenis_kain,
			$warna,
			$lot,
			$rol,
			$qty,
			$qty2,
			$proses,
			$jam_in,
			$jam_out,
			$tgl_proses_in,
			$tgl_proses_out,
			$no_gerobak,
			$jenis_kartu,
			$jumlah_gerobak,
			$mulai,
			$mulai2,
			$mulai3,
			$selesai,
			$selesai2,
			$selesai3,
			$tgl_stop_m,
			$tgl_stop_m2,
			$tgl_stop_m3,
			$tgl_stop_s,
			$tgl_stop_s2,
			$tgl_stop_s3,
			$kd,
			$kd2,
			$kd3,
			$now,
			$acc_kain,
			$ket,
			$speed,
			$lebar,
			$gramasi,
			$item,
			$tgl,
			$proses_jam,
			$proses_menit,
			$stop_jam,
			$stop_menit
		];

		$simpanSql = "INSERT INTO db_brushing.tbl_produksi (nokk,nodemand ,
shift,shift1,no_mesin,nama_mesin,langganan,no_order,jenis_kain,warna,lot,rol,qty,qty2,proses,jam_in,jam_out,tgl_proses_in,tgl_proses_out,no_gerobak ,
jenis_kartu ,jumlah_gerobak ,stop_l,stop_2,stop_3,stop_r,stop_r_2,stop_r_3,tgl_stop_l,tgl_stop_2,tgl_stop_3,tgl_stop_r,tgl_stop_r_2,tgl_stop_r_3,kd_stop,
kd_stop2,kd_stop3,tgl_buat,acc_staff,ket,speed,lebar,gramasi,no_item,tgl_update,proses_jam,proses_menit,stop_jam,stop_menit) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$stmt = sqlsrv_prepare($con, $simpanSql, $data);

		if ($stmt === false) {
			die(print_r(sqlsrv_errors(), true));
		}
		$result = sqlsrv_execute($stmt);

		if ($result === false) {
			die(print_r(sqlsrv_errors(), true));
		}
		//   sqlsrv_query($con, $simpanSql) or die("Gagal Simpan" . sqlsrv_errors());
	
		// Refresh form
		echo "<meta http-equiv='refresh' content='0; url=?idkk=$idkk&status=Data Sudah DiSimpan'>";
	} else if (isset($_POST['btnSimpan']) and $_GET['id'] != "") {
		$nodemand = cek_input('demand');
		$langganan = cek_input('buyer');
		$order = cek_input('no_order');
		$jenis_kain =  cek_input('jenis_kain');
		$warna =  cek_input('warna');
		$lot = cek_input('lot');
		$qty = cek_input('qty');
		$qty2 = cek_input('qty2');
		$rol = cek_input('rol');
		$mesin = cek_input('no_mesin');
		$nmmesin = cek_input('nama_mesin');
		$proses = cek_input('proses');
		$shift = cek_input('shift');
		$shift1 = cek_input('shift2');
		$jam_in = cek_input('proses_in');
		$jam_out = cek_input('proses_out');
		$proses_jam = cek_input('proses_jam');
		$proses_menit = cek_input('proses_menit');
		$tgl_proses_in = cek_input('tgl_proses_m');
		$tgl_proses_out = cek_input('tgl_proses_k');

		$stop_jam = cek_input('stop_jam');
		$stop_menit = cek_input('stop_menit');

		// Tambahan
		$no_gerobak = cek_input('no_gerobak');
		$jenis_kartu = cek_input('jenis_kartu');
		$jumlah_gerobak = cek_input('jumlah_gerobak');
		$mulai = cek_input('stop_mulai');
		$mulai2 = cek_input('stop_mulai2');
		$mulai3 = cek_input('stop_mulai3');
		$selesai = cek_input('stop_selesai');
		$selesai2 = cek_input('stop_selesai2');
		$selesai3 = cek_input('stop_selesai3');
		$tgl_stop_m = cek_input('tgl_stop_m');
		$tgl_stop_m2 = cek_input('tgl_stop_m2');
		$tgl_stop_m3 = cek_input('tgl_stop_m3');
		$tgl_stop_s = cek_input('tgl_stop_s');
		$tgl_stop_s2 = cek_input('tgl_stop_s2');
		$tgl_stop_s3 = cek_input('tgl_stop_s3');

		$kd = cek_input('kd_stop');
		$kd2 = cek_input('kd_stop2');
		$kd3 = cek_input('kd_stop3');
		// End
	
		$tgl = cek_input('tgl');
		$acc_kain = cek_input('acc_kain');
		$ket = cek_input('ket');
		$speed = cek_input('speed');
		$lebar = cek_input('lebar');
		$gramasi = cek_input('gramasi');
		$item = cek_input('no_item');
		$simpanSql = "UPDATE db_brushing.tbl_produksi SET 
                nodemand = ?, 
                shift = ?, 
                shift1 = ?, 
                no_mesin = ?, 
                nama_mesin = ?, 
                langganan = ?, 
                no_order = ?, 
                jenis_kain = ?, 
                warna = ?, 
                lot = ?, 
                rol = ?, 
                qty = ?, 
                qty2 = ?, 
                proses = ?, 
                jam_in = ?, 
                jam_out = ?, 
                tgl_proses_in = ?, 
                tgl_proses_out = ?, 
                no_gerobak = ?, 
                jenis_kartu = ?, 
                jumlah_gerobak = ?, 
                stop_l = ?, 
                stop_2 = ?, 
                stop_3 = ?, 
                stop_r = ?, 
                stop_r_2 = ?, 
                stop_r_3 = ?, 
                tgl_stop_l = ?, 
                tgl_stop_2 = ?, 
                tgl_stop_3 = ?, 
                tgl_stop_r = ?, 
                tgl_stop_r_2 = ?, 
                tgl_stop_r_3 = ?, 
                kd_stop = ?, 
                kd_stop2 = ?, 
                kd_stop3 = ?, 
                acc_staff = ?, 
                tgl_update = ?, 
                speed = ?, 
                lebar = ?, 
                gramasi = ?, 
                no_item = ?, 
                ket = ? 
              WHERE id = ?";

		// Prepare the statement
		$params = [
			$nodemand,
			$shift,
			$shift1,
			$mesin,
			$nmmesin,
			$langganan,
			$order,
			$jenis_kain,
			$warna,
			$lot,
			$rol,
			$qty,
			$qty2,
			$proses,
			$jam_in,
			$jam_out,
			$tgl_proses_in,
			$tgl_proses_out,
			$no_gerobak,
			$jenis_kartu,
			$jumlah_gerobak,
			$mulai,
			$mulai2,
			$mulai3,
			$selesai,
			$selesai2,
			$selesai3,
			$tgl_stop_m,
			$tgl_stop_m2,
			$tgl_stop_m3,
			$tgl_stop_s,
			$tgl_stop_s2,
			$tgl_stop_s3,
			$kd,
			$kd2,
			$kd3,
			$acc_kain,
			$tgl,
			$speed,
			$lebar,
			$gramasi,
			$item,
			$ket,
			$_POST['id']
		];

		// Execute the statement
		$stmt = sqlsrv_query($con, $simpanSql, $params);
		if ($stmt === false) {
			die("Gagal Ubah" . print_r(sqlsrv_errors(), true));
		}
		$idk = $_POST['id'];
		// Refresh form
		echo "<meta http-equiv='refresh' content='0; url=?id=$idk&status=Data Sudah DiUbah'>";
	}
	?>
	<form id="form1" name="form1" method="post" action="">
		<table width="100%" border="0">
			<tr>
				<td colspan="8" scope="row">
					<h1>Input Data Produksi Harian Brushing</h1>
				</td>
			</tr>
			<tr>
				<th colspan="8" scope="row">
					<font color="#FF0000"><?php echo $_GET['status']; ?></font>
				</th>
			</tr>
			<tr>
				<td scope="row">
					<h4>Pilih Asal Kartu Kerja</h4>
				</td>
				<td width="1%">:</td>
				<td>
					<select style="width: 40%" id="typekk" name="typekk"
						onchange="window.location='?typekk='+this.value" required>
						<option value="" disabled selected>-Pilih Tipe Kartu Kerja-</option>
						<option value="KKLama" <?php if ($_GET['typekk'] == "KKLama") {
							echo "SELECTED";
						} ?>>KK Lama
						</option>
						<option value="NOW" <?php if ($_GET['typekk'] == "NOW") {
							echo "SELECTED";
						} ?>>KK NOW</option>
						-->
						</select=>

				</td>
			</tr>
			<tr>
				<td width="10%" scope="row">
					<h4>Nokk</h4>
				</td>
				<td width="1%">:</td>
				<td width="30%">
					<input name="nokk" type="text" id="nokk" size="17"
						onchange="window.location='?typekk='+document.getElementById(`typekk`).value+'&idkk='+this.value"
						value="<?= $_GET['idkk'] ?? $rw['nokk'] ; ?>" /><input type="hidden" value="<?php echo $rw['id']; ?>"
						name="id" />

					<?php if ($_GET['typekk'] == 'NOW') { ?>
						<?php if ($_GET['id']): ?>
							<input name="demand" id="demand" type="text" value="<?= $rw['nodemand']; ?>"
								placeholder="Nomor Demand">
						<?php else: ?>
							<select style="width: 40%" name="demand" id="demand"
								onchange="window.location='?typekk='+document.getElementById(`typekk`).value+'&idkk='+document.getElementById(`nokk`).value+'&demand='+this.value"
								required>
								<option value="" disabled selected>Pilih Nomor Demand</option>
								<?php
								$sql_ITXVIEWKK_demand = db2_exec($conn_db2, "SELECT DEAMAND AS DEMAND FROM ITXVIEWKK WHERE PRODUCTIONORDERCODE = '$idkk'");
								while ($r_demand = db2_fetch_assoc($sql_ITXVIEWKK_demand)):
									?>
									<option value="<?= $r_demand['DEMAND']; ?>" <?php if ($r_demand['DEMAND'] == $_GET['demand']) {
										  echo 'SELECTED';
									  } ?>>
										<?= $r_demand['DEMAND']; ?>
									</option>
								<?php endwhile; ?>
							</select>
						<?php endif; ?>
					<?php } else { ?>
						<input name="demand" id="demand" type="text" placeholder="Nomor Demand">
					<?php } ?>
				</td>
				<td width="8%">
					<h4>Group Shift</h4>
				</td>
				<td width="1%">:</td>
				<td width="3%">
					<select name="shift" id="shift" required>
						<option value="">Pilih</option>
						<option value="A" <?php if ($rw['shift'] == "A") {
							echo "SELECTED";
						} ?>>A</option>
						<option value="B" <?php if ($rw['shift'] == "B") {
							echo "SELECTED";
						} ?>>B</option>
						<option value="C" <?php if ($rw['shift'] == "C") {
							echo "SELECTED";
						} ?>>C</option>
					</select>
				</td>
				<td width="4%"><strong>Shift</strong></td>
				<td width="33%">:
					<select name="shift2" id="shift2" required="required">
						<option value="">Pilih</option>
						<option value="Pagi" <?php if ($rw['shift1'] == "Pagi") {
							echo "SELECTED";
						} ?>>Pagi</option>
						<option value="Siang" <?php if ($rw['shift1'] == "Siang") {
							echo "SELECTED";
						} ?>>Siang</option>
						<option value="Malam" <?php if ($rw['shift1'] == "Malam") {
							echo "SELECTED";
						} ?>>Malam</option>
					</select>
				</td>
			</tr>
			<tr>
				<td scope="row">
					<h4>Langganan/Buyer</h4>
				</td>
				<td>:</td>
				<td>
					<?php $langganan_buyer = $dt_pelanggan_buyer['PELANGGAN'] . '/' . $dt_pelanggan_buyer['BUYER']; ?>
					<input name="buyer" type="text" id="buyer" size="45"
						value="<?php if (!empty($rw['langganan'])) {
							echo $rw['langganan'];
						} else {
							echo $langganan_buyer;
						} ?>" />
				</td>
				<td>
					<h4>Tgl Brushing</h4>
				</td>
				<td>:</td>
				<td colspan="3"><input name="tgl" type="text" id="tgl"
						onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl);return false;" size="10"
						placeholder="0000-00-00" required="required" value="<?php echo cek($rw['tgl_update']); ?>" />
					<a href="javascript:void(0)"
						onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl);return false;"><img
							src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal"
							style="border:none" align="absmiddle" border="0" /></a>
				</td>
			</tr>
			<tr>
				<td scope="row">
					<h4>No. Order</h4>
				</td>
				<td>:</td>
				<td>
					<?php if ($_GET['typekk'] == "NOW"): ?>
						<?php $no_order = $dt_ITXVIEWKK['PROJECTCODE']; ?>
					<?php else: ?>
						<?php if ($cek > 0) {
							$no_order = $ssr['documentno'];
						} else if ($rc > 0) {
							// $no_order =  
						} else if ($rcAdm > 0) {
							$no_order = $rwAdm['no_order'];
						} ?>
					<?php endif; ?>
					<input type="text" name="no_order" id="no_order"
						value="<?php if (!empty($rw['no_order'])) {
							echo $rw['no_order'];
						} else {
							echo $no_order;
						} ?>" />
				</td>
				<td>
					<h4>Proses</h4>
				</td>
				<td>:</td>
				<td colspan="3"><select name="proses" id="proses">
						<option value="">Pilih</option>
						<?php $qry1 = sqlsrv_query($con, "SELECT proses,jns FROM db_brushing.tbl_proses ORDER BY id ASC");
						while ($r = sqlsrv_fetch_array($qry1)) {
							?>
							<option value="<?php echo $r['proses'] . " (" . $r['jns'] . ")"; ?>" <?php if ($rw['proses'] == $r['proses'] . " (" . $r['jns'] . ")") {
										 echo "SELECTED";
									 } ?>>
								<?php echo $r['proses'] . " (" . $r['jns'] . ")"; ?>
							</option>
						<?php } ?>
					</select>
					<input type="button" name="btnproses" id="btnproses" value="..."
						onclick="window.open('pages/data-proses.php','MyWindow','height=400,width=650');" />
				</td>
			</tr>
			<tr>
				<td scope="row">
					<h4>No. Gerobak</h4>
				</td>
				<td>:</td>
				<td>
					<input type="text" name="no_gerobak" id="no_gerobak" />
				</td>
				<td>
					<h4>jumlah Gerobak </h4>
				</td>
				<td>:</td>
				<td colspan="3">
					<input type="number" name="jumlah_gerobak" id="jumlah_gerobak" placeholder="0" />

				</td>
			</tr>
			<tr>
				<td valign="top" scope="row">
					<h4>Jenis Kain</h4>
				</td>
				<td valign="top">:</td>
				<td>
					<?php if ($_GET['typekk'] == "NOW"): ?>
						<?php $jk = $dt_ITXVIEWKK['ITEMDESCRIPTION']; ?>
					<?php else: ?>
						<?php if ($cek > 0) {
							$jk = $ssr['productcode'] . " / " . $ssr['description'];
						} else if ($rc > 0) {
							// $jk = $rw['jenis_kain'];
						} else if ($rcAdm > 0) {
							$jk = $rwAdm['jenis_kain'];
						} ?>
					<?php endif; ?>
					<textarea name="jenis_kain" cols="35"
						id="jenis_kain"><?php if (!empty($rw['jenis_kain'])) {
							echo $rw['jenis_kain'];
						} else {
							echo $jk;
						} ?></textarea>
				</td>
				<td valign="top">
					<h4>Keterangan</h4>
				</td>
				<td valign="top">:</td>
				<td colspan="3" valign="top"><textarea name="ket" cols="35"
						id="ket"><?php echo $rw['ket']; ?></textarea></td>
			</tr>
			<tr>
				<td scope="row"><strong>Hanger/Item</strong></td>
				<td>:</td>
				<td>
					<?php $hanger = $dt_ITXVIEWKK['NO_HANGER']; ?>
					<input type="text" name="no_item" id="no_item" value="<?= $hanger; ?>" />
				</td>
				<td><strong>Speed</strong></td>
				<td>:</td>
				<td colspan="3">

					<input type="number" name="speed" id="speed" placeholder="0" />
				</td>
				</td>
			</tr>
			<tr>
				<td scope="row"><strong>Warna</strong></td>
				<td>:</td>
				<td><?php if ($cek > 0) {
					$nama_warna = $ssr['color'];
				} else {
					$nama_warna = $rw['warna'];
				} ?>
					<input name="warna" type="text" id="warna" size="35"
						value="<?= $dt_warna['WARNA']; ?><?= $nama_warna; ?>" />
				</td>
				<td><strong>Lebar X Gramasi</strong></td>
				<td>:</td>
				<td colspan="3"><?php if ($cek > 0) {
					$nlebar = $ssr['cuttablewidth'];
				} else {
					$nlebar = $rw['lebar'];
				} ?>
					<input class="harus_angka" name="lebar" type="text" id="lebar" size="6" placeholder="0" />
					&quot; X
					<?php if ($cek > 0) {
						$ngramasi = $ssr['weight'];
					} else {
						$ngramasi = $rw['gramasi'];
					} ?>
					<input class="harus_angka" name="gramasi" type="text" id="gramasi" size="6" placeholder="0" />
				</td>
			</tr>
			<tr>
				<td scope="row">
					<h4>Lot</h4>
				</td>
				<td>:</td>
				<td><input name="lot" type="text" id="lot" size="5" value="<?= $dt_ITXVIEWKK['LOT']; ?>" /></td>
				<td width="8%"><strong>Quantity</strong></td>
				<td width="1%">:</td>
				<td colspan="3">
					<?php if ($cLot > 0) {
						$berat = $sLot['Weight'];
					} else {
						$berat = $rw['qty'];
					} ?>
					<input class="harus_angka" name="qty" type="text" id="qty" size="5"
						value="<?php if (!empty($berat)) {
							echo $berat;
						} else {
							echo $dt_qtyorder['QTY_ORDER'];
						} ?>"
						placeholder="0.00" />
				</td>
			</tr>
			<tr>
				<td scope="row"><strong>Roll</strong></td>
				<td>:</td>
				<td><input class="harus_angka" name="rol" type="text" id="rol" size="3" placeholder="0" pattern="[0-9]{1,}" value="<?php if ($cLot > 0) {
					echo $sLot['RollCount'];
				} else {
					echo $rw['rol'];
				} ?>" /></td>
				<td><strong>Panjang</strong></td>
				<td>:</td>
				<td colspan="3"><input class="harus_angka" name="qty2" type="text" id="qty2" size="8"
						value="<?php if (!empty($rw['panjang'])) {
							echo $rw['panjang'];
						} else {
							echo $dt_qtyorder['QTY_ORDER_YARD'];
						} ?>"
						placeholder="0.00" onFocus="jumlah();" />
					<strong>Yard</strong>
				</td>
			</tr>
			<tr>
				<td scope="row">
					<h4>Jenis Kartu </h4>
				</td>
				<td>:</td>
				<td>
					<select name="jenis_kartu" id="jenis_kartu">
						<option value="">Pilih</option>
						<option value="Salesman Sample">Salesman Sample</option>
						<option value="Ganti Kain Internal">Ganti Kain Internal</option>
						<option value="Ganti Kain Eksternal">Ganti Kain Eksternal</option>
						<option value="Development Sample">Development Sample</option>
						<option value="Retur">Retur</option>
						<option value="Biasa">Biasa</option>
						<option value="Mini Bulk">Mini Bulk</option>
						<option value="First Lot">First Lot</option>
						<option value="Kain Test">Kain Test</option>
						<option value="Proses 1 /sd 2 Roll">Proses 1 /sd 2 Roll</option>


						<!-- tambahan -->


					</select>

				</td>
				<td>
					<h4>Nama Mesin</h4>
				</td>
				<td>:</td>
				<td colspan="3"><select name="nama_mesin" id="nama_mesin" onchange="myFunction();" required="required">
						<option value="">Pilih</option>
						<?php $qry1 = sqlsrv_query($con, "SELECT nama FROM db_brushing.tbl_mesin ORDER BY nama ASC");
						while ($r = sqlsrv_fetch_array($qry1)) {
							?>
							<option value="<?php echo $r['nama']; ?>" <?php if ($rw['nama_mesin'] == $r['nama']) {
								   echo "SELECTED";
							   } ?>><?php echo $r['nama']; ?></option>
						<?php } ?>
					</select>
					<input type="button" name="btnmesin2" id="btnmesin2" value="..."
						onclick="window.open('pages/mesin.php','MyWindow','height=400,width=650');" />
				</td>
			</tr>
			<tr>
				<td scope="row">
					<h4>Operator</h4>
				</td>
				<td>:</td>
				<td><select name="acc_kain" id="acc_kain">
						<option value="">Pilih</option>
						<?php $qryacc = sqlsrv_query($con, "SELECT nama FROM db_brushing.tbl_staff ORDER BY id ASC");
						while ($racc = sqlsrv_fetch_array($qryacc)) {
							?>
							<option value="<?php echo $racc['nama']; ?>" <?php if ($racc['nama'] == $rw['acc_staff']) {
								   echo "SELECTED";
							   } ?>><?php echo $racc['nama']; ?></option>
						<?php } ?>
					</select>
					<input type="button" name="btnacc" id="btnacc" value="..."
						onclick="window.open('pages/data-acc.php','MyWindow','height=400,width=650');" />
				</td>
				<td><strong>No. Mesin</strong></td>
				<td>:</td>
				<td colspan="3"><select name="no_mesin" id="no_mesin" onchange="myFunction();" required="required">
						<option value="">Pilih</option>
						<?php $qry1 = sqlsrv_query($con, "SELECT no_mesin FROM db_brushing.tbl_no_mesin ORDER BY no_mesin ASC");
						while ($r = sqlsrv_fetch_array($qry1)) {
							?>
							<option value="<?php echo $r['no_mesin']; ?>" <?php if ($rw['no_mesin'] == $r['no_mesin']) {
								   echo "SELECTED";
							   } ?>><?php echo $r['no_mesin']; ?></option>
						<?php } ?>
					</select>
					<input type="button" name="btnmesin" id="btnmesin" value="..."
						onclick="window.open('pages/data-mesin.php','MyWindow','height=400,width=650');" />
				</td>
			</tr>
			<tr>
				<td scope="row">
					<h4>Proses In</h4>
				</td>
				<td>:</td>
				<td>
					<input name="proses_in" type="text" id="proses_in" placeholder="00:00" pattern="[0-9]{2}:[0-9]{2}$"
						title=" e.g 14:25" onkeyup="
			var time = this.value;
			if (time.match(/^\d{2}$/) !== null) {
			  this.value = time + ':';
			} else if (time.match(/^\d{2}\:\d{2}$/) !== null) {
			  this.value = time + '';
			}" value="<?php echo $rw['jam_in'] ?>" size="5" maxlength="5" required />
					<input name="tgl_proses_m" type="text" id="tgl_proses_m"
						onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_proses_m);return false;" size="10"
						placeholder="0000-00-00" value="<?php echo cek($rw['tgl_proses_in']); ?>" />
					<a href="javascript:void(0)"
						onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_proses_m);return false;"><img
							src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal2"
							style="border:none" align="absmiddle" border="0" /></a>
					*
				</td>
				<td>
					<h4>Proses Out</h4>
				</td>
				<td>:</td>
				<td colspan="3">
					<input name="proses_out" type="text" id="proses_out" placeholder="00:00"
						pattern="[0-9]{2}:[0-9]{2}$" title=" e.g 14:25 " onkeyup="
			var time = this.value;
			if (time.match(/^\d{2}$/) !== null) {
			  this.value = time + ':';
			} else if (time.match(/^\d{2}\:\d{2}$/) !== null) {
			  this.value = time + '';
			}" value="<?php echo $rw['jam_out'] ?>" size="5" maxlength="5" required />
					<input name="tgl_proses_k" type="text" id="tgl_proses_k" placeholder="0000-00-00"
						onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_proses_k);return false;"
						value="<?php echo cek($rw['tgl_proses_out']); ?>" size="10" />
					<a href="javascript:void(0)"
						onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_proses_k);return false;"><img
							src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal3"
							style="border:none" align="absmiddle" border="0" /></a>
					*
				</td>
			</tr>
			<tr style="width: 500px;">
				<td colspan="1">
					<h4>Mulai Stop Mesin 1</h4>
				</td>
				<td>:</td>
				<td>
					<input name="stop_mulai" type="text" id="stop_mulai" placeholder="00:00"
						pattern="[0-9]{2}:[0-9]{2}$" title=" e.g 14:25 " onkeyup="
			var time = this.value;
			if (time.match(/^\d{2}$/) !== null) {
			  this.value = time + ':';
			} else if (time.match(/^\d{2}\:\d{2}$/) !== null) {
			  this.value = time + '';
			}" value="<?php echo $rw['stop_l'] ?>" size="5" maxlength="5" />
					<input name="tgl_stop_m" type="text" id="tgl_stop_m" placeholder="0000-00-00"
						onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_stop_m);return false;"
						value="<?php echo cek($rw['tgl_stop_l']); ?>" size="10" />
					<a href="javascript:void(0)"
						onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_stop_m);return false;"><img
							src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal4"
							style="border:none" align="absmiddle" border="0" /></a>
					*
				</td>
				<td>
					<h4>Selesai Stop Mesin 1</h4>
				</td>
				<td>:</td>
				<td colspan="3">
					<input name="stop_selesai" type="text" id="stop_selesai" placeholder="00:00"
						pattern="[0-9]{2}:[0-9]{2}$" title=" e.g 14:25 " onkeyup="
			var time = this.value;
			if (time.match(/^\d{2}$/) !== null) {
			  this.value = time + ':';
			} else if (time.match(/^\d{2}\:\d{2}$/) !== null) {
			  this.value = time + '';
			}" value="<?php echo $rw['stop_r'] ?>" size="5" maxlength="5" />
					<input name="tgl_stop_s" type="text" id="tgl_stop_s" placeholder="0000-00-00"
						onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_stop_s);return false;"
						value="<?php echo cek($rw['tgl_stop_r']); ?>" size="10" />
					<a href="javascript:void(0)"
						onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_stop_s);return false;"><img
							src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal5"
							style="border:none" align="absmiddle" border="0" /></a>*
					<b>Kode Stop 1 : </b>
					<select name="kd_stop" id="kd_stop">
						<option value="">Pilih</option>
						<?php $qry1 = sqlsrv_query($con, "SELECT kode FROM db_brushing.tbl_stop_mesin ORDER BY id ASC");
						while ($r = sqlsrv_fetch_array($qry1)) {
							?>
							<option value="<?php echo $r['kode']; ?>" <?php if ($rw['kd_stop'] == $r['kode']) {
								   echo "SELECTED";
							   } ?>><?php echo $r['kode']; ?></option>
						<?php } ?>
					</select>
					<input type="button" name="btnstop" id="btnstop" value="..."
						onclick="window.open('pages/data-stop.php','MyWindow','height=400,width=650');" />

				</td>

			</tr>
			<tr>
				<td scope="row">
					<h4>Mulai Stop Mesin 2</h4>
				</td>
				<td>:</td>
				<td>
					<input name="stop_mulai2" type="text" id="stop_mulai2" placeholder="00:00"
						pattern="[0-9]{2}:[0-9]{2}$" title=" e.g 14:25 " onkeyup="
			var time = this.value;
			if (time.match(/^\d{2}$/) !== null) {
			  this.value = time + ':';
			} else if (time.match(/^\d{2}\:\d{2}$/) !== null) {
			  this.value = time + '';
			}" value="<?php echo $rw['stop_2'] ?>" size="5" maxlength="5" />
					<input name="tgl_stop_m2" type="text" id="tgl_stop_m2" placeholder="0000-00-00"
						onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_stop_m2);return false;"
						value="<?php echo cek($rw['tgl_stop_2']); ?>" size="10" />
					<a href="javascript:void(0)"
						onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_stop_m2);return false;"><img
							src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal4"
							style="border:none" align="absmiddle" border="0" /></a>
					*
				</td>
				<td>
					<h4>Selesai Stop Mesin 2</h4>
				</td>
				<td>:</td>
				<td colspan="3">
					<input name="stop_selesai2" type="text" id="stop_selesai2" placeholder="00:00"
						pattern="[0-9]{2}:[0-9]{2}$" title=" e.g 14:25 " onkeyup="
			var time = this.value;
			if (time.match(/^\d{2}$/) !== null) {
			  this.value = time + ':';
			} else if (time.match(/^\d{2}\:\d{2}$/) !== null) {
			  this.value = time + '';
			}" value="<?php echo $rw['stop_r_2'] ?>" size="5" maxlength="5" />
					<input name="tgl_stop_s2" type="text" id="tgl_stop_s2" placeholder="0000-00-00"
						onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_stop_s2);return false;"
						value="<?php echo cek($rw['tgl_stop_2']); ?>" size="10" />
					<a href="javascript:void(0)"
						onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_stop_s2);return false;"><img
							src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal5"
							style="border:none" align="absmiddle" border="0" /></a>*
					<b>Kode Stop 2 :</b>
					<select name="kd_stop2" id="kd_stop2">
						<option value="">Pilih</option>
						<?php $qry1 = sqlsrv_query($con, "SELECT kode FROM db_brushing.tbl_stop_mesin ORDER BY id ASC");
						while ($r = sqlsrv_fetch_array($qry1)) {
							?>
							<option value="<?php echo $r['kode']; ?>" <?php if ($rw['kd_stop2'] == $r['kode']) {
								   echo "SELECTED";
							   } ?>><?php echo $r['kode']; ?></option>
						<?php } ?>
					</select>
					<input type="button" name="btnstop" id="btnstop" value="..."
						onclick="window.open('pages/data-stop.php','MyWindow','height=400,width=650');" />

				</td>
			</tr>

			<tr>
				<td scope="row">
					<h4>Mulai Stop Mesin 3</h4>
				</td>
				<td>:</td>
				<td>
					<input name="stop_mulai3" type="text" id="stop_mulai3" placeholder="00:00"
						pattern="[0-9]{2}:[0-9]{2}$" title=" e.g 14:25 " onkeyup="
			var time = this.value;
			if (time.match(/^\d{2}$/) !== null) {
			  this.value = time + ':';
			} else if (time.match(/^\d{2}\:\d{2}$/) !== null) {
			  this.value = time + '';
			}" value="<?php echo $rw['stop_3'] ?>" size="5" maxlength="5" />
					<input name="tgl_stop_m3" type="text" id="tgl_stop_m3" placeholder="0000-00-00"
						onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_stop_m3);return false;"
						value="<?php echo cek($rw['tgl_stop_3']); ?>" size="10" />
					<a href="javascript:void(0)"
						onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_stop_m3);return false;"><img
							src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal4"
							style="border:none" align="absmiddle" border="0" /></a>
					*
				</td>
				<td>
					<h4>Selesai Stop Mesin 3</h4>
				</td>
				<td>:</td>
				<td colspan="4">
					<input name="stop_selesai3" type="text" id="stop_selesai3" placeholder="00:00"
						pattern="[0-9]{2}:[0-9]{2}$" title=" e.g 14:25 " onkeyup="
			var time = this.value;
			if (time.match(/^\d{2}$/) !== null) {
			  this.value = time + ':';
			} else if (time.match(/^\d{2}\:\d{2}$/) !== null) {
			  this.value = time + '';
			}" value="<?php echo $rw['stop_r_3'] ?>" size="5" maxlength="5" />
					<input name="tgl_stop_s3" type="text" id="tgl_stop_s3" placeholder="0000-00-00"
						onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_stop_s3);return false;"
						value="<?php echo cek($rw['tgl_stop_r_3']); ?>" size="10" />
					<a href="javascript:void(0)"
						onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_stop_s3);return false;"><img
							src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal5"
							style="border:none" align="absmiddle" border="0" /></a>*
					<b>Kode Stop 3 :</b>
					<select name="kd_stop3" id="kd_stop3">
						<option value="">Pilih</option>
						<?php $qry1 = sqlsrv_query($con, "SELECT kode FROM db_brushing.tbl_stop_mesin ORDER BY id ASC");
						while ($r = sqlsrv_fetch_array($qry1)) {
							?>
							<option value="<?php echo $r['kode']; ?>" <?php if ($rw['kd_stop3'] == $r['kode']) {
								   echo "SELECTED";
							   } ?>><?php echo $r['kode']; ?></option>
						<?php } ?>
					</select>
					<input type="button" name="btnstop" id="btnstop" value="..."
						onclick="window.open('pages/data-stop.php','MyWindow','height=400,width=650');" />

				</td>
			</tr>

			<tr>
				<td scope="row">&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td scope="row">* Wajib diisi</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td scope="row">&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="8" scope="row"><input type="submit" name="btnSimpan" id="btnSimpan" value="Simpan"
						class="art-button" />
					<input type="button" name="batal" id="batal" value="Batal"
						onclick="window.location.href='index.php'" class="art-button" />
					<input type="button" name="button2" id="button2" value="Kembali"
						onclick="window.location.href='../index.php'" class="art-button" />
					
				</td>
			</tr>
		</table>
	</form>
</body>

</html>