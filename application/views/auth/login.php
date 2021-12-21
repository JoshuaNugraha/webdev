<?php $app = $this->db->get("pengaturan")->row() ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login | <?= $app->app_name ?></title>
  <!-- Favicon icon -->
  <link rel="icon" href="<?=base_url()?>assets/images/<?= $app->favicon ?>" type="image/x-icon">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?=base_url()?>assets/template/assets/css/style.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/template/assets/css/components.css">

  <link rel="stylesheet" href="<?=base_url();?>assets/vendor/sweetalert/sweetalert.css">

  <style>
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

  </style>
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="d-flex flex-wrap align-items-stretch">
        <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
          <div class="p-4 m-3">
            <img src="<?=base_url()?>assets/images/<?= $app->logo ?>" alt="logo" height="150" class="mb-5 mt-2">
            <h4 class="text-dark font-weight-normal">Welcome</h4>
            <p class="text-muted">Silahkan login.</p>
            <form method="POST" action="<?=base_url();?>auth/login" class="needs-validation" novalidate="">
              <input type="hidden" name="csrf_am" value="<?=$this->security->get_csrf_hash()?>">
              <div class="form-group">
                <label for="identity">Email</label>
                <input id="identity" type="text" class="form-control" name="identity" tabindex="1" required autofocus>
                <div class="invalid-feedback">
                  Please fill in your email
                </div>
              </div>

              <div class="form-group">
                <div class="d-block">
                  <label for="password" class="control-label">Password</label>
                </div>
                <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                <div class="invalid-feedback">
                  please fill in your password
                </div>
              </div>

              <!-- <div class="form-group">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                  <label class="custom-control-label" for="remember-me">Remember Me</label>
                </div>
              </div> -->

              <div class="form-group text-right">
               <!--  <a href="#" class="float-left mt-3">
                  Forgot Password?
                </a> -->
                <button type="submit" class="btn btn-success btn-lg btn-block btn-icon icon-right" tabindex="4">
                  Login
                </button>
              </div>

              <!-- <div class="mt-5 text-center">
                Don't have an account? <a href="<?=base_url()?>register">Create new one</a>
              </div> -->

            </form>

            
          </div>
        </div>
        <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="<?=base_url()?>assets/images/<?= $app->login_banner ?>">
          <div class="absolute-bottom-left index-2">
            <div class="text-light p-5 pb-2">
              <div class="mb-5 pb-3">
                <h1 class="mb-2 display-4 font-weight-bold"><?= $app->app_name ?></h1>
                <h5 class="font-weight-normal text-muted-transparent"><?= $app->keterangan ?></h5>
              </div>
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

</body>
</html>
