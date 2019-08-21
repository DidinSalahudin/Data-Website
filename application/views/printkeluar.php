<!DOCTYPE html>
<html>
	<head>
		<title></title>
	</head>
	<body>
		<table class="table-data" border='1' width="250">
			<tbody align="center">
				<tr>
					<td>
						<table class="table-data" width="250">
							<tbody>
								<tr>
									<td colspan="2" align="center"><font size='6'>ParkirinAja</font></td>
								</tr>
								<tr>
									<td colspan="2">=============================</td>
								</tr>
								<?php 
									$sql = $this->db->query("SELECT * FROM tbl_masuk, tbl_kendaraan WHERE tbl_masuk.kd_kendaraan = tbl_kendaraan.kd_kendaraan AND tbl_masuk.kd_masuk = '".$kd_masuk."' "); 
									$rr = $sql->row_array();
								?>
								<tr>
									<td width="80">Jenis</td>
									<td>: <?php echo $rr['nama_kendaraan']; ?></td>
								</tr>
								<tr>
									<td width="50">Penjaga</td>
									<td>: <?php echo $create_keluar; ?></td>
								</tr>
								<tr>
									<td width="50">Masuk</td>
									<td>: <?php echo $tgl_jam_masuk; ?></td>
								</tr>
								<tr>
									<td width="50">Keluar</td>
									<td>: <?php echo $tgl_jam_keluar; ?></td>
								</tr>
								<tr>
									<td width="50">Lama Parkir</td>
									<td>: <?php echo $lama_parkir_keluar; ?></td>
								</tr>
								<tr>
									<td width="50">Sewa Parkir</td>
									<td>: Rp. <?php echo number_format($total_keluar,0,',','.'); ?></td>
								</tr>
								<tr>
									<td colspan="2">=============================</td>
								</tr>
								<tr>
									<td align="center" colspan="2"><font size='2'>TERIMA KASIH ATAS KUNJUNGAN ANDA</font></td>
								</tr>							
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
		<script type="text/javascript">
			window.print();
		</script>
	</body>
</html>
