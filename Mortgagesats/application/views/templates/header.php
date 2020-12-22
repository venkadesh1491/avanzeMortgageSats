<!DOCTYPE html>
<html lang="en">    

<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <meta charset="utf-8" />
  <meta http-equiv='cache-control' content='no-cache'>
  <meta http-equiv='expires' content='0'>
  <meta http-equiv='pragma' content='no-cache'>
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url();?>assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/img/INSIGWHITE_MINI.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>INSIG</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <meta name="keywords" content="insig">
  <meta name="description" content="">
  <!-- Schema.org markup for Google+ -->
  <meta itemprop="name" content="">
  <meta itemprop="description" content="">
  <link rel="stylesheet" type="text/css"  href="<?php echo base_url();?>assets/icon/css/ionicons.css" />
  <link href="<?php echo base_url();?>assets/css/icomoon.css" rel="stylesheet" type="text/css"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"  rel="stylesheet" type="text/css"/>
  <link href="<?php echo base_url();?>assets/css/ocr.css" rel="stylesheet" type="text/css"/>
  <link href="<?php echo base_url();?>assets/demo/demo.css" rel="stylesheet" type="text/css"/>
    
  <link href="<?php echo base_url();?>assets/css/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.datetextentry.css" />
  <link href="<?php echo base_url();?>assets/css/jquerysctipttop.css" rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/select2/select2.min.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/select2/select2-bootstrap.css" />
  <link rel="stylesheet" type="text/css"  href="<?php echo base_url();?>assets/css/select2/pmd-select2.css" />
  <link href="<?php echo base_url();?>assets/css/style.css?reload=1.0.0" rel="stylesheet" type="text/css"/>
  <link href="<?php echo base_url();?>assets/css/responsive.dataTables.min.css" rel="stylesheet" media="screen">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/pdfviewer/web/viewer.css">
  <!-- This snippet is used in production (included from viewer.html) -->
  <link rel="resource" type="application/l10n" href="<?php echo base_url(); ?>assets/plugins/pdfviewer/web/locale/locale.properties">

<!--  <link href="<?php echo base_url();?>assets/plugins/bootstrap4-editable/css/bootstrap-editable.css" rel="stylesheet" -->
  <link href="<?php echo base_url();?>assets/plugins/nprogress/nprogress.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/plugins/dropify/css/dropify.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/plugins/dropify/css/dropify.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/plugins/dropify/css/dropify.css" rel="stylesheet" />
  <!-- js Files -->
  <script src="<?php echo base_url();?>assets/js/core/jquery.min.js" type="text/javascript" ></script>
  <!-- <script src="<?php echo base_url();?>assets/js/load.js?reload=1.0" type="text/javascript" ></script>   -->
  <!-- <script src="<?php echo base_url();?>assets/plugins/nprogress/nprogress.js"  type="text/javascript"></script> -->
<script src="<?php echo base_url();?>assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!-- Plugin for the momentJs  -->
<script src="<?php echo base_url();?>assets/js/plugins/moment.min.js"></script>
<!--  Plugin for Sweet Alert -->
<script src="<?php echo base_url();?>assets/js/plugins/sweetalert2.js"></script>
<!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="<?php echo base_url();?>assets/js/plugins/bootstrap-tagsinput.js"></script>
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="<?php echo base_url();?>assets/js/plugins/jasny-bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/arrive.min.js"></script>
<!--  Notifications Plugin    -->
<script src="<?php echo base_url();?>assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="<?php echo base_url();?>assets/js/material-dashboard.min.js" type="text/javascript"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="<?php echo base_url();?>assets/demo/demo.js"></script>
<script  src="<?php echo base_url();?>assets/js/select2/select2.full.js"></script>
<script  src="<?php echo base_url();?>assets/js/select2/pmd-select2.js"></script>
<script src="<?php echo base_url();?>assets/plugins/dropify/js/dropify.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/pdfviewer/build/pdf.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/plugins/pdfviewer/web/viewer.js"></script> -->
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
<script src="<?php echo base_url();?>assets/js/plugins/jquery.dataTables.min.js"></script>
<style type="text/css">
        body{
              /*overflow-y: hidden;*/
              overflow-x: hidden;
        }
  /* Style all input fields */
input {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 6px;
    margin-bottom: 16px;
}

select {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 6px;
    margin-bottom: 16px;
}

/* Style the submit button */
input[type=submit] {
    background-color: #4CAF50;
    color: white;
}

/* Style the container for inputs */


/* The message box is shown when the user clicks on the password field */
#message {
    display:none;
    background: #f1f1f1;
    color: #000;
    position: relative;
    padding: 20px;
    margin-top: 10px;
}

#message p {
    padding-top: 5px;
    font-size: 12px;
    margin-bottom: 0px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
    color: green;
}

.valid:before {
    position: relative;
    left: -5px;
    content: "\2714";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
    color: red;
    font-size: 12px;
}

.invalid:before {
    position: relative;
    left: -5px;
    content: "\2718";
}

window.scrollBy({ 
  top: 100, 
  left: 0, 
  behavior: 'smooth' 
});

.center{
   margin: auto;
    width: 50%;
   
    padding: 10px;
}
  .select2-dropdown{
    z-index:99999;
  }
