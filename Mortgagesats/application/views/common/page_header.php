<?php 
GLOBAl $IsLoogedUser;
$this->OrgUID = $this->session->userdata('UserOrgUID');
$IsLoogedUser = $this->Common_model->GetIsLoggedUserDetails();
$UserPhoto = $IsLoogedUser->UserPhoto;         
if(empty($UserPhoto) || !file_exists(getDocPath('User',$this->OrgUID).$UserPhoto))
{
  $UserPhoto = './assets/img/avatar2.png';
} else {
  $UserPhoto = getDocPath('User',$this->OrgUID).$UserPhoto;
}
?>
<!DOCTYPE html>
<html lang="en">    
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url();?>assets/img/apple-icon.png">
  <!-- <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/img/favicon.png"> -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title><?php echo $page_title;?></title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/fontawesome.css" type="text/css" />
  <link rel="stylesheet" type="text/css"  href="<?php echo base_url();?>assets/nprogress/nprogress.css" />  
  <link href="<?php echo base_url();?>assets/css/material-dashboard.min40a0.css?v=2.0.2" rel="stylesheet" />
  <link href="<?php echo base_url();?>assets/demo/demo.css" rel="stylesheet" />
  <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css"  href="<?php echo base_url();?>assets/icon/css/ionicons.css" />
  <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/taginput.css" />
  <link href="<?php echo base_url(); ?>assets/css/jquery.plugin.full-modal.min.css" rel="stylesheet" type="text/css"/> 
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/chat/docket/icons.css" />
  <link href="<?php echo base_url();?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <link  rel="stylesheet" href="<?php echo base_url();?>assets/multiselect/css/bootstrap-multiselect.css"   type="text/css" />
  <link  rel="stylesheet" href="<?php echo base_url();?>assets/multiselect/css/awesome-bootstrap-checkbox.css"   type="text/css" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/select2/select2.min.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/select2/select2-bootstrap.css" />
  <link rel="stylesheet" type="text/css"  href="<?php echo base_url();?>assets/css/select2/pmd-select2.css" />
  <script src="<?php echo base_url();?>assets/js/core/jquery.min.js" type="text/javascript"></script> 
  <script src="<?php echo base_url();?>assets/js/tinymce/tinymce.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url();?>assets/js/plugins/perfect-scrollbar.jquery.min.js" ></script>
  <script src="<?php echo base_url();?>assets/nprogress/nprogress.js" ></script>
  <script src="<?php echo base_url();?>assets/js/dynamicpage.js" type="text/javascript"></script> 
  <script src="<?php echo base_url();?>assets/js/jquery-ui.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery.plugin.full-modal.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/multiselect/js/bootstrap-multiselect.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="<?php echo base_url('assets/img/favicon.ico') ?>" type="image/x-icon">
  <link rel="icon" href="<?php echo base_url('assets/img/favicon.ico') ?>" type="image/x-icon">
  <style>

  @font-face {
    font-family: 'FontAwesome';
    src: url('<?php echo base_url();?>assets/fonts/fontawesome-webfont.eot?v=4.7.0');
    src: url('<?php echo base_url();?>assets/fonts/fontawesome-webfont.eot?#iefix&v=4.7.0') format('embedded-opentype'),
    url('<?php echo base_url();?>assets/fonts/fontawesome-webfont.woff2?v=4.7.0') format('woff2'),
    url('<?php echo base_url();?>assets/fonts/fontawesome-webfont.woff?v=4.7.0') format('woff'),
    url('<?php echo base_url();?>assets/fonts/fontawesome-webfont.ttf?v=4.7.0') format('truetype'),
    url('<?php echo base_url();?>assets/fonts/fontawesome-webfont.svg?v=4.7.0#fontawesomeregular') format('svg');
    font-weight: normal;
    font-style: normal;
  }
  
  .sidebar-mini .sidebar:hover .blogo{
    display: none;
  }
  .sidebar-mini .sidebar:hover .logo{
    height: 70px;
  }
  .sidebar-mini .logo{
    height: 100px;
  }
  .usernotifylist .dropdown-menu .dropdown-item:focus,.usernotifylist .dropdown-menu .dropdown-item:hover,.usernotifylist .dropdown-menu a:active,.usernotifylist .dropdown-menu a:focus,.usernotifylist .dropdown-menu a:hover{
   background: transparent;
   box-shadow: none;
 }
 .titletxt{
  margin-top:7px; 

}
.desctxt{
  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;   
  max-height: 27px;
  -webkit-line-clamp: 1;
  -webkit-box-orient: vertical;
  text-transform: capitalize;
}
.usernamedts{  
  color: #9a9797;
  font-size: 11px;
}
.notycreatedate{
  font-size: 10px;
  color: #696969;
  float: right;
  line-height: 17px !important;
}
#mceu_11-body{
  border : 1px solid #DDD !important;
}
.usernotificationlist-menu p{
  margin-bottom: 0px !important;
  line-height: 22px;
}
.material-datatables{
  overflow-y: auto !important;
}

   /* .dropdown-item:hover p ,.dropdown-item:hover .descLength ,.dropdown-item:hover #CreatedDateFrmt{
      color: #fff;     
      margin-bottom: 0px !important;
    }
 .dropdown-item p,  .dropdown-item .descLength,.dropdown-item #CreatedDateFrmt{
      margin-bottom: 0px !important;
      }*/


    /*#navigation-example .action{
      font-size: 17px;
      text-transform: uppercase;
      }*/
      #navigation-example .show {
        display: table-row;
      } 

    /*#navigation-example .descLength{
      font-size: 12px;
      text-transform: uppercase;
      }*/
      #navigation-example .nav-item .dropdown-menu{
      max-width: 30em !important;
   
       min-width: 24em !important;
       padding: 0px !important;
       max-height: 300px !important;
       overflow-y: auto;
       left : auto !important;
       right: 0px !important;
     }
     #navigation-example .usernotificationlist-menu a{
      margin : 0px !important;
    }

    .required
    {
      color: #ff0000;
    }

    .margintop
    {
      margin-top: 32px !important;
    }
    .orderListLength
    {
      text-align: left;
      overflow-y: auto; 
    }
    .descLength
    {
      width: 100%;
      overflow: hidden;
      text-overflow: ellipsis;
      display: -webkit-box;
      max-height: 50px;
      -webkit-line-clamp: 1;
      -webkit-box-orient: vertical;
      font-size: 11px;
    }
    .btn-like {
      background-color: #CC0000;
      border-color: #B20000;
      color: #fff;
    }
    .emailtotxt , .emailcctxt , .emailbcctxt{
      font-size: 12px !important;
    }
    .sentdate{
      font-size: 11px;
      font-weight: 600;
    }
    .composemail {
      height: 491px;
      overflow: auto;
    }
    .width0{
      width : 0% !important;
    }
    .width98{
     width : 98% !important;
   }
   .modal-dialog .modal-header .modal-title{
    margin-left: 10px;
  }
  .btn-sm{
    padding: 8px 5px;
  }
  .msg_body{
    font-size: 13px;
    padding: 20px;
    max-height: 340px;
    overflow-y: auto;
  }
  .msg_content{
   padding: 10px;
   border-bottom: 1px solid #eae9e9;
 }
 .msg_content .chat_img{
  width: 8%;
}
.msg_content .userimg{
  height: 35px;
}
.msg_header{
  padding: 20px;
  border-bottom: 1px solid #efefef;
}
.alert {
  z-index: 10000 !important;
}
ul#ui-id-1  ,ul#ui-id-2 , ul#ui-id-3   {
  left:0px;
  z-index: 10000 !important;
}
li.ui-menu-item {
  background: #fff;
  list-style-type: none;
  padding: 2px;
  font-size: 12px;
}
li.ui-menu-item:hover{
  background: #e91e63 !important;
  color: #fff !important;
}
.ui-menu .ui-menu-item-wrapper:hover{
  background: #e91e63 !important;
  border : 0px !important;
  color: #fff
}
.ui-menu-item-wrapper:hover li{
  background: #e91e63 !important;
  color: #fff !important;
}
#emailtable{
 border: 1px solid #efefef;
}   
#emailtable p{
  margin-bottom: 0px !important;      
}
#emailtable td {
  padding :10px;
  font-size: 13px;
  cursor: pointer;
}
#emailtable .mailid {
  width: 150px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  font-weight: 500;
}
#emailtable .maildesc {
  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  line-height: 16px;     /* fallback */
  max-height:15px;      /* fallback */
  -webkit-line-clamp: 1; /* number of lines to show */
  -webkit-box-orient: vertical;
}
#EmailSendModal .modal-body{
  max-height: 550px;
  overflow-y: hidden;
  min-height: 550px;   
  padding: 7px 15px;
}

