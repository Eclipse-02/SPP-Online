<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="<?php echo media_url('css/bootstrap.min.css') ?>">
</head>
<body>
	<section class="content">
		<div class="row">	
			
			<div class="col-md-12">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal</th>
							<th>Jumlah Bayar</th>
							<th>Keterangan</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if (!empty($bill)) {
							$i =1;
							foreach ($bill as $row): 
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo pretty_date($row['bulan_pay_input_date'],'d F Y',false); ?></td>
									<td align="right"><?php echo 'Rp. ' . number_format($row['bulan_pay_bill'], 0, ',', '.') ?></td>
									<td><?php echo $row['bulan_pay_desc']; ?></td>
									<td>
										<a class="btn btn-danger btn-xs" onclick="return confirm('Anda Akan Menghapus Pembayaran <?php echo $row['bulan_pay_desc'] ?> ?')" title="Hapus" href="<?php echo site_url('manage/payout/delete_pay_bulan/'.$row['payment_payment_id'].'/'.$row['student_student_id'].'/'.$row['bulan_bulan_id'].'/'.$row['bulan_pay_id']) ?>""><span class="glyphicon glyphicon-trash"></span></a>
									</td>
								</tr>

								<?php 
								$i++;
							endforeach; 
							?>
							<tr class="success">
								<td colspan="2"><b>Total Sudah Bayar</b></td>
								<td align="right"><b><?php echo 'Rp. ' . number_format($total_pay, 0, ',', '.') ?></b></td>
								<td colspan="3"><b>Tunggakan Tahun Ini : <?php echo 'Rp. ' . number_format($total-$total_pay, 0, ',', '.') ?></b></td>
							</tr>
							<?php }  ?>				

						</tbody>
					</table>
				</div>
			</div>
		</section>
	</body>
	</html>