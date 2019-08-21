
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
            <h1>Ganti Password Admin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin') ?>">List Admin</a></li>
              <li class="breadcrumb-item active">Ganti Password Admin</li>
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
                <h3 class="card-title">Form Ganti Password Admin</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="user" method="post" action="<?php echo base_url('admin/ganti_password/update/'.$kd_admin) ?>">
                <div class="card-body">
                  <div class="form-group">
                    <label for="Kode Admin">Password Lama</label>
                    <input type="Password" name="password" id="password_lama" class="form-control" placeholder="Password" require>
                    <span class="errorPassLama" style="color:red"></span><br/>
                  </div>
                  <div class="form-group">
                    <label for="nama">Password</label>
                    <input type="Password" name="password" id="password" class="form-control" placeholder="Password" require>
                    <span id="result"></span><br/>
                  </div>
                  <div class="form-group">
                    <label for="nama">Ulangi Password</label>
                    <input type="Password" name="ulangi_password" id="ulangi_password" class="form-control" placeholder="Ulangi Password" require>
                    <span class="error"></span><br/>
                  </div>
                </div>
                 <?php echo form_error('password'); ?>
                <div class="card-footer">
                  <a href="<?php echo base_url('admin') ?>" class="btn btn-default">Kembali</a>
                  <input type="submit" name="submit" class="btn btn-primary pull-right btn-md enableOnInput" disabled="disabled" value="Ganti Password">
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

<script>

  var kd_admin = '<?php echo $kd_admin; ?>';
  var password = '<?php echo $password_admin; ?>';
  var allowsubmit = false;
  $(document).ready(function(){

    $('#password_lama').keyup(function(){

      var inputpassword = $(this).val();
      var jqxhr = $.getJSON( "<?php echo base_url('admin/get_password'); ?>?password="+inputpassword+"&kd_admin="+kd_admin, function() {})
      .done(function(data) {
        console.log(data);
        if(data == true) {
          $('.errorPassLama').text('Password sesuai').css('color', '#02d124');
          $('#cekPass').val(data);
          allowsubmit = true;
          $('.enableOnInput').prop('disabled',false);
        } else {
          $('.errorPassLama').text('Password tidak sesuai').css('color','#ce0f02');
          $('#cekPass').val(data);
          allowsubmit = false;
          $('.enableOnInput').prop('disabled',true);
        }
      })
      .fail(function() {
        alert('Password tidak sesuai').css('color','#ce0f02');
      });
    });
    
    $('#password').keyup(function(e){
      //get values          
      var pass = $(this).val();
      var confpass = $('#ulangi_password').val();
      //check the strings
      if(pass == confpass){
        //if both are same remove the error and allow to submit
        $('.error').text('Password sesuai').css('color', '#02d124');
        allowsubmit = true;
        $('.enableOnInput').prop('disabled',false);
      }else{
        //if not matching show error and not allow to submit
        $('.error').text('Password tidak sesuai').css('color','#ce0f02');
        allowsubmit = false;
        $('.enableOnInput').prop('disabled',true);
      }
    });

    //on keypress 
    $('#ulangi_password').keyup(function(e){
      //get values 
      var pass = $('#password').val();
      var confpass = $(this).val();
      //check the strings
      if(pass == confpass){
        //if both are same remove the error and allow to submit
        $('.error').text('Password sesuai').css('color', '#02d124');
        allowsubmit = true;
        $('.enableOnInput').prop('disabled',false);
        
      }else{
        //if not matching show error and not allow to submit
        $('.error').text('Password tidak sesuai').css('color','#ce0f02');
        allowsubmit = false;
        $('.enableOnInput').prop('disabled',true);
      }
    });

    //jquery form submit
    $('#form').submit(function(){
    
      var pass = $('#password').val();
      var confpass = $('#ulangi_password').val();
      //just to make sure once again during submit
      //if both are true then only allow submit
      if(pass == confpass){
        allowsubmit = true;
      }
      if(allowsubmit){
        return true;
      }else{
        return false;
      }
    });

    // $("#oldPassword").password('toggle');
    // $("#pass").password('toggle');
    // $("#confpass").password('toggle');
  });
</script>
<script>
  $(document).ready(function() {
    $('#password').keyup(function() {
      $('#result').html(checkStrength($('#password').val()))
    })
    function checkStrength(password) {
    var strength = 0
      if (password.length < 8) {
        $('#result').removeClass()
        $('#result').addClass('short')
        return 'Kurang Dari 8 Karakter'
      }
      if (password.length > 8) strength += 1
      // If password contains both lower and uppercase characters, increase strength value.
      // if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1
      // If it has numbers and characters, increase strength value.
      // if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1
      // If it has one special character, increase strength value.
      // if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
      // If it has two special characters, increase strength value.
      // if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
      // Calculated strength value, we can return messages
      // If value is less than 2
      if (strength < 2) {
        $('#result').removeClass()
        $('#result').addClass('Good')
        return 'Good'
      } 
      // else if (strength == 2) {
      //   $('#result').removeClass()
      //   $('#result').addClass('good')
      //   return 'Good'
      // } else {
      //   $('#result').removeClass()
      //   $('#result').addClass('strong')
      //   return 'Strong'
      // }
    }
  });
</script>
<script type="text/javascript">
$(function () {
  $("#password_lama").password('toggle');
  $("#password").password('toggle');
  $("#ulangi_password").password('toggle');
});
</script>
</body>
</html>
