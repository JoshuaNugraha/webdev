<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Register | Pharm Care</title>
  <!-- Favicon icon -->
  <link rel="icon" href="<?=base_url()?>assets/images/pharmacy.png" type="image/x-icon">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?=base_url()?>assets/template/assets/css/style.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/template/assets/css/components.css">

  <link rel="stylesheet" href="<?=base_url();?>assets/vendor/sweetalert/sweetalert.css">

</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
              <img src="<?=base_url()?>assets/images/pharmacy-logo.png" alt="logo" height="100" >
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Register</h4></div>

              <div class="card-body">
                <form id="form_data">

                  <div class="form-group">
                    <label for="email">Register For</label> &nbsp;&nbsp;&nbsp;
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="register_type" onclick="check_type();" id="apoteker" value="apoteker" checked>
                      <label class="form-check-label" for="apoteker">Apoteker</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="register_type" onclick="check_type();" id="pasien" value="pasien">
                      <label class="form-check-label" for="pasien">Pasien</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" autofocus>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password</label>
                      <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password">
                      
                    </div>
                    <div class="form-group col-6">
                      <label for="password2" class="d-block">Password Confirmation</label>
                      <input id="password2" type="password" class="form-control" name="password2">
                    </div>
                  </div>

                  <div class="form-divider">
                    Informasi Pribadi
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="first_name">Nama Depan</label>
                      <input id="first_name" type="text" class="form-control" name="first_name">
                    </div>
                    <div class="form-group col-6">
                      <label for="last_name">Nama Belakang</label>
                      <input id="last_name" type="text" class="form-control" name="last_name">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-5" id="input_negara_praktik">
                      <label>Negara Praktik</label>
                      <input type="text" class="form-control" name="negara_praktik" id="negara_praktik">
                    </div>
                    <div class="form-group col-4">
                      <label>Profesi</label>
                      <input type="text" class="form-control" name="profesi" id="profesi">
                    </div>
                    <div class="form-group col-3">
                      <label>Title</label>
                      <input type="text" class="form-control" name="title" id="title">
                    </div>
                    <div class="form-group col-5" id="input_no_apoteker">
                      <label>No. Registrasi Apoteker</label>
                      <input type="text" class="form-control" name="no_apoteker" id="no_apoteker">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-8">
                      <label>Tempat Lahir</label>
                      <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir">
                    </div>
                    <div class="form-group col-4">
                      <label>Tanggal Lahir</label>
                      <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir">
                    </div>
                  </div>
                  <div class="row" id="input_apoteker">
                    <div class="form-group col-6">
                      <label>No. Sertifikat Kompetensi</label>
                      <input type="text" class="form-control" name="no_sertifikat" id="no_sertifikat">
                    </div>
                    <div class="form-group col-6">
                      <label>No. STRA</label>
                      <input type="text" class="form-control" name="no_stra" id="no_stra">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label>No. Handphone</label>
                      <input type="text" class="form-control" name="no_hp" id="no_hp" onkeypress="validate_number(event)">
                    </div>
                  </div>  

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                      <label class="custom-control-label" for="agree">Saya menyetujui <u>Ketentuan Penggunaan</u> 
                        dan <u>Kebijakan Privasi</u> dan saya secara sukarela menyetujui pemrosesan data pribadi saya
                        sebagaimana diatur dalam <u>Kebijakan Privasi</u></label>
                    </div>
                  </div>

                  <div class="form-group">
                    <button onclick="register();return false;" class="btn btn-primary btn-lg btn-block">
                      Register
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; Pharm Care <?=date('Y')?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="<?=base_url()?>assets/template/assets/js/stisla.js"></script>

  <!-- Template JS File -->
  <script src="<?=base_url()?>assets/template/assets/js/scripts.js"></script>
  <script src="<?=base_url()?>assets/template/assets/js/custom.js"></script>

  <script src="<?=base_url();?>assets/vendor/sweetalert/sweetalert.min.js"></script>

  <script type="text/javascript">
    function validate_number(evt) {
        var theEvent = evt || window.event;
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode( key );
        var regex = /^[0-9.\b]+$/;
        if( !regex.test(key) ) {
          theEvent.returnValue = false;
          if(theEvent.preventDefault) theEvent.preventDefault();
        }
    }

    function get_token(callback){
      $.ajax({
        async: true,
        dataType: 'json',
        url: "<?php echo base_url('get_token_client'); ?>",
        success: function (data) {
            typeof callback === 'function' && callback(data);
        }
      })
    }

    function load_error(jqXHR, exception){
        var msg = '';
        if (jqXHR.status === 0) {
            msg = 'Koneksi Terputus.\n Periksa Koneksi Internet Anda.';
        } else if (jqXHR.status == 404) {
            msg = 'Halaman Tidak Ditemukan';
        } else if (jqXHR.status == 500) {
            msg = 'Terjadi Kesalahan';
        } else if (exception === 'parsererror') {
            msg = 'Requested JSON parse failed.';
        } else if (exception === 'timeout') {
            msg = 'Time out error.';
        } else if (exception === 'abort') {
            msg = 'Ajax request aborted.';
        } else {
            msg = 'Uncaught Error.\n' + jqXHR.responseText;
        }
        swal('', msg, "warning");
    }

    $(document).ready(function(){
      check_type();
    })

    function check_type(){
      if(document.getElementById('apoteker').checked){
        $('#input_no_apoteker').hide(300);   
        $('#input_negara_praktik').show(300);
        $('#input_apoteker').show(300);
        document.getElementById("pasien").checked = false;
        document.getElementById("apoteker").checked = true;
      }
      else{
        $('#input_negara_praktik').hide(300);
        $('#input_apoteker').hide(300);
        $('#input_no_apoteker').show(300);   
        document.getElementById("apoteker").checked = false;
        document.getElementById("pasien").checked = true;
      } 
    }

    function register(){
        if($('#email').val() == ''){
            swal('Warning','Email tidak boleh kosong..','warning');
            return false;
        }

        if($('#password').val() == ''){
            swal('Warning','Password tidak boleh kosong..','warning');
            return false;
        }

        var password = $('#password').val();
        var password2 = $('#password2').val();
        if(password != password2){
            swal('Warning','Password tidak valid..','warning');
            return false;
        }

        if($('#first_name').val() == ''){
            swal('Warning','Nama depan tidak boleh kosong..','warning');
            return false;
        }

        if($('#last_name').val() == ''){
            swal('Warning','Nama belakang tidak boleh kosong..','warning');
            return false;
        }

        if($('#first_name').val() == ''){
            swal('Warning','Nama depan tidak boleh kosong..','warning');
            return false;
        }

        if($('#negara_praktik').val() == '' && document.getElementById('apoteker').checked){
            swal('Warning','Negara praktik tidak boleh kosong..','warning');
            return false;
        }

        if($('#profesi').val() == ''){
            swal('Warning','Profesi tidak boleh kosong..','warning');
            return false;
        }
        
        if($('#title').val() == '' && document.getElementById('apoteker').checked){
            swal('Warning','Title tidak boleh kosong..','warning');
            return false;
        }

        if($('#tempat_lahir').val() == '' && document.getElementById('apoteker').checked){
            swal('Warning','Tempat lahir tidak boleh kosong..','warning');
            return false;
        }
        if($('#tgl_lahir').val() == '' && document.getElementById('apoteker').checked){
            swal('Warning','Tanggal lahir tidak boleh kosong..','warning');
            return false;
        }

        if($('#no_apoteker').val() == '' && document.getElementById('pasien').checked){
            swal('Warning','No. registrasi apoteker tidak boleh kosong..','warning');
            return false;
        }

        if($('#no_sertifikat').val() == '' && document.getElementById('apoteker').checked){
            swal('Warning','No. sertifikat kompetensi tidak boleh kosong..','warning');
            return false;
        }

        if($('#no_stra').val() == '' && document.getElementById('apoteker').checked){
            swal('Warning','No. STRA tidak boleh kosong..','warning');
            return false;
        }

        if($('#no_hp').val() == ''){
            swal('Warning','No. Handphone tidak boleh kosong..','warning');
            return false;
        }

        if($("#agree").prop('checked') == false){
            swal('Warning','Anda harus menyetujui kebijakan dan privasi pharm care..','warning');
            $('#agree').focus();
            return false;
        }

        get_token(function(data){
            var formData = new FormData($('#form_data')[0]);
            formData.append(['csrf_am'], data.csrf_token);

            $.ajax({
                type : "POST",
                url : '<?=base_url('index.php/account/simpan_registrasi');?>',
                data : formData,
                contentType : false,
                processData : false,
                dataType: "JSON",
                success : function (data){
                    if(data.status == true){
                        swal({
                            title: 'Success',
                            text: data.message,
                            confirmButtonClass: 'btn btn-success btn-bordered',
                            type: "success",
                            showConfirmButton: true,
                        },function () {
                            window.location.replace("<?=base_url()?>login");
                        });
                    }else{
                        swal('Warning', data.message, "warning");
                    }
                },
                error: function (jqXHR, exception) {
                    load_error(jqXHR, exception);
                }
            });
        })
    }
</script>

</body>
</html>
