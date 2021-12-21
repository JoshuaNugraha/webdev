<?php $app = $this->db->get("pengaturan")->row() ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?=$title?> | <?= $app->app_name ?></title>
  <!-- Favicon icon -->
  <link rel="icon" href="<?=base_url()?>assets/images/<?= $app->favicon ?>" type="image/x-icon">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  
  <!-- DataTables -->
  <link rel="stylesheet" href="<?=base_url()?>assets/vendor/datatables-bs4/css/dataTables.bootstrap4.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?=base_url()?>assets/template/assets/css/style.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/template/assets/css/components.css">

  <link rel="stylesheet" href="<?=base_url();?>assets/vendor/sweetalert/sweetalert.css">

  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/select2/css/select2.min.css">
  <style>
    
    .show-read-more .more-text{
        display: none;
    }
 
    .modal2 {
        display:    none;
        position:   fixed;
        z-index:    9999;
        top:        0;
        left:       0;
        height:     100%;
        width:      100%;
        background: rgba( 255, 255, 255, .8 ) 
                    url('<?=base_url()?>assets/images/loading blue.gif') 
                    50% 50% 
                    no-repeat;
    }

    .main-sidebar .sidebar-menu li ul.dropdown-menu li a {
    line-height: 18px;
    height: auto;
    padding-top: 10px;
    padding-bottom: 10px;
    }

    /* When the body has the loading class, we turn
        the scrollbar off with overflow:hidden */
    body.loading {
        overflow: hidden;   
    }

    /* Anytime the body has the loading class, our
        modal element will be visible */
    body.loading .modal2 {
        display: block;
    }
    
    .btn_me {
        font-size: 2.5vh !important;
        width: 100%;
        margin-bottom: 20px;
        margin: 5px;
    }
    .btn_numb{
        font-size: 4vh !important;
        width: 100%;
        margin: 5px;
        height: 60px;
    }
    .typeahead{
        top:0px !important;
        right: unset !important;
        left:0px !important;
        position: relative !important;
    }
    .select2{
      font-size: 14px;
      margin-bottom:10px;
    }
    .select2-selection{
      padding: 6px 12px;
      height: 42px !important;
    }
    .select2-container--default .select2-selection--single{
      border: 1px solid #e4e6fc;
    }

  </style>

  <script src="<?=base_url()?>assets/vendor/jquery/js/jquery.min.js"></script>
  <script src="<?=base_url()?>assets/vendor/datatables/jquery.dataTables.js"></script>
  <script src="<?=base_url()?>assets/vendor/datatables-bs4/js/dataTables.bootstrap4.js"></script>

  <script src="<?=base_url()?>assets/vendor/chart/Chart.js"></script>
  
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg" id="bars_menu"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <?php
            $user_id = $this->session->userdata('user_id'); 
            $dat_user = $this->db->query("SELECT concat(first_name,' ',last_name) as nama FROM users where id='$user_id'")->row();
          ?>
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="<?=base_url()?>assets/template/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, <?=$dat_user->nama?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="<?=base_url()?>profile" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?=base_url('auth/logout');?>" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="<?=base_url("dashboard")?>">
              <!-- <img src="<?=base_url()?>assets/images/logo1.png" alt="logo" height="40"> -->
              Admin <?= $app->app_name ?>
            </a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?=base_url()?>">
                <?= substr($app->app_name, 0,3) ?>
            </a>
          </div>

          <?php $this->load->view('admin/layout/menu'); ?>

        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
            <?php $this->load->view($page);?>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; <?=date('Y')?> <div class="bullet"></div> <?= $app->app_name ?> <?=date('Y')?>
        </div>
        <div class="footer-right">
          v1.0
        </div>
      </footer>
    </div>
  </div>

  <div class="modal2"><!-- Place at bottom of page --></div>

  <!-- General JS Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="<?=base_url()?>assets/template/assets/js/stisla.js"></script>

  <!-- Template JS File -->
  <script src="<?=base_url()?>assets/template/assets/js/scripts.js"></script>
  <script src="<?=base_url()?>assets/template/assets/js/custom.js"></script>

  <script src="<?=base_url();?>assets/vendor/sweetalert/sweetalert.min.js"></script>
  <script src="<?=base_url()?>assets/plugins/select2/js/select2.min.js"></script>

