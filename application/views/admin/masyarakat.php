<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <?= validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  </div>') ?>
  <?= $this->session->flashdata('msg'); ?>

  <div class="row">
    <div class="col-lg-6">

      <?= form_open('Admin/MasyarakatController'); ?>

      <div class="form-group">
        <label for="nama">Nama Lengkap</label>
        <input type="text" class="form-control" id="nama" placeholder="Masukan Nama Lengkap" name="username" value="<?= set_value('nama') ?>">
      </div>

      <div class="form-group">
        <label for="alamat">alamat</label>
        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukan alamat" value="<?= set_value('alamat') ?>">
      </div>

      <div class="form-group">
        <label for="telp">No.Telepon</label>
        <input type="text" class="form-control" id="telp" placeholder="Masukan Nomor Telepon" name="telp" value="<?= set_value('telp') ?>">
      </div>

      <button type="submit" class="btn btn-primary">Simpan</button>
      <?= form_close(); ?>
    </div>
  </div>

  <!-- Page Heading -->
  <!-- <h1 class="h3 mb-4 mt-5 text-gray-800">Data Petugas</h1> -->

  <!-- <a href="#" class="btn btn-success">Tambah Data</a>
  <p></p> -->
  <p></p>

  <div class="table-responsive">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nama</th>
          <th scope="col">Alamat</th>
          <th scope="col">Telp</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; ?>
        <?php foreach ($data_masyarakat as $dp) : ?>
          <tr>
            <th scope="row"><?= $no++; ?></th>
            <td><?= $dp['username']; ?></td>
            <td><?= $dp['alamat']; ?></td>
            <td><?= $dp['telp']; ?></td>
            <!-- <td><?= $dp['level']; ?></td> -->
            <td>
              <a href="<?= base_url('Admin/MasyarakatController/edit/' . $dp['id_masyarakat']) ?>" class="btn btn-info">Edit</a>
              <a href="<?= base_url('Admin/MasyarakatController/delete/' . $dp['id_masyarakat']) ?>" class="btn btn-warning">Hapus</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- /.container-fluid -->
</div>