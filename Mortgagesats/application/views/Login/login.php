<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url();?>assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Login Details | Insig</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <!-- CSS Files -->
  <link href="<?php echo base_url();?>assets/css/material-dashboard.min40a0.css?v=2.0.2" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/icon/css/ionicons.css" />
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css"  href="<?php echo base_url();?>assets/nprogress/nprogress.css" />
  <style type="text/css">
  .card-title {
        line-height: 33px;
    font-weight: 500;
  }
    .form-control,
    .is-focused .form-control {
      background-image: linear-gradient(to top, #e91e63 2px, rgba(156, 39, 176, 0) 2px), linear-gradient(to top, #d2d2d2 1px, rgba(210, 210, 210, 0) 1px);
    }
    .logo {
      width: 76%;
      filter: brightness(0) invert(1);
      -web-kit-filter: brightness(0) invert(1);
    }
    #nprogress .bar {
      background: #e91e63;
      z-index: 999999;
    }
    #nprogress .peg {
      box-shadow: 1px 3px 10px #e91e63, 0 3px 5px #e91e63;
    }
    .card-header {
      border-radius: 5px !important;
    }
    .card .card-header-rose .card-icon, .card .card-header-rose .card-text, .card .card-header-rose:not(.card-header-icon):not(.card-header-text) {
      box-shadow: 0 4px 20px 0 rgba(0, 0, 0, .14), 0 7px 10px -5px rgb(59, 89, 152);
    }
    .card .card-header-rose .card-icon, .card .card-header-rose .card-text, .card .card-header-rose:not(.card-header-icon):not(.card-header-text), .card.bg-rose, .card.card-rotate.bg-rose .back, .card.card-rotate.bg-rose .front {
      background: linear-gradient(60deg,#3b5998 , #3b5998);
          box-shadow: 0 4px 20px 0 rgba(0, 0, 0, .14), 0 7px 10px -5px rgb(59, 89, 152);
    }
    a {
     color:#ea4c89 !important
   }
   .mt-20{
    margin-top:10px;
   }
.card .card-header .card-header-rose .card-icon, .card .card-header-rose .card-text, .card .card-header-rose:not(.card-header-icon):not(.card-header-text), .card.bg-rose, .card.card-rotate.bg-rose .back, .card.card-rotate.bg-rose .front {
    background: #83a275c7 !important;
}
 </style>
</head>

<body class="">

  <div class="content">
    <div class="wrapper wrapper-full-page">
      <div class="page-header login-page header-filter" filter-color="black" style="background-image: url('<?php echo base_url('/assets/img/login-2.jpg');?>'); background-size: cover; background-position: top center;">
        <div class="container"> 
          <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 ml-auto mr-auto">
              <div class="card card-login card-hidden">
                <div class="card-header card-header-rose text-center" style="background: #212529 !important">
                  <h4 class="card-title"><!-- <img src="<?php echo base_url('/assets/img/cinbox_logo.png');?>" alt="Cinbox" class="logo"> -->
                    <img src="<?php echo base_url();?>assets/img/INSIGWHITE_MINI.png" class="img-responsive" style="height:40px"/> Insig
                  </h4>
                </div>
                <h4 class="card-title text-center">Welcome <?php echo $domain;?> login!</h4>
                <form action="#" class="form ng-untouched ng-pristine ng-valid" method="POST" id="loginform">
                  <div class="card-body">
                    <span class="bmd-form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="material-icons">email</i>
                          </span>
                        </div>
                        <input class="form-control" name="Email" id="Email" placeholder="Email..." type="email">
                      </div>
                    </span>
                    <div class="mt-20">
                    <span class="bmd-form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="material-icons">lock_outline</i>
                          </span>
                        </div>
                        <input class="form-control" name="Password" id="Password" placeholder="Password..." type="password">
                      </div>
                    </span>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="col-md-12 text-center">
                      <button type="submit" name="LoginButton" class="btn btn-facebook mt-4" id="login-btn">
                        <i class="material-icons">input</i> &nbsp;Login
                      </button> <br>
                      <label class="form-check-label btn btn-link btn-dribbble btn-md"><a href="<?php echo base_url('Login/forgot');?>">Forgot Password</a></label>
                      <div class="row"> 
                        <div class="col-sm-4" style="text-align: center; color: #222222; padding:0px;"> 
                          
                        </div>
                        <div class="col-sm-4" style="text-align: center; color: #222222; padding:0px;">
                           <i class="fa fa-chrome"></i>
                          <p style="font-size: 10px;">Google Chrome - 67+</p>
                        </div>
                        <div class="col-sm-4" style="text-align: center; color: #222222; padding:0px;">
                           
                        </div>
                        <div class="col-sm-12" style="text-align: center; color: #222222;">
                          <p style="font-size: 10px; font-weight: 700;">USE CHROME FOR BEST VIEWING EXPERIENCE.</p> 
                        </div>
                      </div> 
                    </div>
                    <div class="col-md-12">


                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div> 
        </div>
      </div> 
    </div>
  </div>
</div>

<script src="<?php echo base_url();?>assets/js/core/jquery.min.js" type="text/javascript"></script>
<!-- js Files -->
<script src="<?php echo base_url();?>assets/js/plugins/bootstrap-notify.js"></script>
<script src="<?php echo base_url();?>assets/nprogress/nprogress.js" ></script>
<script type="text/javascript">

  var Ajaxinterval = setInterval(function(){ NProgress.inc();}, 600);

  $(window).on('load',function() { 
    NProgress.done();
    clearInterval(Ajaxinterval);
  });

  $(document).ajaxStart(function() {
    NProgress.start();
    NProgress.set(0.2);
  });

  $(document).ajaxComplete(function() {
    NProgress.done();
    clearInterval(Ajaxinterval);
  });

  $(document).ready(function()
  {
    NProgress.start();
    setTimeout(function(){ 
      NProgress.done();
      $('.card').removeClass('card-hidden');
    }, 900);

    $('#loginform').submit(function(e){
      e.preventDefault();
      var Data = new FormData(this);  
      $.ajax({
        url: "<?php echo base_url('Login/Authentication')?>",
        type: 'POST',
        data: Data,
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
          $('#login-btn').html('Authenticating...');
          $('#login-btn').attr('disabled',true);
        },
        success: function (data) 
        {
          if(data.length!=0)  
          { 
            $('#login-btn').html('<i class="material-icons">check</i> Success');
            if(data.validation_error==0)
            {
              $('#loginform').trigger("reset");   
              $.notify(data.message,{
               type:data.type,
               delay:300,
               timer: 100,
               onClose: function(){
                 window.location.href = data.redirect;   
               }
             });
            } else {
              $.notify(data.message,{
               type:data.type,
               delay: 500
             });
            }
          }
          $('#login-btn').attr('disabled',false);  
          $('#login-btn').html('<i class="material-icons">lock_open</i> Login');
        }
      }); 
      return false;
    });

  });
</script>
