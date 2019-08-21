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
							<tbody align="center">
								<tr>
									<td colspan="2" align="center"><font size='6'>ParkirinAja</font></td>
								</tr>
								<tr>
									<td colspan="2">=============================</td>
								</tr>
								<tr>
									<td><?php echo $tgl_masuk; ?></td>
								</tr>
								<tr>
									<td><img src="<?php echo base_url(); ?>/assets/img/qrcode/<?php echo $kd_masuk; ?>.png" height="142" width="142"><br><?php echo $kd_masuk; ?></td>
								</tr>
								<tr>
									<td>=============================</td>
								</tr>
								<tr>
									<td><font size='2'>SIMPANLAH TIKET DENGAN AMAN<br>KERUSAKAN DAN KEHILANGAN BARANG BUKAN TANGGUNG JAWAB PENGELOLA<br>KEHILANGAN TIKET PARKIR DI KENAKAN DENDA Rp.10.000,-</font></td>
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
