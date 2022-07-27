<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

	<?php if ($laporan) : ?>
		<table class="table">
			<thead class="thead-dark">
				<tr>
					<th scope="col">No</th>
					<!-- <th scope="col">Nama</th> -->
					<th scope="col">id_masyarakat</th>
					<th scope="col">Laporan</th>
					<th scope="col">Tgl Pengaduan</th>
					<th scope="col">Status</th>
					<th scope="col">Tanggapan</th>
					<th scope="col">Tgl Tanggapan</th>
				</tr>
			</thead>
			<tbody>

				<?php $no = 1; ?>
				<?php foreach ($laporan as $l) : ?>
					<tr>
						<th scope="row"><?= $no++; ?></th>
						<!-- <td><?= $l['username'] ?></td> -->
						<td><?= $l['id_masyarakat'] ?></td>
						<td><?= $l['isi_laporan'] ?></td>
						<td><?= $l['tgl_pengaduan'] ?></td>
						<td>
							<?php
							if ($l['status'] == '0') :
								echo '<span class="badge badge-secondary">Sedang di verifikasi</span>';
							elseif ($l['status'] == 'proses') :
								echo '<span class="badge badge-primary">Sedang di proses</span>';
							elseif ($l['status'] == 'selesai') :
								echo '<span class="badge badge-success">Selesai di kerjakan</span>';
							elseif ($l['status'] == 'tolak') :
								echo '<span class="badge badge-danger">Pengaduan di tolak</span>';
							else :
								echo '-';
							endif;
							?>
						</td>
						<td><?= $l['tanggapan'] == null ? '-' : $l['tanggapan']; ?></td>
						<td><?= $l['tgl_tanggapan'] == null ? '-' : $l['tgl_tanggapan']; ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>



	<?php else : ?>
		<p class="text-center">Belum ada data</p>
	<?php endif; ?>
</div>
<!-- /.container-fluid -->