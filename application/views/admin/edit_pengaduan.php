<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <a href="<?= base_url('Admin/PengaduanController') ?>" class="btn btn-dark"><i class="fas fa-arrow-left"></i></a>
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <?= validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">','<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  </div>') ?>
  <?= $this->session->flashdata('msg'); ?>

  <div class="row">
    <div class="col-lg-6">
      <?= form_open_multipart('Admin/PengaduanController/edit/'.$pengaduan['id_pengaduan']); ?>
      <div class="form-group">
        <label for="nama_pelanggan">Nama Pelanggan</label>
        <input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan" value="<?= $pengaduan['nama_pelanggan'] ?>">
      </div>

      <div class="form-group">
        <label for="alamat">Alamat</label>
        <input type="text" class="form-control" name="alamat" id="alamat" value="<?= $pengaduan['alamat'] ?>">
      </div>

      <div class="form-group">
        <label for="isi_laporan">Isi Laporan</label>
        <input type="text" class="form-control" name="isi_laporan" id="isi_laporan" value="<?= $pengaduan['isi_laporan'] ?>">
      </div>     

      <div class="form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      <?php form_close(); ?>

    </div>
  </div>

  </div>
  <!-- /.container-fluid -->