<script type="text/javascript">
    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }    
    }); 

    $(document).ready(function () {
        $(".select2").select2();
    });

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
    function tandaPemisahTitik(val){
        if(val != '' || val != null){
            var number_string = val.toString().replace(/[^,\d]/g, '').toString(),
            split           = number_string.split(','),
            sisa            = split[0].length % 3,
            rupiah          = split[0].substr(0, sisa),
            ribuan          = split[0].substr(sisa).match(/\d{3}/gi);
         
            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if(ribuan){
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
         
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return rupiah;
        }else{
            return '';
        }    
    }
    
    function tandaPemisahTitik2(value){
        var bilangan = value.toString().replace(/\./g,',');
        
        var number_string = bilangan.toString(),
            split   = number_string.split(','),
            sisa    = split[0].length % 3,
            rupiah  = split[0].substr(0, sisa),
            ribuan  = split[0].substr(sisa).match(/\d{1,3}/gi);
                
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        rupiah = split[1] != undefined ? rupiah  : rupiah;

        return rupiah;
    }  

    function numbersonly(ini, e){
        if (e.keyCode>=49){
        if(e.keyCode<=57){
        a = ini.value.toString().replace(".","");
        b = a.replace(/[^\d]/g,"");
        b = (b=="0")?String.fromCharCode(e.keyCode):b + String.fromCharCode(e.keyCode);
        ini.value = tandaPemisahTitik(b);
        return false;
        }
        else if(e.keyCode<=105){
        if(e.keyCode>=96){
        //e.keycode = e.keycode - 47;
        a = ini.value.toString().replace(".","");
        b = a.replace(/[^\d]/g,"");
        b = (b=="0")?String.fromCharCode(e.keyCode-48):b + String.fromCharCode(e.keyCode-48);
        ini.value = tandaPemisahTitik(b);
        //alert(e.keycode);
        return false;
        }
        else {return false;}
        }
        else {
        return false; }
        }else if (e.keyCode==48){
        a = ini.value.replace(".","") + String.fromCharCode(e.keyCode);
        b = a.replace(/[^\d]/g,"");
        if (parseFloat(b)!=0){
        ini.value = tandaPemisahTitik(b);
        return false;
        } else {
        return false;
        }
        }else if (e.keyCode==95){
        a = ini.value.replace(".","") + String.fromCharCode(e.keyCode-48);
        b = a.replace(/[^\d]/g,"");
        if (parseFloat(b)!=0){
        ini.value = tandaPemisahTitik(b);
        return false;
        } else {
        return false;
        }
        }else if (e.keyCode==8 || e.keycode==46){
        a = ini.value.replace(".","");
        b = a.replace(/[^\d]/g,"");
        b = b.substr(0,b.length -1);
        if (tandaPemisahTitik(b)!=""){
        ini.value = tandaPemisahTitik(b);
        } else {
        ini.value = "";
        }

        return false;
        } else if (e.keyCode==9){
        return true;
        } else if (e.keyCode==17){
        return true;
        } else {
        //alert (e.keyCode);
        return false;
        }

    }

    function angka(val){
        rev_angka = val.replace(/\./g,'');
        return rev_angka;
    }

    function fileChange(e,id_input,id_view) { 
     document.getElementById(id_input).value = '';

     for (var i = 0; i < e.files.length; i++) { 
     
      var file = e.files[i];

      if (file.type == "image/jpeg" || file.type == "image/png") {

         var reader = new FileReader();  
         reader.onload = function(readerEvent) {

          var image = new Image();
          image.onload = function(imageEvent) { 

           var max_size = 1000;
           var w = image.width;
           var h = image.height;
           if(w>max_size || h>max_size){
            if (w > h) {  if (w > max_size) { h*=max_size/w; w=max_size; }
            } else     {  if (h > max_size) { w*=max_size/h; h=max_size; } } 
           } 
           
           
           var canvas = document.createElement('canvas');
           canvas.width = w;
           canvas.height = h;
           canvas.getContext('2d').drawImage(image, 0, 0, w, h);
           if (file.type == "image/jpeg") {
            var dataURL = canvas.toDataURL("image/jpeg", 1.0);
           } else {
            var dataURL = canvas.toDataURL("image/png");    
           }
           document.getElementById(id_input).value += dataURL + '|';
           if(id_view != ''){
             $("#"+id_view).attr("src",dataURL);
           }
          }
          image.src = readerEvent.target.result;
         }
         reader.readAsDataURL(file);
      } else {
         Swal.fire("Error file","Please only select images in JPG- or PNG-format.","error");
         $(e).val("");
         return false;
      }
     }
    }

    function get_token(callback){
      $.ajax({
        async: true,
        dataType: 'json',
        url: "<?php echo base_url('get_token'); ?>",
        success: function (data) {
            typeof callback === 'function' && callback(data);
        }
      })
    }
    
</script>

</body>
</html>
