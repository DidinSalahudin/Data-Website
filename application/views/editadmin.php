
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
            <h1>Edit Admin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin') ?>">List Admin</a></li>
              <li class="breadcrumb-item active">Edit Admin</li>
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
                <h3 class="card-title">Form Edit Admin</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="user" method="post" action="<?php echo base_url('admin/edit/update/'.$kd_admin) ?>">
                <div class="card-body">
                  <div class="form-group">
                    <label for="Kode Admin">Kode Admin</label>
                    <input type="text" class="form-control" id="" placeholder="Kode Admin" required="" name="kd_admin" value="<?php echo $kd_admin; ?>" disabled>
                  </div>
                  <div class="form-group">
                    <label for="nama">Nama Lengkap Admin</label>
                    <input type="text" class="form-control" id="" placeholder="Nama Lengkap Admin" required="" name="name" value="<?php echo $nama_admin; ?>">
                    <?php if (form_error('name')) { ?> <small class="text-danger"> <?php echo form_error('name');?> </small> <?php } ?>
                  </div>
                  <div class="form-group">
                    <label for="nama">Email Admin</label>
                    <input type="text" class="form-control" id="" placeholder="Email Admin" required="" name="email" value="<?php echo $email_admin; ?>">
                    <?php if (form_error('email')) { ?> <small class="text-danger"> <?php echo form_error('email');?> </small> <?php } ?>
                  </div>
                  <div class="form-group">
                    <label for="nama">Nomor HP</label>
                    <input type="text" class="form-control" id="" placeholder="Nomor HP" required="" name="no_hp" value="<?php echo $no_hp_admin; ?>">
                  </div>
                  <div class="form-group">
                    <label for="nama">Username Admin</label>
                    <input type="text" class="form-control" id="" placeholder="Username Admin" required="" name="username" value="<?php echo $username_admin; ?>">
                    <?php if (form_error('username')) { ?> <small class="text-danger"> <?php echo form_error('username');?> </small> <?php } ?>
                  </div>
                  <div class="form-group">
                    <label for="nama">Pilih Hak Akses</label>
                    <?php 
                      if ($level_admin == '1') {
                        $selectPenjaga  = '';
                        $selectOwner    = 'selected';
                      } else {
                        $selectPenjaga  = 'selected';
                        $selectOwner    = '';
                      }
                    ?>
                    <select name="level" class="form-control js-example-basic-single" required >
                      <option value="" selected disabled="">Pilih Hak Akses</option>
                      <option value="2" <?php echo $selectPenjaga; ?>>Penjaga</option>
                      <option value="1" <?php echo $selectOwner; ?>>Owner</option>
                    </select>
                  </div>
                </div>
                 <?php echo form_error('password'); ?>
                <div class="card-footer">
                  <a href="<?php echo base_url('admin') ?>" class="btn btn-default">Kembali</a>
                  <input type="submit" class="btn btn-primary pull-right" value="Update Akun">
                </div>
              </div>
              </form>
            </div>
            <!-- /.card -->
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
<!-- InputMask -->
<script src="<?php echo base_url('assets') ?>/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url('assets') ?>/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url('assets') ?>/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="<?php echo base_url('assets/dist/') ?>jquery.mask.min.js"></script>
</body>
</html>
