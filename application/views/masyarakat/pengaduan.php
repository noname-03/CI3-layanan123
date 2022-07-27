<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <?= validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  </div>') ?>
  <?= $this->session->flashdata('msg'); ?>

  <div class="row">
    <div class="col-lg-6">
      <?= form_open_multipart('Admin/PengaduanController'); ?>
      <div class="form-group">
        <label for="id_masyarakat">id_masyarakat</label>
        <input name="id_masyarakat" id="id_masyarakat" class="form-control"></input>
      </div>

      <div class="form-group">
        <label for="nama_pelanggan">Nama Pelanggan</label>
        <input name="nama_pelanggan" id="nama_pelanggan" class="form-control"></input>
      </div>

      <div class="form-group">
        <label for="no_tlp">No Telepon</label>
        <input name="no_tlp" id="no_tlp" class="form-control"></input>
      </div>

      <div class="form-group">
        <label for="alamat">Alamat</label>
        <input name="alamat" id="alamat" class="form-control"></input>
      </div>

      <div class="form-group">
        <label for="isi_laporan">Isi Laporan</label>
        <textarea name="isi_laporan" id="isi_laporan" cols="30" rows="10" class="form-control"></textarea>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      <?php form_close(); ?>

    </div>
  </div>


  <!-- Page Heading -->
  <h1 class="h3 mb-4 mt-5 text-gray-800">Data Pengaduan</h1>

  <div class="table-responsive">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nama</th>
          <th scope="col">No Telepon</th>
          <th scope="col">Alamat</th>
          <th scope="col">Isi Laporan</th>
          <th scope="col">Tgl Melapor</th>
          <th scope="col">Status</th>
          <th scope="col">Lihat Detail</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; ?>
        <?php foreach ($data_pengaduan as $dp) : ?>
          <tr>
            <th scope="row"><?= $no++; ?></th>
            <td><?= $dp['nama']; ?></td>
            <td><?= $dp['no_tlp']; ?></td>
            <td><?= $dp['alamat']; ?></td>
            <td><?= $dp['isi_laporan']; ?></td>
            <td><?= $dp['tgl_pengaduan']; ?></td>
            </td>
            <td>
              <?php
              if ($dp['status'] == '0') :
                echo '<span class="badge badge-secondary">Sedang di verifikasi</span>';
              elseif ($dp['status'] == 'proses') :
                echo '<span class="badge badge-primary">Sedang di proses</span>';
              elseif ($dp['status'] == 'selesai') :
                echo '<span class="badge badge-success">Selesai di kerjakan</span>';
              elseif ($dp['status'] == 'tolak') :
                echo '<span class="badge badge-danger">Pengaduan di tolak</span>';
              else :
                echo '-';
              endif;
              ?>
            </td>

            <td class="text-center">
              <a href="<?= base_url('Admin/PengaduanController/pengaduan_detail/' . $dp['id_pengaduan']) ?>" class="btn btn-success"><i class="fas fa-fw fa-eye"></i></a>
            </td>

            <?php if ($dp['status'] == '0') : ?>
              <td>
                <a href="<?= base_url('Admin/PengaduanController/pengaduan_batal/' . $dp['id_pengaduan']) ?>" class="btn btn-sm btn-warning">Hapus</a>

                <a href="<?= base_url('Admin/PengaduanController/edit/' . $dp['id_pengaduan']) ?>" class="btn btn-sm btn-info">Edit</a>
              </td>

            <?php else : ?>
              <td><small>Tidak ada aksi</small></td>
            <?php endif; ?>


          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>


</div>
<!-- /.container-fluid -->