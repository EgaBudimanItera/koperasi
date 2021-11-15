<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login &mdash;</title>
<!-- Favicons -->
<link href="<?=base_url()?>assets/logo/logo-koperasi.png" rel="icon">
<link href="<?=base_url()?>assets/logo/logo-koperasi.png" rel="apple-touch-icon">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?=base_url()?>/assets/css/style.css">
  <link rel="stylesheet" href="<?=base_url()?>/assets/css/components.css">
  <style>
      input:-webkit-autofill {
        -webkit-box-shadow: 0 0 0 1000px white inset !important;
      }
    </style>
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="d-flex flex-wrap align-items-stretch">
        <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
          <div class="p-4 m-3">
        
            <div class="login-brand">
              <img src="<?=base_url()?>assets/logo/logo-koperasi.png" width="100" class="">
            </div>

            <div class="card card-info">
              <div class="card-header"><h4 class="text-dark font-weight-normal">Sistem Informasi <span class="font-weight-bold">Koperasi</span></h4>
              </div>

              <div class="card-body">
                <form id="form_login" method="POST" autocomplete="off">
                  <div class="form-group">
                    <label>Nama User</label>
                    <input type="text" class="form-control" id="usr_nama" value="" name="usr_nama" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="usr_password" value="" name="usr_password" autocomplete="off">
                  </div>
                  
                  <div id="loading"></div>
                  <div class="form-group">

                    <button type="submit" class="btn btn-info btn-lg btn-block" tabindex="4">
                    <i class="fas fa-sign-in-alt"></i>  Login
                  </button>
                  </div>
                  </form>
                
                  
              </div>
            </div>
            
            <div class="simple-footer">
            Copyright © Koperasi
            </div>
          

           
          </div>
        </div>
        <div class="col-lg-8 col-12 " data-background="https://images.pexels.com/photos/669616/pexels-photo-669616.jpeg" style="background-size:cover;">
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
  <script src="<?=base_url()?>/assets/js/stisla.js"></script>

  <!-- JS Libraies -->

  <!-- Template JS File -->
  <script src="<?=base_url()?>/assets/js/scripts.js"></script>
  <script src="<?=base_url()?>/assets/js/custom.js"></script>

  <!-- Page Specific JS File -->
    <script type="text/javascript">
        $(document).ready(function(){
            $("#form_login")[0].reset();
            $(document).on('submit', '#form_login', function(e){
                e.preventDefault();
                var data = $('#form_login').serialize();
                $('#loading').html('Loading...');
                $.ajax({
                     url : '<?=base_url()?>auth/signin',
                    type: 'POST',
                    data: data,
                    success: function(msg){
                        $('#loading').html(msg);
                    }
                });
            });
        });
    
    </script>
</body>
</html>