.mb-0{
  margin-bottom: 0px !important;
}
.btn-xs{
  padding: 5px 8px !important;
  font-size: 10px;
}
.btn-xs i{
  font-size: 10px !important;
  padding-right: 5px !important;
}
.mt-15{
  margin-top: 15px !important;
}
.btn-send ,.btn-send:hover, .btn-send:focus, .btn-send:active {
  background: #ca1570;
}
.mce-panel {
  border: 0 solid #f3f3f3 !important;
  border: 0 solid #ffffff !important;
  background-color: #fff !important;
  box-shadow: none !important;
}
.mce-top-part::before{
  box-shadow: none !important;
  border-bottom: 1px solid #ddd !important;
}
.borderbtm{
  border-bottom: 1px solid #f5f5f5;
}
#EmailSendModal .card-header{
 color: #2f2f2f;
 padding: 5px;
}
#EmailSendModal .form-group{
  margin:0px;
}
#EmailSendModal label{
  margin : 0px;
}
#EmailSendModal .modal-dialog{
 max-width: 1060px !important;
 margin-top: 20px;
 overflow: hidden;
 margin-left: 275px;
 margin-right: 10px;
}
#EmailSendModal  .modal-header{
  border-bottom: 1px solid #f3f3f3;
}
#EmailSendModal .card{
  box-shadow: none;
}
.sidebar[data-color=rose] li.active>a {
  background-color: #83A275;
  box-shadow: 0 4px 20px 0 rgba(0, 0, 0, .14), 0 7px 10px -5px rgba(131, 162, 117, 0.51);
}
#EmailSendModal .modal-dialog .modal-content {
  box-shadow: none; 
  border-radius: 0px;
  border: none;
}
.errorpage{
  max-width: 70% !important;
  margin-top: -20px% !important;
}
.errorpage header.clearfix {
  margin-bottom: 0;
}
.errorpage svg {
  margin-top: 0;
  width: 35%;
}
.container.errorpage.mt-30 {
 margin-top: -10px !important;
}
.bootstrap-select {
 width: 100% !important;
}
.dropdown-menu.show {
 max-width: 100% !important;
 left: 0px !important;
 min-width: 100% !important;
}
.navbar.navbar-absolute {
  z-index: 9;
}
#nprogress .bar {
  height: 3px;
  background: #83A275;
  z-index: 9999999999;
}
#nprogress .peg {
 box-shadow: 0 0 10px #83A275, 0 0 5px #83A275;
}
.form-control, .is-focused .form-control {
  background-image: linear-gradient(to top, #83A275 2px, rgba(156, 39, 176, 0) 2px), linear-gradient(to top, #d2d2d2 1px, rgba(210, 210, 210, 0) 1px);
}
.togglebutton label input[type=checkbox]:checked+.toggle {
  background-color: rgba(233, 30, 99, 0.81);
}
.togglebutton label input[type=checkbox]:checked+.toggle:after {
  border-color: #83A275;
}
.bootstrap-select {
  width: 100% !important;
}
.headericon {
 position: absolute;
 left: 13px;
}
.sidetext {
 font-weight: 400;
 padding-bottom: 8px;
 color: #797979;
 padding-top: 25px;
 padding-left: 20px;
}
.float-right{
  margin-top: 15px;
}
.edit{
  color: #000;
}
.dropdown-menu .dropdown-item:focus, .dropdown-menu .dropdown-item:hover, .dropdown-menu a:active, .dropdown-menu a:focus, .dropdown-menu a:hover {
  box-shadow: 0 4px 20px 0 rgba(0, 0, 0, .14), 0 7px 10px -5px rgb(247, 89, 143);
  background-color: #e73774;
  color: #FFF;
}
.bootstrap-select .dropdown-item.active {
 background: #e73774;
 color: #fff;
}

.loader{
  display: none;
}
.loader:after{
 content:'';
 width: 100%;
 height: 100%;
 position: absolute;
 z-index: 999999999;
 background: rgba(255,255,255,0.8);
}
.loader-active{
  display: block;
}
.spinner
{
  position: fixed;
  left: 50%;
  top: 40%;
  display: block;
  z-index: 9999999999;
  -webkit-animation: rotation 1.35s linear infinite;
  animation: rotation 1.35s linear infinite;
}
.loader svg{stroke:#83A275;}
@-webkit-keyframes rotation
{
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }

  100% {
    -webkit-transform: rotate(270deg);
    transform: rotate(270deg);
  }
}

@keyframes rotation
{
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }

  100% {
    -webkit-transform: rotate(270deg);
    transform: rotate(270deg);
  }
}

.circle{
  stroke-dasharray: 180;
  stroke-dashoffset: 0;
  -webkit-transform-origin: center;
  -ms-transform-origin: center;
  transform-origin: center;
  -webkit-animation: turn 1.35s ease-in-out infinite;
  animation: turn 1.35s ease-in-out infinite;
}

@-webkit-keyframes turn
{
  0% {
    stroke-dashoffset: 180;
  }

  50% {
    stroke-dashoffset: 45;
    -webkit-transform: rotate(135deg);
    transform: rotate(135deg);
  }

  100% {
    stroke-dashoffset: 180;
    -webkit-transform: rotate(450deg);
    transform: rotate(450deg);
  }
}

@keyframes turn
{
  0% {
    stroke-dashoffset: 180;
  }

  50% {
    stroke-dashoffset: 45;
    -webkit-transform: rotate(135deg);
    transform: rotate(135deg);
  }

  100% {
    stroke-dashoffset: 180;
    -webkit-transform: rotate(450deg);
    transform: rotate(450deg);
  }
}  
/* Loader style */
.action-btn.float-right{
  margin-top: 15px;
}
.edit {
  color: #333333;
} 
.float-right
{
 margin-top: 15px;
}
.edit
{
 color: #000;
}
.mce-flow-layout-item.mce-last {
  display: none !important;
}
/*@media all and (max-width:991px) {
 #EmailSendModal .modal-dialog{
   max-width: 1060px !important;
   height: 650px;
   margin-top: 100px;
   overflow-y: hidden;
   margin-left: 30px;
   margin-right: 30px;
 }
 }*/
 @media all and (max-width:991px) {
  #EmailSendModal .modal-dialog{
    max-width: 1060px !important;
    height: 650px;
    margin-top: 100px;
    overflow-y: hidden;
    margin-left: 30px;
    margin-right: 30px;
  }
  .table-responsive select option{
    font-size: 12px !important;
  }
  .table-responsive td , .table-responsive th{
    font-size: 12px !important;
    padding: 5px !important;
  }
  .table-responsive .select2-selection__rendered{
    font-size: 12px !important;
  }
}


@media all and (max-width:758px) {
  .table-responsive select option{
    font-size: 10px !important;
  }
  .table-responsive td , .table-responsive th{
    font-size: 10px !important;
    padding: 5px !important;
  }
  .table-responsive .select2-selection__rendered{
    font-size: 10px !important;
  }
}

/*img{ max-width:100%;}*/
.inbox_people {
  background: #f8f8f8 none repeat scroll 0 0;
  float: left;
  overflow: hidden;
  width: 30%;
  border-right: 1px solid #ececec;
}
.inbox_msg {
 border: 1px solid #f1f1f1;
 clear: both;
 overflow: hidden;
}
.top_spac{ 
  margin: 20px 0 0;
}
.recent_heading {
  float: left; 
  width:40%;
}
.srch_bar {
  display: inline-block;
  text-align: right;
  width: 60%; padding:
}
.headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}

