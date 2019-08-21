<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- css -->
  <?php $this->load->view('include/base_css'); ?>
  <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/datatables/dataTables.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini">
<!-- navbar -->
<?php $this->load->view('include/base_nav'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List Admin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin') ?>">List Admin</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

       <div class="container-fluid">
            <div class="row">
              <!-- left column -->
              <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-default">
                  <div class="card-header">
                    <h3 class="card-title"><a href="<?php echo base_url('admin/daftar') ?>" class="btn btn-primary">Tambah Admin</a></h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Kode Admin</th>
                          <th>Nama</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Level</th>
                          <th>AKSI</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1;foreach ($admin as $row) { ?>
                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $row['kd_admin']; ?></td>
                            <td><?php echo $row['nama_admin']; ?></td>
                            <td><?php echo $row['username_admin']; ?></td>
                            <td><?php echo $row['email_admin']; ?></td>
                            <td><?php if ($row['level_admin'] == '1') { ?>
                              <span class="badge bg-primary">OWNER</span>
                            <?php }else{ ?>
                              <span class="badge bg-danger">PENJAGA</span>
                            <?php } ?>
                            </td>
                            <td align="center"><a href="<?php echo base_url('admin/edit/edit/'.$row['kd_admin']) ?>" title="Edit"><i class="fa fa-edit"></i></a> | <a href="<?php echo base_url('admin/ganti_password/edit/'.$row['kd_admin']) ?>" title="Ganti Password"><i class="fa fa-key"></i></a> | <a href="<?php echo base_url('admin/deleteAdmin/'.$row['kd_admin']) ?>" title="Hapus"><i class="fa fa-trash"></i></a></td>
                          </tr>
                        <?php } ?>
                      </tfoot>
                    </table>
                  </div>
                  </div>
                  <!-- /.card -->
                </div>
              </div>
            </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- footer -->
  <?php $this->load->view('include/base_footer'); ?>

</div>
<!-- ./wrapper -->

<!-- script -->
<?php $this->load->view('include/base_js'); ?>
<script src="<?php echo base_url('assets') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
      <script src="<?php echo base_url('assets') ?>/plugins/datatables/dataTables.bootstrap4.min.js"></script>
      <!-- page script -->
      <script>
        $(function () {
          $("#example1").DataTable();
          $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
          });
        });
      </script>
</body>
</html>