</style>
<script type="text/javascript">
  $(".icon-menu7").on('click',function(){
//alert("hh")
      $(".blogo").css('display','block');
   
  })
</script>
</head>
<body class="sidebar-mini">
 



       <div class="wrapper">
    <div class="sidebar" data-color="" data-background-color="black" data-image=""> 
      <div class="logo">
              <a href="<?php echo base_url();?>" class="logo-mini">
             <!--  <h6 class="blogo" style="height: 25px; margin: 12px 5px 5px 10px; display: none;">INSIG</h6> -->
              <img src="<?php echo base_url();?>assets/img/INSIGWHITE_MINI.png" class="blogo" style="height: 55px; margin: 12px 3px 3px -24px; display: block;">
            </a>
              <a href="<?php echo base_url();?>" class="simple-text logo-normal text-center">              
                <img alt="LOGO" src = "<?php echo base_url();?>assets/img/INSIGWHITE_LARGE.png" style="height:60px;margin-top: 10px;margin-left: -40px;" />
                
              </a>
      </div>
       <div class="sidebar-wrapper">
          <div class="user">
           <div class="photo">
            <img class="imagePreview1" src="<?php echo base_url();?>assets/img/avatar.png" />
          </div>
          <div class="user-info">
            <a data-toggle="collapse" href="#collapseExample" class="username">
              <span>
               <?php $name=$this->session->userdata('Name');  echo wordwrap($name,15,"<br>\n"); ?>
               <b class="caret"></b>
             </span>
           </a>
           <div class="collapse" id="collapseExample">
            <ul class="nav" id="leftsidebarmenu">
             <!--  <li class="nav-item">
                <a class="nav-link ajaxload" href="<?php echo base_url('Profile'); ?>">
                  <span class="sidebar-mini"> P </span>
                  <span class="sidebar-normal"> Profile </span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link ajaxload" href="<?php echo base_url(); ?>Help">
                  <span class="sidebar-mini"> H </span>
                  <span class="sidebar-normal"> Help </span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link ajaxload" href="<?php echo base_url(); ?>Login/changepasswordpage">
                  <span class="sidebar-mini"> CP </span>
                  <span class="sidebar-normal"> Change Password </span>
                </a>
              </li> -->
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url(); ?>Login/Logout">
                  <span class="sidebar-mini"> L </span>
                  <span class="sidebar-normal"> Logout </span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <ul class="nav">

          <li class="nav-item">
            <a class="nav-link ajaxload" href="<?php echo base_url();?>main/docDef" target="_blank">
               <i class="fa fa-file-o"></i>
               <p> Document Definition</p>
            </a>
         </li>

      </ul>     
      <ul class="nav">

          <li class="nav-item">
            <a class="nav-link ajaxload" href="<?php echo base_url();?>main/addorder" target="_blank">
               <i class="icon-address-book"></i>
               <p> Add Orders</p>
            </a>
         </li>

      </ul>                     
  </div>
  </div>

        <div class="main-panel">
          <!-- Navbar -->
          <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navigation-example">
            <div class="container-fluid">
              <div class="navbar-wrapper">
                <div class="navbar-minimize">
                 <!--  <button id="minimizeSidebar" style="border: none;background: #fff;">
                    <i class="icon-menu7 visible-on-sidebar-regular"></i>
                    <i class="icon-cross2 visible-on-sidebar-mini"></i>
                  </button> -->
                </div>
                <a class="navbar-brand ajaxload" href="javascript:void(0);" id="pagetitle"></a>
              </div>
              <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon icon-bar"></span>
                <span class="navbar-toggler-icon icon-bar"></span>
                <span class="navbar-toggler-icon icon-bar"></span>
              </button>
              <div class="collapse navbar-collapse justify-content-end">
              

            <ul class="navbar-nav"> 
              <li class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation" style="display:none;">
                <span class="navbar-toggler-icon"></span>
              </li>
           

              <!-- <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);" style="margin: 0 auto;" >
                  <i class="icon-bell2" style="font-size:20px"></i>                    
                </a>
              </li> -->
              <li class="nav-item upload-notify" style="display: none;">
                <a class="nav-link ajaxload"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="javascript:void(0);" style="margin: 0 auto;" >
                  <i class="icon-bell2" style="font-size:20px"></i>                    
                </a>



                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <div class="col-md-12">
                    <p>File Uploading...<span class="text-right">54%</span></p>
                    <div class="progress progress-line-info" id="progressupload" style=" height: 22px;">
                      <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width:0%; height: 21px;">
                        <span class="sr-only">0% Complete</span>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <li class="nav-item" style="padding-left:20px">
               <img src="<?php echo base_url();?>assets/img/logo.png" class="img-responsive" style="height:40px;" />
             </li>
           </ul>

           <!--  <div class="logo">
              <a href="javascript:void(0);" class="simple-text logo-normal text-center">
               
                 
                <img alt="LOGO" src = "<?php echo base_url();?>assets/img/logo.png" style="height:60px;" />
              </a>
            </div> -->



         </div>
       </div>
     </nav>


<div class="content">
  <div class="container-fluid">
           