.recent_heading h4 {
  color: #05728f;
  font-size: 21px;
  margin: auto;
}
.srch_bar input{ border:1px solid #cdcdcd; border-width:0 0 1px 0; width:80%; padding:2px 0 4px 6px; background:none;}
.srch_bar .input-group-addon button {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  padding: 0;
  color: #707070;
  font-size: 18px;
}
.srch_bar .input-group-addon { margin: 0 0 0 -27px;}

.chat_ib h5{   
 font-size: 14px;
 color: #545252;
 margin: 0 0 8px 0;
 font-weight: 400;}
 .chat_ib h5 span{ font-size:13px; float:right;}
 .chat_ib p{ font-size:12px; color:#989898; margin:auto}
 .chat_img {
  float: left;
  width: 11%;
}
.chat_ib {
  float: left;
  padding: 0 0 0 15px;
  width: 88%;
}

.chat_people{ overflow:hidden; clear:both;}
.chat_list {
  border-bottom: 1px solid #dcdcdc;
  margin: 0;
  padding: 10px 10px 10px;
  cursor : pointer;
}
.inbox_chat { 
  height:492px;
  overflow-y: auto;
}

.active_chat{ background:#ebebeb;}

.incoming_msg_img {
  display: inline-block;
  width: 6%;
}
.received_msg {
  display: inline-block;
  padding: 0 0 0 10px;
  vertical-align: top;
  width: 92%;
}
.received_withd_msg p {
  background: #ebebeb none repeat scroll 0 0;
  border-radius: 3px;
  color: #646464;
  font-size: 14px;
  margin: 0;
  padding: 5px 10px 5px 12px;
  width: 100%;
}
.time_date {
  color: #747474;
  display: block;
  font-size: 12px;
  margin: 8px 0 0;
}
.received_withd_msg {
 width: 57%;
}
.mesgs {
  float: left;
  padding: 0px;
  width: 70%;
}
.sent_msg p {
  background: #05728f none repeat scroll 0 0;
  border-radius: 3px;
  font-size: 14px;
  margin: 0; color:#fff;
  padding: 5px 10px 5px 12px;
  width:100%;
}
.outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
.sent_msg {
  float: right;
  width: 46%;
}
.input_msg_write input {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  color: #4c4c4c;
  font-size: 15px;
  min-height: 48px;
  width: 100%;
}

.type_msg {border-top: 1px solid #c4c4c4;position: relative;}
.msg_send_btn {
  background: #05728f none repeat scroll 0 0;
  border: medium none;
  border-radius: 50%;
  color: #fff;
  cursor: pointer;
  font-size: 17px;
  height: 33px;
  position: absolute;
  right: 0;
  top: 11px;
  width: 33px;
}
.messaging { padding: 0 0 10px 0;}

.badge {
  padding: 5px 12px;
  text-transform: uppercase;
  font-size: 10px;
  color: #fff;
  display: inline-block;
  white-space: normal; 
}

.badge.badge-default {
  background-color: #ffeb3b54;
}

#ChatViewerModal .modal-body img {
  max-width: 100% !important;
}
.ZoomMeetingModal .modal-lg {
  margin-top: 5px; 
  max-width: 800px !important;
}
.ZoomMeetingModal .modal-header {
  padding-top: 15px; 
}
.ZoomMeetingModal .modal-footer {
  padding-bottom: 10px;
}
#ChatViewerModal .modal-body img {
  max-width: 100% !important;
}
.modal-backdrop.show {
 background: rgba(0, 0, 0, 0.55) !important;
 opacity: 1 !important;
}
.titleLength
{
  font-weight: 500;
  list-style: none;
  text-align: left !important; 
  cursor: pointer;
  display: inline-block;
  width: 150px;
  white-space: nowrap;
  overflow: hidden !important;
  text-overflow: ellipsis;
  font-size: 12px !important;
  line-height: 11px;
}
.CreatedDateFrmt
{
  position: relative;
  width: 100%;
  /*border: 1px solid #ddd;
  border-radius: 1.5em;*/
  text-align: left;
  font-size: 10px;
}
.structuredesign
{
  width: 40px;
  border-radius: 50%; 
}

.headericonimg{
  float: left;
  padding-right: 3px;
  font-size: 22px;
  color: #7c807b;
}
.headertxt{
  text-transform: capitalize;
  font-size: 15px;
  color: #797979;
}

.nav-item .badge{
  color : black !important;
}
.nav-item .badge.badge-default{
  background:  #fff !important;
}
.modal .modal-header .close {
  color: #ffffff;
  opacity: 1;
  background: #e91e63;
  cursor: pointer;
  padding: 5px 6px;
  top: 23px;
  height: 31px;
  right: 25px;
  border-radius: 100%;
}
.modal .modal-header .close i {
  font-size: 20px;
}
.notification_overlay:after{
  content: url('<?php echo base_url("assets/img/web.png")?>'); width:100%;color:#fff;height:100%;position:fixed; display:block; text-transform:capitalize; font-size:25px;padding:170px 250px;top:0;background:rgba(0,0,0,.87);z-index:9999
}
.emptytxt {
    color: #cacaca;
    text-align: center;
    position: relative;
    top: 45%;
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
       font-size: 20px;
    font-weight: 500;
}
#EmailSendModal h5{
  text-align: left;
  margin : 0px !important;
  line-height: 25px;
}
.sidebar .nav i {
    font-size: 20px;  
    margin-right: 5px;
}
.sidebar .logo a.logo-mini {
    margin-left: 40px; 
}
</style>
</head>


<div class="loader loader-active" id="AjaxPageLoader">
  <svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"><circle class="circle" fill="none" stroke-width="3" stroke-linecap="round" cx="33" cy="33" r="30"></circle></svg>
</div>

<body class="">

  <div class="wrapper"> 

    <div class="sidebar" data-color="rose" data-background-color="black" data-image="<?php echo base_url();?>assets/img/sidebar-1.jpg">   
        <div class="logo">
      <a href="<?php echo base_url();?>" class="logo-mini">
        <img src="<?php echo base_url();?>assets/img/home-box1.png" style="height: 28px;margin-top: 3px;"/>
        <!-- <img src="<?php echo base_url();?>assets/img/home-box.png" class="blogo" style="height: 25px;margin :  12px 5px 5px 10px;
        margin-left: 10px;display: none"/> -->
      </a>
      <a href="<?php echo base_url();?>" class="logo-normal">
        <?php 
        $OrgDetail = $this->Common_model->GetOrganizationByUID($this->OrgUID);
        $Orglogo = base_url(substr(MEDIA_DIR.'/CINBOX/ORGANIZATIONS/ORG-'.$OrgDetail->OrgUID.'/DOCS/'.$OrgDetail->LogoUrl,2));
        ?>
        <img src="<?php echo $Orglogo;?>" style="height: 25px;margin-top: 5px;margin-left: 0px;" class="btext" alt="">
        <!-- <img src="<?php echo base_url();?>assets/img/BFAG_Logo.png" class="" /> -->
      </a>
    </div>
    <div class="sidebar-wrapper">
      <div class="user">
       <div class="photo">
        <img src="<?php echo base_url().$UserPhoto;?>"/>
      </div>
      <div class="user-info">
        <a data-toggle="collapse" href="#collapseExample" class="username">
         <span><?php echo $IsLoogedUser->Name; echo '<br> <span style="color:#c0c2c5; font-size: 13px;">'.ucwords(strtolower($IsLoogedUser->RoleName)); ?></span><b class="caret"></b></span>
       </a>
       <div class="collapse" id="collapseExample">
         <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('Login/logout');?>">
              <span class="sidebar-mini">L</span>
              <span class="sidebar-normal"> Logout </span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('Users/ChangePassword');?>">
             <span class="sidebar-mini"> C </span>
             <span class="sidebar-normal"> Change Password </span>
            </a>
          </li>
           <!--<li class="nav-item">
           <a class="nav-link" href="javascript:void(0);">
            <span class="sidebar-mini"> EP </span>
            <span class="sidebar-normal"> Edit Profile </span>
          </a>
        </li>
        <li class="nav-item">
         <a class="nav-link" href="javascript:void(0);">
          <span class="sidebar-mini"> S </span>
          <span class="sidebar-normal"> Settings </span>
        </a>
      </li> -->
    </ul>
  </div>
</div>
</div>

<?php
$IsLoogedUser = $this->Common_model->GetIsLoggedUserDetails();
$CountNotify = $this->Common_model->GetCountNotification();
$CountKnw = $this->Common_model->GetCountKnowledgeCenter();
$CountUserNotification = $this->Common_model->GetCountUserNotification();
$ListUserNotify = $this->Common_model->GetListUserNotifications();

if($this->RoleName == $this->config->item('RoleName')[0]) 
{ 
  $headerTitle = 'eAudit';
} else {
  $headerTitle = 'Dashboard';
} 
?>
<ul class="nav"> 
  <?php
  if(hasPermission('viewDashboard')>0) 
  { 
  ?>
   <li class="nav-item <?php echo activeMenu('Dashboard'); ?>">
     <a class="nav-link" page-title="<?php echo $headerTitle; ?> | Compliance Inbox" href="<?php echo base_url('Dashboard');?>">
       <i class="material-icons">dashboard</i>
       <p><?php echo $headerTitle; ?></p>
     </a>
   </li>
 <?php } if(hasPermission(array('addTask','editTask','viewTask'))>0) { ?>
   <li class="nav-item <?php echo activeMenu('Mytask');?>">
    <a class="nav-link ajx-menu" page-title="Work Room | Compliance Inbox" href="<?php echo base_url('Mytask');?>">
      <i class="material-icons">room</i>
      <p> Work Room </p>
    </a>
  </li>
<?php } if(hasPermission(array('addNotification','editNotification','viewNotification'))>0) { ?>
  <li class="nav-item <?php echo activeMenu('Notification');?>">
    <a class="nav-link ajx-menu" page-title="Notification | Compliance Inbox" href="<?php echo base_url('Notification');?>">
      <i class="material-icons">notifications</i>
      <p> Notifications <span class="badge badge-default pull-right badge-notify" style="margin-top: 5px;"><?php echo $CountNotify;  ?></span></p>
    </a>
  </li>
<?php } if(hasPermission(array('addKnowledge','editKnowledge','viewKnowledge'))>0) { ?>
  <li class="nav-item <?php echo activeMenu('Knowledge');?>">
    <a class="nav-link ajx-menu" page-title="Knowledge | Compliance Inbox" href="<?php echo base_url('Knowledge');?>">
      <i class="material-icons">share</i>
      <p> Knowledge Center <span class="badge badge-default pull-right badge-Knw" style="margin-top: 5px;"><?php echo $CountKnw;  ?></span></p>
    </a>
  </li>
  <!-- <li class="nav-item <?php echo activeMenu('Upload');?>">
    <a class="nav-link ajx-menu" page-title="Upload | Compliance Inbox" href="<?php echo base_url('Upload');?>">
      <i class="material-icons">cloud_upload</i>
      <p> Uploads </p>
    </a>
  </li> -->
<?php } if(hasPermission('viewClientDoc')>0) { ?>
  <li class="nav-item <?php echo activeMenu('ClientDocument');?>">
    <a class="nav-link ajx-menu" page-title="Client Document | Compliance Inbox" href="<?php echo base_url('ClientDocument');?>">
      <i class="material-icons">streetview</i>
      <p> Client Document </p>
    </a>
  </li>
<?php } if(hasPermission('viewDataRoom')>0) { ?>
  <li class="nav-item <?php echo activeMenu('DataRoom');?>">
    <a class="nav-link ajx-menu" page-title="Data Rooms | Compliance Inbox" href="<?php echo base_url('DataRoom');?>">
      <i class="material-icons">cloud</i>
      <p> Data Room </p>
    </a>
  </li>
<?php } if(hasPermission('viewZoomMeeting')>0) { ?>
  <li class="nav-item <?php echo activeMenu('CICalendar');?>">
    <a class="nav-link ajx-menu" page-title="List of Scheduled Meeting | Compliance Inbox" href="<?php echo base_url('CICalendar');?>">
      <i class="material-icons">calendar_view_day</i>
      <p> CI Calendar </p>
    </a>
  </li>
<?php } if(hasPermission(array('addOrg','editOrg','viewOrg'))>0) { ?>
  <li class="nav-item <?php echo activeMenu('Organization');?>">
    <a class="nav-link ajx-menu" page-title="List of Organizations | Compliance Inbox" href="<?php echo base_url('Organization');?>">
     <i class="material-icons">work</i>
     <p> Organization </p>
   </a>
 </li>
<?php } if(hasPermission('viewTaskTracker')>0) { ?>
 <li class="nav-item <?php echo activeMenu('Tracker');?>">
  <a class="nav-link ajx-menu" page-title="Task Tracker | Compliance Inbox" href="<?php echo base_url('Tracker');?>">
   <i class="material-icons">track_changes</i>
   <p>Task Tracker</p>
 </a>
</li>        
<?php } if(hasPermission(array('addUser','editUser','viewUser','addRole','editRole','viewRole'))>0) { ?>
  <li class="nav-item <?php echo activeMenu(array('Users','Roles','Permission'));?>">
    <a class="nav-link" data-toggle="collapse" href="#UserSetup" <?php if(in_array($this->uri->segment(1),array('Users','Roles','Permission'))){echo 'aria-expanded="true"';}?>>
     <i class="material-icons">account_circle</i>
     <p> User Setup 
      <b class="caret"></b>
    </p>
  </a>
  <div class="collapse  <?php if(in_array($this->uri->segment(1), array('Users','Roles','Permission'))){echo "show";}?>" id="UserSetup">
   <ul class="nav">
    <?php if(hasPermission(array('addUser','editUser','viewUser'))>0) { ?>
      <li class="nav-item <?php echo activeMenu('Users');?>">
        <a class="nav-link ajx-menu" page-title="List of Users | Compliance Inbox" href="<?php echo base_url('Users');?>">
         <span class="sidebar-mini"> U </span>
         <span class="sidebar-normal"> Users </span>
       </a>
     </li>
   <?php } 
   if(hasPermission(array('addRole','editRole','viewRole'))>0) { ?>
     <li class="nav-item <?php echo activeMenu('Roles');?>">
      <a class="nav-link ajx-menu" page-title="List of Roles | Compliance Inbox" href="<?php echo base_url('Roles');?>">
        <span class="sidebar-mini"> R </span>
        <span class="sidebar-normal"> Roles </span>
      </a>
    </li>
  <?php } if($this->session->userdata('UserOrgUID')==0) { ?>
    <li class="nav-item <?php echo activeMenu('Permission');?>">
     <a class="nav-link ajx-menu" page-title="List of Permission | Compliance Inbox" href="<?php echo base_url('Permission');?>">
      <span class="sidebar-mini"> P </span>
      <span class="sidebar-normal"> Permissions </span>
    </a>
  </li>
<?php } ?>
</ul>
</div>
</li>
<?php } if(hasPermission(array('addService','editService','viewService','addSubService','editSubService','viewSubService','addCompany','editCompany','viewCompany','addSetting','editSetting','viewSetting','addStatus','editStatus','viewStatus','addHolidayList','editHolidayList','viewHolidayList','addContact','editContact','viewContact','addDivision','editDivision','viewDivision'))>0) { ?>
  <li class="nav-item <?php echo activeMenu(array("Services","Subservices","Company",'Setting','Status','Holiday','Division'));?>">
    <a class="nav-link" data-toggle="collapse" href="#componentsExamples" <?php if(in_array($this->uri->segment(1), array("Services","Subservices","Company","Setting",'Status','Holiday','Contact','Division'))){echo 'aria-expanded="true"';}?>>
     <i class="material-icons">developer_board</i>
     <p> Company Setup 
      <b class="caret"></b>
    </p>
  </a>
  <div class="collapse <?php if(in_array($this->uri->segment(1), array("Services","Subservices","Company","Setting",'Status','Holiday','Contact','Division','Template'))){echo "show";}?>" id="componentsExamples">
   <ul class="nav">
    <?php if(hasPermission(array('addCompany','editCompany','viewCompany'))>0) { ?>
      <li class="nav-item <?php echo activeMenu('Company');?>">
        <a class="nav-link ajx-menu" page-title="List of Company | Compliance Inbox" href="<?php echo base_url('Company');?>">
          <span class="sidebar-mini"> C </span>
          <span class="sidebar-normal"> Companies </span>
        </a>
      </li>
    <?php } if(hasPermission(array('addDivision','editDivision','viewDivision'))>0) { ?> 
      <li class="nav-item <?php echo activeMenu('Division');?>">
        <a class="nav-link ajx-menu" page-title="List of Division | Compliance Inbox" href="<?php echo base_url('Division');?>">
         <span class="sidebar-mini"> D </span>
         <span class="sidebar-normal"> Division </span>
       </a>
     </li>
   <?php } if(hasPermission(array('addService','editService','viewService'))>0) { ?>
     <li class="nav-item <?php echo activeMenu('Services')?>">
       <a class="nav-link ajx-menu" page-title="List of Services | Compliance Inbox" href="<?php echo base_url('Services');?>">
        <span class="sidebar-mini"> R </span>
        <span class="sidebar-normal"> Services </span>
      </a>
    </li>
  <?php } if(hasPermission(array('addSubService','editSubService','viewSubService'))>0) { ?>
    <li class="nav-item <?php echo activeMenu('Subservices')?>">
      <a class="nav-link ajx-menu" page-title="List of Sub Services | Compliance Inbox" href="<?php echo base_url('Subservices');?>">
        <span class="sidebar-mini"> S </span>
        <span class="sidebar-normal"> Sub Services </span>
      </a>
    </li>
  <?php } if(hasPermission(array('addSetting','editSetting','viewSetting'))>0) { ?>
    <li class="nav-item <?php echo activeMenu('Setting')?>">
      <a class="nav-link ajx-menu" page-title="List of Settings | Compliance Inbox"  href="<?php echo base_url('Setting');?>">
        <span class="sidebar-mini"> S </span>
        <span class="sidebar-normal"> Settings </span>
      </a>
    </li>
  <?php } if(hasPermission(array('addStatus','editStatus','viewStatus'))>0) { ?>
    <li class="nav-item <?php echo activeMenu('Status')?>">
      <a class="nav-link ajx-menu" page-title="List of Status | Compliance Inbox" href="<?php echo base_url('Status');?>">
        <span class="sidebar-mini"> S </span>
        <span class="sidebar-normal"> Status </span>
      </a>
    </li>
  <?php } if(hasPermission(array('addHolidayList','editHolidayList','ViewHolidayList','deleteHolidayList'))>0) { ?>
    <li class="nav-item <?php echo activeMenu('Holiday')?>">
     <a class="nav-link ajx-menu" page-title="List of Holiday | Compliance Inbox"  href="<?php echo base_url('Holiday');?>">
      <span class="sidebar-mini"> H </span>
      <span class="sidebar-normal"> Holidays </span>
    </a>
  </li>
<?php } if(hasPermission(array('addTemplate','editTemplate','viewTemplate'))>0) { ?>
  <li class="nav-item <?php echo activeMenu('Template')?>">
   <a class="nav-link ajx-menu" page-title="List of Templates | Compliance Inbox"  href="<?php echo base_url('Template');?>">
    <span class="sidebar-mini"> T </span>
    <span class="sidebar-normal"> Templates </span>
  </a>
</li>
<?php } if(hasPermission(array('addWorkflow','editWorkflow','viewWorkflow'))>0) { ?>
  <li class="nav-item">
   <a class="nav-link ajx-menu" href="javascript:void(0);">
    <span class="sidebar-mini"> W </span>
    <span class="sidebar-normal"> Workflows </span>
  </a>
</li> 
<?php } ?>
</ul>
</div>
</li>  
<?php } if(hasPermission(array('addRegulatoryCalendar','editRegulatoryCalendar','viewRegulatoryCalendar'))>0) { ?>
  <li class="nav-item <?php echo activeMenu('Regulatory');?>">
    <a class="nav-link ajx-menu" page-title="List of Regulatory | Compliance Inbox" href="<?php echo base_url('Regulatory');?>">
      <i class="material-icons">calendar_today</i><p>Compliance Event</p>
    </a>
  </li>   
<?php } if(hasPermission('ChatRoom')>0) {  ?>
  <li class="nav-item <?php echo activeMenu('ChatRoom')?>">
    <a class="nav-link" href="<?php echo base_url('ChatRoom')?>">
      <i class="material-icons">chat</i>
      <p> Chat Room</p>
    </a>
  </li>
<?php } if(hasPermission('viewAuditTrail')>0) {?>    
<li class="nav-item <?php echo activeMenu('AuditTrail')?>">
  <a class="nav-link ajx-menu" page-title="List of Audit Logs | Compliance Inbox" href="<?php echo base_url('AuditTrail');?>">
    <i class="material-icons">query_builder </i>
    <p>Audit Trail</p>
  </a>
</li> 
<?php } 
if(hasPermission('viewUserLog')>0) {?>    
<li class="nav-item <?php echo activeMenu('UsersLogs')?>">
  <a class="nav-link ajx-menu" page-title="List of Users Logs | Compliance Inbox" href="<?php echo base_url('UsersLogs');?>">
    <i class="material-icons">history </i>
    <p>Logged History</p>
  </a>
</li> 
<?php } ?>     
</ul>                
</div>
</div>

<div class="main-panel">
 <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navigation-example">
  <div class="container-fluid">
   <div class="navbar-wrapper">
    <div class="navbar-minimize">
     <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
      <i class="material-icons text_align-center visible-on-sidebar-regular">menu</i>
      <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">clear</i>
    </button>
  </div>
  <a class="navbar-brand" href="javascript:void(0);" id="pagetitle"><?php echo $page_head;?></a>
</div>
<button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
  <span class="sr-only">Toggle navigation</span>
  <span class="navbar-toggler-icon icon-bar"></span>
  <span class="navbar-toggler-icon icon-bar"></span>
  <span class="navbar-toggler-icon icon-bar"></span>
</button>
<div class="collapse navbar-collapse justify-content-end">
 <!--  <form class="navbar-form">
   <div class="input-group no-border">   
    <button type="button" class="btn btn-white btn-round btn-just-icon" id="searchbtn">
     <i class="material-icons">search</i>
     <div class="ripple-container"></div>
   </button>
 </div>
</form> -->

<ul class="navbar-nav">
 <?php if(hasPermission('viewKYCDocument')>0) { ?>
  <li class="nav-item"  id="documentmodal">
    <a class="nav-link ajx-menu" page-title="Company Document | Compliance Inbox" href="javascript:void(0);" rel="tooltip" title="KYC Master Documents">
      <!--   <i class="material-icons">account_balance_wallet</i> -->
      <img src="<?php echo base_url()?>assets/img/wallet-with-bill.png" class="img-responsive" style="height: 21px;"/>
      <p> Master Documents </p>
    </a>
  </li>
<?php } 
if(hasPermission('viewSendEmail')>0) {
?>
<li class="nav-item">
 <a class="nav-link EmailSend" href="javascript:void(0);" rel="tooltip" title="Email">
  <i class="material-icons">email</i>
  <p class="d-lg-none d-md-block">     
   Email
 </p>
</a>
</li>
<?php } if(hasPermission('startZoomMeeting ')>0) { ?>
  <li class="nav-item">
   <a class="nav-link openZoom" href="javascript:void(0);" rel="tooltip" title="Zoom Meeting" id="triggerZoomMeeting">
    <i class="material-icons"><img src="<?php echo base_url() ?>assets/img/Zoom-icon.png" alt ="Zoom" style="width: 25px;"></i>
    <p class="d-lg-none d-md-block">     
     Zoom
   </p>
 </a>
</li>


<?php } ?>
<?php if(hasPermission('UserNotification')>0) { ?>

  <li class="nav-item dropdown usernotifylist">
    <a class="nav-link" href="javascript:void(0);" id="navbarDropdownMenuLink" data-toggle="dropdown" rel="tooltip" title="Notification" aria-haspopup="true" aria-expanded="false">
      <i class="material-icons">notifications</i>
      <span class="notification badge-usernotification"></span>
      <p class="d-lg-none d-md-block" title="Notifications">
        User Notification
      </p>
    </a>
    <div class="dropdown-menu dropdown-menu-right usernotificationlist-menu" aria-labelledby="navbarDropdownMenuLink" style="overflow-x: hidden !important; ">

    </div>
  </li>
<?php } ?>
</ul>

</div>
</div>

</nav>
<!-- End Navbar -->


<!-- Classic Modal -->

<div class="modal fade" id="EmailSendModal" tabindex="-1" role="dialog" aria-labelledby="EmailSendModalLabel" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">

       <h5 class="modal-title mb-10 text-left"><?php $IsLoogedUser = $this->Common_model->GetIsLoggedUserDetails();
       echo $IsLoogedUser->Name; ?>'s Email Section</h5>
       <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >
        <i class="material-icons btn-danger">clear</i>
      </button>        
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-md-6">
          <button class="btn btn-link btn-default" id="resizediv" style="margin-top: -10px;"><i class="material-icons">dehaze</i></button>

        </div>
        <div class="col-md-6 text-right"> 
          <?php if(hasPermission('addSendEmail')>0) { ?>
          <button class="btn btn-xs btn-link" id="backbtn" style="display: none"><i class="fa fa-arrow-left"></i></button>  
          <button class="btn btn-twitter btn-xs mt-0" id="composemail">Compose</button>  
         <?php } ?>
        </div>
      </div>
      <div class="messaging">
        <div class="inbox_msg">
          <div class="inbox_people perfectScrollbar">       
            <div class="inbox_chat">
            </div>
          </div>
          <div class="mesgs">
            <div class="msg_history">
              <div class="msg_header">
                <h6 class="msgtitle"></h6>
              </div>
              <div class="msg_content">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-10 pd-0">
                      <div class="chat_people">
                        <div class="chat_img"> 
                         <!--  <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil" class="userimg"> -->
                       </div>
                       <div class="chat_ib">
                        <h5 class="emailtotxt"></h5>
                        <h5 class="emailcctxt"></h5>
                        <h5 class="emailbcctxt"></h5>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2 text-right">
                    <p class="sentdate"></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="msg_body"> 
            <p>No preview has available</p>                 
            </div>
          </div> 


          <div class="composemail" style="display:none">
            <input type="hidden" name="email_id" id="email_id" class="form-control" value="<?php  echo $IsLoogedUser->UserUID; ?>">
            <input type="hidden" name="from" id="from" class="form-control" value="<?php  echo $IsLoogedUser->Email; ?>">
            <div class="col-md-12">                           
              <div class="row">                   
                <label for="emailtxt" class="col-md-1 mt-20">To</label>
                <div class="emailtag col-md-11 ">
                  <div id="tags" style="position: relative;">
                    <input type="text" class="filedboxStyle" id="to" name="to" autocomplete="on" id="emailtxt" />
                  </div>
                </div>                                      
              </div>  
            </div>
            <div class="col-md-12 mt-10  ccdiv">                     
              <div class="row">
                <label class="col-md-1 mt-20">CC</label>  
                <div class="ccemailtag col-md-11">
                  <div id="cctags" style="position: relative;">
                    <input type="text" class="ccemail" id="cc" name="cc" autocomplete="on" />
                  </div>
                </div> 
              </div> 
            </div>
            <div class="col-md-12 mt-10 bccdiv"> 
              <div class="row">
               <label class="col-md-1 mt-20">BCC</label>
               <div class="bccemailtag col-md-11">
                <div id="bcctags" style="position: relative;">
                  <input type="text" class="bccemail"  id="bcc" name="bcc"  autocomplete="on" />
                </div>
              </div> 
            </div>                          
          </div>                          
          <div class="col-md-12 col-xs-12 borderbtm">
            <div class="row">
              <label class="col-md-1 mt-20 text-center">Subject</label>
              <div class="col-md-11">
                <div class="form-group has-default">
                  <input type="text" class="form-control" name="mailsubjecttxt" id="mailsubjecttxt" />
                </div>
              </div>
            </div>   
          </div>
          <div class="row" id="mail_attch_div">
            <label class="col-md-2 mt-2 text-center"> Attachment</label>
           <div class="col-md-10">
            <div class="form-group has-info bmd-form-group" id="mail_attch_file" style="margin-top: -5px;padding: 0;"></div>
        </div>
      </div> 
          <div class="col-md-12 pd-0">      
            <textarea name="message" id="message" class="form-control message">
            </textarea>
          </div> 
          <div class="text-right" style="border-top: 1px solid #ddd;margin:0px;padding: 10px;">
           <div class="col-md-12">
            <div class="row">
              <div class="col-md-6 text-left">
                <button  class="btn btn-danger btn-cancel btn-sm">
                  <span class="btn-label"><i class="material-icons">clear</i></span>Cancel</button>                    
                </div>
                <div class="col-md-6 text-right">
                  <button type="submit" class="btn btn-facebook btn-submit btn-sm" id="btnEmail-submit">
                    <span class="btn-label"><i class="material-icons">check</i></span>Send</button> 
                  </div>
                </div>
              </div>
              <div class="pull-right col-md-12">

              </div>
            </div> 
          </div>
        </div>
      </div>      
    </div>
  </div>
</div>
</div>
</div>
<script type="text/javascript"> 

  $('[rel="tooltip"]').tooltip();   
  $('[rel="tooltip"]').click(function(event) {
    $('[rel="tooltip"]').tooltip('hide');
  });

  function displayNotifyUser(){
    $.ajax({
      type:"POST",
      dataType:"JSON",
      data:{},
      url:"<?php echo base_url('Email_Info/CountAjaxUserNotification'); ?>",
      success: function(response){
        $('.badge-usernotification').html(response);
      }
    });

    $(".usernotificationlist-menu").html(''); 
    $.ajax({
      type:"POST",
      dataType:"JSON",
      data : {},
      url:"<?php echo base_url('Email_Info/ListUserNotify'); ?>",  
      success:function (data) { 
       var appenddiv = '';               
       if(data.ListUserNotifiy.length > 0)
       {
        appenddiv = appenddiv + '<div class="col-md-12"><a class="editgoseen dropdown-item" data-countnotify="" data-NotifyID="" data-NotifyURL="" data-clear="allrow" id=""  style="width:100%;padding:0px;"><div class="col-md-12" style="padding:3px; cursor:pointer; color:#2196f3;">';
        appenddiv = appenddiv + 'Mark all as read</div></a></div>';
        for(var x = 0; x < data.ListUserNotifiy.length; x++)
        {
          var explodedData = data.ListUserNotifiy[x].Message.split(':');
          var UserPhoto = data.ListUserNotifiy[x].UserPhoto;         
          var dateToFormat = data.ListUserNotifiy[x].Notifydate;     
          var splitdate  = dateToFormat.split(" ");      
          var gettime = splitdate[1];      
          getval = gettime.split(":");  
          var timeformat  = (getval[0] < 12) ? "AM" : "PM";
          dateformat  = splitdate[0];
          dateformat =  dateformat.split("-");
          dformat = dateformat[1] + "/" + dateformat[2] + "/" + dateformat[0];   
          dformatval  = dformat + " " + getval[0] + ":"  + getval[1] + " " + timeformat;        
          var bg = '';
          if(x == 0){   
            bg   = "#fff";  
          }else{
           bg  = (x%2 == 1) ? "#f7f7f7" : "#fff";
         }  
         appenddiv = appenddiv + '<div class="col-md-12 noti_html" style="padding:0px;border-bottom:1px solid #f5f5f5;background:'+bg+'"><a  href="javascript:void(0);" class="editgoseen dropdown-item" data-countnotify="" data-NotifyID="'+data.ListUserNotifiy[x].NotificationUID+'" data-NotifyURL="'+data.ListUserNotifiy[x].Url+'" id="'+x+'" style="width:100%;padding:0px; color:#000;"><div class="row ma-0" style="width:100%;"><div class="col-md-2" style="padding:10px;"><img src="'+'<?php echo base_url(); ?>'+UserPhoto+'" alt="LOGO" class="structuredesign" /></div><div class="col-md-10" style="padding:0px 5px;"><p class="titletxt">'+explodedData[0]+' <span class="usernamedts">By '+ data.ListUserNotifiy[x].UserNameLog+'</span></p><p class="desctxt">'+explodedData[1]+'</p><span class="text-right notycreatedate">'+dformatval+'</span></div></div></div></div></a></div>';
       }              
     }
     else
     {
      appenddiv = appenddiv + '<div class="col-md-12" style="padding:3x"><a class="dropdown-item" style="width:100%;padding:0px;"><div class="col-md-12" style="padding:3px;">';
      appenddiv = appenddiv + 'No Data Found</div></a></div>';
    }
    $(".usernotificationlist-menu").html(appenddiv);  
  },
  error: function ( data ) {
    $.notify("Incorrect Access !",{
      type:"wanring",
      delay:1000
    });
  }
});
  }

  $(document).ready(function(ev) {
   if($("body").hasClass("sidebar-mini")){
    $(".blogo").show();
    $(".btext").hide(); 
  }else{
   $(".blogo").hide();
 }

 $("body").on("click" , "#minimizeSidebar" , function(){
  if($("body").hasClass("sidebar-mini")){
    $(".blogo").show(); 
  }else{
    $(".blogo").hide(); 
  }     
});

 $(".ajx-menu").click(function(){
  $(".blogo").hide();       
})
 var toggle = $('.ibs-modal-body #ss_toggle');
 var menu = $('.ibs-modal-body #ss_menu');
 var rot;

 $("body").on('click', '#documentmodal a' , function(ev) { 
  rot = parseInt($(".ibs-modal-body #ss_toggle").data('rot')) - 180;      
  menu.css('transform', 'rotate(' + rot + 'deg)');
  menu.css('webkitTransform', 'rotate(' + rot + 'deg)');
  if ((rot / 180) % 4 == 0) {
      //Moving in
      toggle.parent().addClass('ss_active');
      toggle.addClass('close');
    } else {
      //Moving Out
      toggle.parent().removeClass('ss_active');
      toggle.removeClass('close');
    }
    $(this).data('rot', rot);
  });

 menu.on('transitionend webkitTransitionEnd oTransitionEnd', function() {
  if ((rot / 180) % 4 == 0) {
    $('#ss_menu div i').addClass('ss_animate');
  } else {
    $('#ss_menu div i').removeClass('ss_animate');
  }
});

});

  $(document).ready(function(){    
   $('#componentsExamples').on('shown.bs.collapse', function() {
     $('.sidebar-wrapper').scrollTop($(".sidebar-wrapper").prop("scrollHeight"));
     $('.sidebar-wrapper').perfectScrollbar('update'); 
     $('.sidebar-wrapper').animate({ scrollTop: $(".sidebar-wrapper").prop("scrollHeight") }, 600);
   });
   $('#UserSetup').on('shown.bs.collapse', function() {
     $('.sidebar-wrapper').scrollTop($(".sidebar-wrapper").prop("scrollHeight"));
     $('.sidebar-wrapper').perfectScrollbar('update'); 
     $('.sidebar-wrapper').animate({ scrollTop: $(".sidebar-wrapper").prop("scrollHeight") }, 600);
   });
   $('#componentsExamples').on('hidden.bs.collapse', function() {
     $('.sidebar-wrapper').scrollTop($(".sidebar-wrapper").prop("scrollHeight"));
     $('.sidebar-wrapper').perfectScrollbar('update'); 
     $('.sidebar-wrapper').animate({ scrollTop: $(".sidebar-wrapper").prop("scrollHeight") }, 600);
   });
   $('#UserSetup').on('hidden.bs.collapse', function() {
     $('.sidebar-wrapper').scrollTop($(".sidebar-wrapper").prop("scrollHeight"));
     $('.sidebar-wrapper').perfectScrollbar('update'); 
     $('.sidebar-wrapper').animate({ scrollTop: $(".sidebar-wrapper").prop("scrollHeight") }, 600);
   });
   displayNotifyUser();
   $("body").on("click" ,".usernotifylist", function(e){  
    displayNotifyUser();
  });

   $("body").on("click" ,".editgoseen", function(e){
    e.preventDefault();
    timer = setTimeout(function () {          
      $('.usernotificationlist-menu').hide(500);
    }, 1500); 
    clearTimeout(timer);
    NotifyURL = $(this).attr("data-NotifyURL"); 
    NotifyID = $(this).attr("data-NotifyID");       
    Rowclear = $(this).attr("data-clear");       
    let removeRow = $(this).closest("a").attr('id');   
    let countnotifyvalue = $('.badge-usernotification').html();
    let subcountnotify = countnotifyvalue - 1;
    $('.usernotificationlist-menu').removeClass('show');
    $.ajax({
      type:"POST",
      dataType:"JSON",
      data : {"Url":NotifyURL,"NotifyID":NotifyID},
      url:"<?php echo base_url('Email_Info/UserNotification'); ?>",  
      success:function (data) {  

        if(Rowclear == 'allrow')
        {
          subcountnotify = 0;              
          window.location.reload('<?php echo base_url('Dashboard')?>');              
        }
        else
        {
          $('#'+removeRow).closest("a").remove();                
        }

        $('.badge-usernotification').html(subcountnotify); 
        var url = NotifyURL;
        var newHash = NotifyURL;
        history.pushState(null, null, url);
        $('title').html(NotifyURL + ' | Compliance Inbox');
        Confirm_Click(newHash,url);
      },
      error: function ( data ) {
        $.notify("Incorrect Access !",{
          type:"wanring",
          delay:1000
        });
      }
    });
    
    e.stopImmediatePropagation();
  });
 }); 


  function validateEmail(inputValue, that) {
   if(inputValue == '') { return 0;}
   var emailAddresses = inputValue.replace(/\s+$/, '').split(",");
   var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
   $.each(emailAddresses , function(m,n){
    if (regex.test(n)) {
      $("<span/>", { text: n.toLowerCase(), insertBefore: that, class: 'emailAdd', tabindex: '1' });
    }
    else {
      $.notify("Invalid Email Id",{
       type:"warning",
       delay:1000
     });  
    }
  })

   that.value = "";
 }



 function listsentmail(){
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth()+1; 
  var yyyy = today.getFullYear();
  if(dd<10){  dd='0'+dd; } 
  if(mm<10){  mm='0'+mm; } 
  var currentdate = yyyy + '-' + mm + '-' + dd;
  $.ajax({
    type : "get",
    url: "<?php echo base_url('Email_Info/getsentlist')?>",
    async : false,
    success :  function(data){  
     var appenddata = JSON.parse(data);
     var appenddiv = '';
     $.each(appenddata , function(m,n){
      var maildate = ''
      var createddate = n.EmailDate;
      createddatearr = createddate.split(/(\s+)/);     
      date1 = new Date(createddatearr[0]);
      date2 = new Date(currentdate);
      if(date1 == date2){
        maildate = createddatearr[2];
      }else{
        maildate = createddatearr[0];
      }
      appenddiv = appenddiv + '<div class="chat_list"><input type="hidden" value='+n.SentEmailUID+' /><div class="chat_people"><div class="chat_img"><img src="'+n.UserPhoto+'" alt="Logo Avatar" style="width: 40px !important;"></div><div class="chat_ib"><h5>'+n.Name+'<span class="chat_date">'+maildate+'</span></h5><p>'+n.Subject+'</p></div></div></div>';
    });
     if(appenddiv == '') {
      $(".inbox_chat").append("<p class='emptytxt'><i class='material-icons'>block</i> <br> No mail has available</p>");   
     }else{
      $(".inbox_chat").append(appenddiv);   
    }
  }
});
}
listsentmail();
var usersemailid = [];
$.ajax({
  type : "get",
  url: "<?php echo base_url('Email_Info/getemailId')?>",
  async : false,
  success :  function(data){
   var emaillist  = JSON.parse(data);
   $.each(emaillist , function(m,n){
    usersemailid.push(n.Email);
  });
 }
});
$('#tags').on('click', 'span', function () {
  $(this).remove();
});
$('#cctags').on('click', 'span', function () {
  $(this).remove();
});
$('#bcctags').on('click', 'span', function () {
  $(this).remove();
});

$(".ccbtn").click(function(e){
  e.preventDefault();
  $(".ccdiv").toggle();   
});

$(".bccbtn").click(function(e){
  e.preventDefault();
  $(".bccdiv").toggle();   
});


$("#resizediv").click(function(){
  $(".inbox_people").toggleClass("width0");
  $(".mesgs").toggleClass("width98");
});

$("body .modal .filedboxStyle").autocomplete({ 
  maxResults: 10,
  source: function(request, response) {
    var results = jQuery.ui.autocomplete.filter(usersemailid, request.term);        
    response(results.slice(0, this.options.maxResults));
  }
});
$("body .modal .ccemail").autocomplete({ 
  maxResults: 10,
  source: function(request, response) {
    var results = jQuery.ui.autocomplete.filter(usersemailid, request.term);        
    response(results.slice(0, this.options.maxResults));
  }
});
$("body .modal .bccemail").autocomplete({ 
  maxResults: 10,
  source: function(request, response) {
    var results = jQuery.ui.autocomplete.filter(usersemailid, request.term);        
    response(results.slice(0, this.options.maxResults));
  }
});

$("body #EmailSendModal .emailtag").on("keyup" , function(ev){
  if (/(8)/.test(ev.which)) {
    if ($('#tags span').last().hasClass("focusTag")) {
      backKeyPressed++;
      if (backKeyPressed % 2 === 0) {
        $('#tags span').last().remove();
        $('#tags span').last().addClass("focusTag");
        backKeyPressed = 1;
      }
    }
  } 
  ev.stopPropagation();
});

$("body #EmailSendModal .ccemailtag").on("keyup" , function(ev){  
  if (/(8)/.test(ev.which)) {
    if ($('#cctags span').last().hasClass("focusTag")) {
      backKeyPressed++;
      if (backKeyPressed % 2 === 0) {
        $('#cctags span').last().remove();
        $('#cctags span').last().addClass("focusTag");
        backKeyPressed = 1;
      }
    }
  } 
  ev.stopPropagation();
});

$("body #EmailSendModal .bccemailtag").on("keyup" , function(ev){
  if (/(8)/.test(ev.which)) {
    if ($('#bcctags span').last().hasClass("focusTag")) {
      backKeyPressed++;
      if (backKeyPressed % 2 === 0) {
        $('#bcctags span').last().remove();
        $('#bcctags span').last().addClass("focusTag");
        backKeyPressed = 1;
      }
    }
  } 
  ev.stopPropagation();
});


$("body #EmailSendModal #tags input").on("keydown" , function(ev){  
 if(ev.keyCode  === 9){
   var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;   
   var getvalue  = this.value;
   getarr  = getvalue.split(",");
   if(getarr.length > 0){
     validateEmail(this.value, this);  
   }else{
     if(emailReg.test(this.value)) {  
      validateEmail(this.value, this);    
    }   else{
      this.value = "";
    }  
  }
}    
ev.stopPropagation();     
});

$("body #EmailSendModal #cctags input").on("keydown" , function(ev){  
 if(ev.keyCode  === 9){
   var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;   
   var getvalue  = this.value;
   getarr  = getvalue.split(",");
   if(getarr.length > 0){    
     validateEmail(this.value, this);  
   }else{
     if(emailReg.test(this.value)) {  
      validateEmail(this.value, this);    
    }   else{
      this.value = "";
    }  
  }
}     
ev.stopPropagation();    
});


$("body #EmailSendModal #bcctags input").on("keydown" , function(ev){  
 if(ev.keyCode  === 9){
   var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;   
   var getvalue  = this.value;
   getarr  = getvalue.split(",");
   if(getarr.length > 0){
     validateEmail(this.value, this);  
   }else{
     if(emailReg.test(this.value)) {  
      validateEmail(this.value, this);    
    }   else{
      this.value = "";
    }  
  }
}      
ev.stopPropagation();    
});



$("body #EmailSendModal #tags input").on("keyup" , function(ev){ 
  ev.preventDefault();
  if (/(13|32)/.test(ev.which) && this.value) {
    validateEmail(this.value, this);
  }
  if (/(8)/.test(ev.which)) {
    if (!this.value) {
      if ($('#tags span').last().hasClass("focusTag")) {
      }
      else {
        $('#tags span').last().addClass("focusTag");
      }
    }
  }
  ev.stopPropagation();
});

$("body #EmailSendModal #cctags input").on("keyup" , function(ev){
  ev.preventDefault();
  if (/(13|32)/.test(ev.which) && this.value) {
    validateEmail(this.value, this);  }
    if (/(8)/.test(ev.which)) {
      if (!this.value) {
        if ($('#cctags span').last().hasClass("focusTag")) {
        }
        else {
          $('#cctags span').last().addClass("focusTag");
        }
      }
    }
    ev.stopPropagation();
  });

$("body #EmailSendModal #bcctags input").on("keyup" , function(ev){
  ev.preventDefault();
  if (/(13|32)/.test(ev.which) && this.value) {
    validateEmail(this.value, this);  }
    if (/(8)/.test(ev.which)) {
      if (!this.value) {
        if ($('#bcctags span').last().hasClass("focusTag")) {
        }
        else {
          $('#bcctags span').last().addClass("focusTag");
        }
      }
    }
    ev.stopPropagation();
  });


tinymce.init({ selector:'#message',height:150});
$("body").on("click" ,".EmailSend" , function(){
  $('#EmailSendModal').modal({backdrop: 'static', keyboard: false});
  $('#EmailSendModal').css('overflow-y','hidden');    
  $('#EmailSendModal').modal('show');
});

$(".chat_list").click(function(){
 $(".chat_list").removeClass("active_chat");
 $(this).addClass("active_chat");
 var today = new Date();
 var dd = today.getDate();
 var mm = today.getMonth()+1; 
 var yyyy = today.getFullYear();
 if(dd<10){  dd='0'+dd; } 
 if(mm<10){  mm='0'+mm; } 
 var currentdate = yyyy + '-' + mm + '-' + dd;
 var dd = $(this).children('input:hidden').val();
 $.ajax({
  type : "get",
  url: "<?php echo base_url('Email_Info/getsentlist')?>",
  async : false,
  success :  function(data){  
    var emaildata  = JSON.parse(data);
    $.each(emaildata, function(m,n){
      if(n.SentEmailUID == dd){ 

        var maildate = ''
        var createddate = n.EmailDate;
        createddatearr = createddate.split(/(\s+)/);     
        date1 = new Date(createddatearr[0]);
        date2 = new Date(currentdate);
        if(date1 == date2){
          maildate = createddatearr[2];
        }else{
          maildate = createddatearr[0];
        }            
        $(".msgtitle").text(n.Subject);
        if(n.Cc == ""){
         $(".emailcctxt").css("display" , "none");
       }else{
        $(".emailcctxt").css("display" , "block");
      }
      if(n.Bcc == ""){
       $(".emailbcctxt").css("display" , "none");
     }else{
       $(".emailbcctxt").css("display" , "block");
     }
     $(".emailtotxt").html("<strong>To :</strong>" + n.EmailTo);
     $(".emailcctxt").html("<strong>CC :</strong>" +n.Cc);
     $(".emailbcctxt").html("<strong>BCC :</strong>" +  n.Bcc);         
     $(".sentdate").text(maildate);     
     $(".msg_body").html(n.Body);

   }
 });
  }
});
});


function clearEmailFields()
{
  $('#to').val('');
  $('#cc').val('');
  $('#bcc').val('');
  
  $('#bcc').val("<?php echo $IsLoogedUser->Email?>").trigger('keyup');
  $("body #EmailSendModal #bcctags input").trigger('keyup');

  $('.emailAdd').html('');
  $('.emailAdd').css('display','none');
  $('.filedboxStyle').html('');
  $('#mailsubjecttxt').val('');
  tinyMCE.activeEditor.setContent('');
}
$("#composemail").click(function(){
  clearEmailFields();
  $(".msg_history").hide();
  $(".composemail").show();
  $('#mail_attch_div').hide();
  $('#mail_attch_file').html('');
  localStorage.removeItem('attachments');
  $("#backbtn").show();
});

$(".chat_list").click(function(){
  $(".msg_history").show();
  $('#mail_attch_div').hide();
  $('#mail_attch_file').html('');
  localStorage.removeItem('attachments');
  $(".composemail").hide();
  $("#backbtn").hide();
});

$(".btn-cancel").click(function(e){
  e.preventDefault();
  clearEmailFields();
  $('#mail_attch_div').hide();
  $('#mail_attch_file').html('');
  localStorage.removeItem('attachments');
  $(".msg_history").show();
  $(".composemail").hide();
  $("#backbtn").hide();
});

$("#backbtn").click(function(e){
  e.preventDefault();
  $(".msg_history").show();
  $(".composemail").hide();
  $(this).hide();
});

$('#EmailSendModal').on('hidden.bs.modal',function()
{
  $('#backbtn').trigger('click');
  $('#mail_attch_div').hide();
  $('#mail_attch_file').html('');
  localStorage.removeItem('attachments');
});

$("#btnEmail-submit").click(function(e){
  e.preventDefault();
  var tomailarr = '';
  var ccmailarr = '';
  var bccmailarr ='';
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/; 
  tomail =  $("#tags input").val();
  toarray = $('#tags input').val().split(",");
  $.each(toarray , function(m,n){    
   if(emailReg.test(n)) {  
    tomailarr = tomailarr + n + ',';
  } 
});

  ccmail =  $("#cctags input").val();
  ccarray = $('#cctags input').val().split(",");
  $.each(ccarray , function(m,n){      
    if(emailReg.test(n)) {  
      ccmailarr = ccmailarr + n + ',';
    } 
  });

  bccmail =  $("#bcctags input").val();
  bccarray = $('#bcctags input').val().split(",");
  $.each(bccarray , function(m,n){    
    if(emailReg.test(n)) {  
      bccmailarr = bccmailarr + n + ',';
    }  
  });
  $("#tags span").each(function(){
    tomailarr = tomailarr +  $(this).text() + ','; 
  });
  $("#cctags span").each(function(){
    ccmailarr = ccmailarr +  $(this).text() + ',';   
  });
  $("#bcctags span").each(function(){
   bccmailarr = bccmailarr +  $(this).text() + ',';   
 });
  tomailarr = tomailarr.slice(0,-1);
  ccmailarr = ccmailarr.slice(0,-1);
  bccmailarr = bccmailarr.slice(0,-1);

  var mailsubjecttxt  = $("#mailsubjecttxt").val().trim();
  var message=tinymce.get('message').getContent();
  var email_id = $("#email_id").val().trim();
  var from = $("#from").val().trim();
  var obj  = {};
  obj["to"] = tomailarr;
  obj["cc"] = ccmailarr;
  obj["bcc"] = bccmailarr;
  obj["subject"] = mailsubjecttxt;
  obj["message"] = message;
  obj["email_id"] = email_id;
  obj["from"] = from;
  obj['attachment'] = localStorage.getItem('attachments');

  $.ajax({
    url: "<?php echo base_url(''); ?>Email_Info/",
    type:"POST",
    dataType: "JSON",    
    data:obj,          
    beforeSend: function(){
      $('.btn-submit').html('Sending ...');
      $('.btn-submit').attr('disabled',true);
    },
    success: function (data) 
    {  
      if(data.length!=0)  
      {
        if(data.validation_error==0)
        {
         $('#EmailSendModal').modal('hide');
         swal({
          title: 'Success',
          text: data.message,
          type: 'success',
          confirmButtonClass: "btn btn-success",
          allowOutsideClick: false,
          allowEscapeKey: false,
          buttonsStyling: false
        }).then(function() {                 
          localStorage.removeItem('attachments');
          location.reload();   
        }, function(dismiss){ });
      } else {
        $.notify(data.message,{
         type:data.type,
         z_index : 999999,
         delay:1000
       });
      }
    }
    $('.btn-submit').attr('disabled',false);  
    $('.btn-submit').html('<i class="material-icons">check</i> Send');
  }
});
  e.stopImmediatePropagation();

});



$(".EmailSend").click(function(){
  $("#tags span").remove();
  $("#cctags span").remove();
  $("#bcctags span").remove();
  $("#bcc").val("");
  $("#cc").val("");
  $("#to").val("");
  $("#mailsubjecttxt").val("");
  $(".msgtitle").text("");
  $(".sentdate").text("");
  $(".emailtotxt").text("");
  $(".emailcctxt").text("");
  $(".emailbcctxt").text("");
  $(".msg_body").html("<p class='emptytxt'>No Preview has available.</p>");
});

$("#EmailSendForm").on('submit',function(e){ 
  e.preventDefault();
  var message=tinymce.get('message').getContent();
  var Data = new FormData($('#EmailSendForm')[0]);
  Data.append('message',message);
  Data.append('attachment',localStorage.getItem('attachments'));
  var TaskUID = $('#TaskUID').val();
  $.ajax({
    url: "<?php echo base_url(''); ?>Email_Info/",
    type:"POST",
    dataType: "JSON",
    processData: false,
    contentType: false,
    data:Data,          
    beforeSend: function(){
      $('.btn-submit').html('Sending ...');
      $('.btn-submit').attr('disabled',true);
    },
    success: function (data) 
    {  
      if(data.length!=0)  
      {
        if(data.validation_error==0)
        {
         $('#EmailSendModal').modal('hide');
         swal({
          title: 'Success',
          text: data.message,
          type: 'success',
          confirmButtonClass: "btn btn-success",
          allowOutsideClick: false,
          allowEscapeKey: false,
          buttonsStyling: false
        }).then(function() {
          localStorage.removeItem('attachments');
          window.location.reload();  
        }, function(dismiss){ });
      } else {
        $.notify(data.message,{
         type:data.type,
         z_index : 999999,
         delay:1000
       });
      }
    }
    $('.btn-submit').attr('disabled',false);  
    $('.btn-submit').html('<i class="material-icons">check</i> Send');
  }
});
  e.stopImmediatePropagation();
});   
</script> 

<link rel="stylesheet" href="<?php echo base_url('assets/chat/emoji/wdt-emoji-bundle.css');?>"/>
<script type="text/javascript" src="<?php echo base_url('assets/chat/emoji/emoji.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/chat/emoji/wdt-emoji-bundle.js');?>"></script>
<script type="text/javascript">
  const LOGGEDUID = "<?php echo $this->LoggedID?>";
  const ORGUID = "<?php echo $this->OrgUID?>";
// emoji
wdtEmojiBundle.defaults.emojiSheets = {
  'apple': '<?php echo base_url("assets/chat/emoji/sheets/sheet_apple_64_indexed_128.png") ?>'
};
</script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/select2/select2.full.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/select2/pmd-select2.js"></script>
<script type="text/javascript">


  $.fn.select2.amd.define('select2/selectAllAdapter', [
    'select2/utils',
    'select2/dropdown',
    'select2/dropdown/attachBody'
    ], function (Utils, Dropdown, AttachBody) {

      function SelectAll() { }
      SelectAll.prototype.render = function (decorated) {
        var self = this,
        $rendered = decorated.call(this),
        $selectAll = $('<li class="select2-results__option" role="treeitem" id="select2-select-all" style="list-style-type: none; cursor:pointer"><i class="material-icons" style="font-size: 16px;vertical-align: text-bottom;">done</i> Select All</li>'),
        $btnContainer = $('<div style="margin-top:3px;">').append($selectAll);
        if (!this.$element.prop("multiple")) {
          return $rendered;
        }

        $rendered.find('.select2-dropdown').prepend($btnContainer);

        $selectAll.on('click', function (e) {
          var $select_opti = $rendered.find('.select2-results__option[aria-selected=false]');
          var $deselect_opti = $rendered.find('.select2-results__option[aria-selected=true]');
          if($select_opti.length>0)
          {
            var action = 'SelectAll';
            var $results = $select_opti;
            $('#select2-select-all').html('<i class="material-icons" style="font-size: 16px;vertical-align: text-bottom;">close</i> Clear All');
          } else {
            var action = 'DeselectAll';
            var $results = $deselect_opti;
            $('#select2-select-all').html('<i class="material-icons" style="font-size: 16px;vertical-align: text-bottom;">done</i> Select All');
          } 
          $results.each(function () {
           if(action == 'SelectAll')
           {
            self.trigger('select', {
              data: $(this).data('data')
            });                
          } else {
            self.trigger('unselect', {
              data: $(this).data('data')
            });                
          }
        });
          self.trigger('close');
        });
        return $rendered;
      };
      return Utils.Decorate(
        Utils.Decorate(
          Dropdown,
          AttachBody
          ),
        SelectAll
        );
  });
  
  function select2picker() 
  {
    $('.select2picker').select2({ 
     tags: false,
     theme: "bootstrap",
     dropdownAdapter: $.fn.select2.amd.require('select2/selectAllAdapter')
   });
  }

  $(document).on('select2:select','.select2picker', function(e){
    var total = $(this).find('option').length;
    var select = $(this).find('option:selected').length;
    if(total == select)
    {
      $('#select2-select-all').html('<i class="material-icons" style="font-size: 16px;vertical-align: text-bottom;">close</i> Clear All');
    } else {
      $('#select2-select-all').html('<i class="material-icons" style="font-size: 16px;vertical-align: text-bottom;">done</i> Select All');
    }
  });

  $(document).on('select2:unselect','.select2picker', function(e){
    var total = $(this).find('option').length;
    var select = $(this).find('option:selected').length;
    if(select < total)
    {
      $('#select2-select-all').html('<i class="material-icons" style="font-size: 16px;vertical-align: text-bottom;">done</i> Select All');
    } else {
      $('#select2-select-all').html('<i class="material-icons" style="font-size: 16px;vertical-align: text-bottom;">close</i> Clear All');
    }
  });

  $(document).on('select2:open','.select2picker', function(e){
    var total = $(this).find('option').length;
    var select = $(this).find('option:selected').length;
    if(select < total)
    {
      $('#select2-select-all').html('<i class="material-icons" style="font-size: 16px;vertical-align: text-bottom;">done</i> Select All');
    } else {
      $('#select2-select-all').html('<i class="material-icons" style="font-size: 16px;vertical-align: text-bottom;">close</i> Clear All');
    }
  });

  $('.collapse').on('show.bs.collapse', function () {
    $('.collapse.show').each(function(){
      $(this).collapse('hide');
    });
  });
</script>
