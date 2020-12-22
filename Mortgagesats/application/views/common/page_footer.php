<!-- <div class="fixed-plugin">
  <div class="dropdown show-dropdown pd-10">
    <a href="#" data-toggle="dropdown">
      <i class="ion-android-settings" style="color:#fff"> </i>
    </a>
    <ul class="dropdown-menu">
      <li class="header-title"> Sidebar Filters</li>
      <li class="adjustments-line">
        <a href="javascript:void(0)" class="switch-trigger active-color">
          <div class="badge-colors ml-auto mr-auto">
            <span class="badge filter badge-purple" data-color="purple"></span>
            <span class="badge filter badge-azure" data-color="azure"></span>
            <span class="badge filter badge-green" data-color="green"></span>
            <span class="badge filter badge-warning" data-color="orange"></span>
            <span class="badge filter badge-danger" data-color="danger"></span>
            <span class="badge filter badge-rose active" data-color="rose"></span>
          </div>
          <div class="clearfix"></div>
        </a>
      </li>


      <li class="header-title">Sidebar Background</li>
      <li class="adjustments-line">
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="ml-auto mr-auto">
            <span class="badge filter badge-black active" data-background-color="black"></span>
            <span class="badge filter badge-white" data-background-color="white"></span>
            <span class="badge filter badge-red" data-background-color="red"></span>
          </div>
          <div class="clearfix"></div>
        </a>
      </li>

      <li class="adjustments-line">
        <a href="javascript:void(0)" class="switch-trigger">
          <p>Sidebar Mini</p>
          <label class="ml-auto">
            <div class="togglebutton switch-sidebar-mini">
              <label>
                <input type="checkbox">
                <span class="toggle"></span>
              </label>
            </div>
          </label>
          <div class="clearfix"></div>
        </a>
      </li>

      <li class="adjustments-line">
        <a href="javascript:void(0)" class="switch-trigger">
          <p>Sidebar Images</p>
          <label class="switch-mini ml-auto">
            <div class="togglebutton switch-sidebar-image">
              <label>
                <input type="checkbox" checked="">
                <span class="toggle"></span>
              </label>
            </div>
          </label>
          <div class="clearfix"></div>
        </a>
      </li>

      <li class="header-title">Images</li>

      <li class="active">
        <a class="img-holder switch-trigger" href="javascript:void(0)">
          <img src="<?php echo base_url();?>assets/img/sidebar-1.jpg" alt="">
        </a>
      </li>
      <li>
        <a class="img-holder switch-trigger" href="javascript:void(0)">
          <img src="<?php echo base_url();?>assets/img/sidebar-2.jpg" alt="">
        </a>
      </li>
      <li>
        <a class="img-holder switch-trigger" href="javascript:void(0)">
          <img src="<?php echo base_url();?>assets/img/sidebar-3.jpg" alt="">
        </a>
      </li>
      <li>
        <a class="img-holder switch-trigger" href="javascript:void(0)">
          <img src="<?php echo base_url();?>assets/img/sidebar-4.jpg" alt="">
        </a>
      </li>
    </ul>
  </div>
</div> -->
<?php if(hasPermission('startZoomMeeting ')>0) { ?>
  <div class="modal fade ZoomMeetingModal" id="ScheduleZoomModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><img src="<?php echo base_url('assets/img/Zoom-icon.png')?>" width="40"> Schedule Zoom Meeting</h4><button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
        </div>
        <form id="ScheduleZoomMeetingForm" name="ScheduleZoomMeetingForm" style="margin: 0;"> 
          <div class="modal-body">
            <div class="col-md-12">
              <div class="row">
                <label class="col-sm-2 col-form-label">Topic</label>
                <div class="col-sm-10">
                  <div class="form-group bmd-form-group">
                    <input type="text" id="ZoomMeetingTopic" name="ZoomMeetingTopic" class="form-control">
                  </div>
                </div>
              </div> 
              <div class="row">
                <label class="col-sm-2 col-form-label">Description </label>
                <div class="col-sm-10">
                  <div class="form-group bmd-form-group">
                    <input type="text" name="ZoomMeetingDesc" placeholder="Enter your meeting description" class="form-control">
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">When </label>
                <div class="col-sm-10">
                  <div class="row">
                    <div class="col-sm-5 form-group">
                      <label for="ZoomMeetingStartDate" class="bmd-label-floating">Start Date</label>
                      <input type="text" id="ZoomMeetingStartDate" name="ZoomMeetingStartDate" value="<?php echo date('m/d/Y');?>" class="form-control SchduleZoomdatepicker" autocomplete="off">
                    </div>
                    <div class="col-sm-4 form-group">
                      <label for="ZoomMeetingStartTime" class="bmd-label-floating">Start Time</label>
                      <input type="text" id="ZoomMeetingStartTime" value="<?php echo date('h:i A');?>" name="ZoomMeetingStartTime" class="form-control ScheduleZoomtimepicker" autocomplete="off">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-5 form-group">
                      <label for="ZoomMeetingEndDate" class="bmd-label-floating">End Date</label>
                      <input type="text" id="ZoomMeetingEndDate" value="<?php echo date('m/d/Y');?>" name="ZoomMeetingEndDate" class="form-control SchduleZoomdatepicker" autocomplete="off">
                    </div>
                    <div class="col-sm-4 form-group">
                      <label for="ZoomMeetingEndTime" class="bmd-label-floating">End Time</label>
                      <input type="text" id="ZoomMeetingEndTime" value="<?php echo date('h:i A',strtotime('+30 minutes'));?>" name="ZoomMeetingEndTime" class="form-control ScheduleZoomtimepicker" autocomplete="off">
                    </div>
                  </div> 
                </div>
              </div>
              <div class="row">
               <label class="col-sm-2 col-form-label">Video </label>
               <div class="col-sm-10">
                <div class="row">
                  <div class="col-sm-2 form-group">
                    <label>Host</label>
                  </div>
                  <div class="col-sm-2 form-group">
                    <div class="togglebutton">
                      <label>
                       <input type="checkbox" class="ZoomRadio" name="ZoomMeetingHost" id="ZoomHost">
                       <span class="toggle"></span><span id="ZoomHost">Off</span>
                     </label>
                   </div>
                 </div>
                 <div class="col-sm-3 form-group">
                  <label>Participant</label>
                </div>
                <div class="col-sm-2 form-group">
                  <div class="togglebutton">
                    <label>
                     <input type="checkbox" class="ZoomRadio" name="ZoomMeetingParticipant" id="ZoomParticipant">
                     <span class="toggle"></span><span id="ZoomParticipant">Off</span>
                   </label>
                 </div>
               </div>
             </div>                
           </div>
         </div>
         <div class="row">
           <label class="col-sm-2 col-form-label">Audio </label>
           <div class="col-sm-10">
            <div class="row">
              <div class="col-sm-3 form-group">
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input ZoomAudioOpt" name="ZoomAudioOpt" value="telephony"> Telephone
                    <span class="circle">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
              </div>
              <div class="col-sm-4 form-group">
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input ZoomAudioOpt" value="voip" name="ZoomAudioOpt"> Computer Audio
                    <span class="circle">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
              </div>
              <div class="col-sm-2 form-group">
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input ZoomAudioOpt" name="ZoomAudioOpt" value="both" checked> Both
                    <span class="circle">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
              </div>  
            </div>                
          </div>
        </div>
        <div class="row">
          <label class="col-sm-2 col-form-label">Meeting Option </label>
          <div class="col-sm-10">
            <div class="row">
              <div class="col-sm-5 form-group">
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" name="ZoomMeetingOpt[]" id="ZoomPasswordRequired" value="Password" type="checkbox"> Require meeting password
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
                <input type="text" id="ZoomMeetingPassword" style="display: none;" name="ZoomMeetingPassword" class="form-control" placeholder="Enter Password" maxlength="10">
              </div>
              <div class="col-sm-5 form-group">
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" name="ZoomMeetingOpt[]" value="BeforeHost" type="checkbox"> Enable join before host
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
              </div>
              <div class="col-sm-5 form-group">
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" name="ZoomMeetingOpt[]" value="MuteParticipants" type="checkbox"> Mute participants upon entry
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
              </div>
              <div class="col-sm-6 form-group">
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" name="ZoomMeetingOpt[]" value="PersonalMeetingID" type="checkbox"> Use Personal Meeting ID
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
              </div>
              <div class="col-sm-5 form-group">
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" name="ZoomMeetingOpt[]" value="WaitingRoom" type="checkbox"> Enable waiting room
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
              </div>
              <div class="col-sm-6 form-group">
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" name="ZoomMeetingOpt[]" value="Record" type="checkbox"> Record the meeting automatically
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
              </div> 
            </div>                
          </div>
        </div>
      </div> 
    </div>
    <div class="modal-footer">
      <div class="form-group text-right">
        <button type="submit" id="ScheduleMeeting-btn" class="btn btn-info ZoomMeet-btn"><i class="material-icons">calendar_today</i> &nbsp; Schedule Meeting</button>
        <button type="reset" class="btn btn-danger ZoomMeet-btn" data-dismiss="modal"><i class="material-icons">close</i> Close</button>
      </div>
    </div>
  </form>
</div>
</div>
</div>

<div class="modal fade ZoomMeetingModal" id="SendZoomInvitationModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><img src="<?php echo base_url('assets/img/Zoom-icon.png')?>" width="40"> Send Zoom Invitation</h4><button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
      </div>
      <form id="SendZoomMeetinglink" name="SendZoomMeetinglink" style="margin: 0;"> 
        <div class="modal-body">
          <div class="col-md-12"> 
            <div class="row">
              <label class="col-sm-2 col-form-label">To</label>
              <div class="col-sm-10"> 
                <div class="form-group bmd-form-group"> 
                  <select class="form-control" id="ZoomMeetingPerson" name="ZoomMeetingPerson[]" multiple="true">
                    <?php 
                    $email = $this->Common_model->GetUsersEmail();
                    foreach ($email as $key => $value) {
                      echo '<option value="'.$value->Email.'">'.$value->Email.'</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Subject</label>
              <div class="col-sm-10"> 
                <div class="form-group bmd-form-group"> 
                  <input type="text" name="ZoonInviteSubject" id="ZoonInviteSubject" class="form-control">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Description </label>
              <div class="col-sm-10">
                <div class="form-group bmd-form-group">
                  <textarea class="form-control" id="ZoomInvitationtxt" name="ZoomInvitation" rows="3"></textarea>
                </div>
              </div>
            </div>   
          </div> 
        </div>
        <div class="modal-footer">
          <div class="form-group text-right">
            <button type="submit" id="sendMeetingInvitation-btn" class="btn btn-info ZoomMeet-btn"><i class="material-icons">send</i> &nbsp; Send</button>
            <button type="reset" class="btn btn-danger ZoomMeet-btn" data-dismiss="modal"><i class="material-icons">close</i> Cancel</button>
          </div> 
        </div>
      </form>
    </div>
  </div>
</div>

<!-- <div class="modal fade" id="InstantLoginModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-notice">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Login Required</h4><button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
      </div>
      <form id="InstantLoginForm" style="margin: 0;"> 
      <div class="modal-body">
         
      </div>
      <div class="modal-footer"> 
      </div>
      </form>
    </div>
  </div>
</div> -->

<style type="text/css">
.select2-container .select2-search--inline .select2-search__field {
  width: 100% !important;
}
.select2-container--bootstrap .select2-results__option[aria-selected=true] {
  background-color: #dcdcdc;
  color: #333;
}
</style>
<script type="text/javascript">
  $(document).ready(function(){
    $('.usernotificationlist-menu').perfectScrollbar();

    $("body").on("click" , ".nav-mobile-menu .EmailSend" , function(){
      $(".toggled").trigger("click");

    });




  });


  var BASE_URL = "<?php echo base_url()?>"; 
  $("#ZoomMeetingPerson").select2({
    multiple: true,  
    width: "100%",
    placeholder: "Select meeting person", 
    theme: "bootstrap",
    dropdownAdapter: $.fn.select2.amd.require('select2/selectAllAdapter')
  });

  $('body').on('click','.openZoom', function()
  { 
    $('#ScheduleZoomModal').modal({show: true, backdrop: 'static', keyboard: false}); 
    $('#ScheduleZoomModal').on('shown.bs.modal', function(){
      $('#ScheduleZoomModal #ZoomMeetingTopic').val('My Meeting').focus();
    });
  });

  $('.SchduleZoomdatepicker').datetimepicker({
    format:"MM/DD/YYYY",
    minDate: moment(new Date()).format('MM/DD/YYYY'),
    icons: {
      date: "fa fa-calendar", 
      previous: "fa fa-chevron-left", 
      next: "fa fa-chevron-right"
    }
  });
  
  $('.ScheduleZoomtimepicker').datetimepicker({
    format:"h:mm A",
    icons: {
      time: "fa fa-clock-o", 
      up: "fa fa-chevron-up", 
      down: "fa fa-chevron-down"
    }
  });

  $(document).on('keypress','.ScheduleZoomtimepicker',function(event){ event.preventDefault(); }); 

  $('#ZoomMeetingStartDate').on('dp.change', function(e)
  { 
     $('#ZoomMeetingEndDate').val($('#ZoomMeetingStartDate').val());
     $('#ZoomMeetingEndDate').data("DateTimePicker").minDate($('#ZoomMeetingStartDate').val()); 
  });

  $('#ZoomMeetingEndDate').on('dp.change', function(e)
  { 
    $('#ZoomMeetingStartDate').data("DateTimePicker").maxDate($('#ZoomMeetingEndDate').val()); 
  });

  $('.SchduleZoomdatepicker').on('dp.change', function(e){   
    $(this).parent('.bmd-form-group').addClass('is-filled');  
  });

  $('.ScheduleZoomtimepicker').blur(function(){    
    $(this).parent('.bmd-form-group').addClass('is-filled');  
  });

  $('.ZoomRadio').change(function()
  {
    var id = $(this).attr('id');
    if($(this).prop('checked')==true)
    {
      $('span#'+id).text('On');
    } else { 
      $('span#'+id).text('Off');
    }
  });

  $('#ScheduleZoomModal #ZoomPasswordRequired').click(function(){ 
    if($(this).prop('checked')==true)
    {
      $('#ScheduleZoomModal #ZoomMeetingPassword').css('display','block');
    } else { 
      $('#ScheduleZoomModal #ZoomMeetingPassword').val(null);
      $('#ScheduleZoomModal #ZoomMeetingPassword').css('display','none');
    }
  });

  $('#ScheduleZoomModal').on('hide.bs.modal', function(){
    $('#ScheduleZoomMeetingForm').trigger('reset');
    $('#ScheduleZoomModal #ZoomMeetingPassword').css('display','none');
    $("#ZoomMeetingPerson").val(null).trigger("change"); 
  });

  $('#ScheduleZoomMeetingForm').on('submit',function(e)
  {
    $('#AjaxPageLoader').addClass('loader-active');
    var datas = new FormData($(this)[0]);      

    if($('#ScheduleZoomModal #ZoomMeetingPassword').css('display') == 'block')
    {
      if($('#ScheduleZoomModal #ZoomMeetingPassword').val() == '')
      {
        $('#AjaxPageLoader').removeClass('loader-active');
        $.notify('Meeting password required',{
         type:'danger', 
         delay:500
       });
        return false;        
      }
    }
    
    if($('#ScheduleZoomModal #ZoomMeetingTopic').val() == '' || $('#ScheduleZoomModal #ZoomMeetingStartDate').val() == '')
    {
      $('#AjaxPageLoader').removeClass('loader-active');
      var msg = 'Please fill meeting persons & meeting topic';
      $.notify(msg,{
        type:'danger', 
        delay:500
      });
    } else {
      $.ajax({
        url: BASE_URL+'CICalendar/ScheduleMeeting/',
        type: 'POST',
        dataType: 'JSON',
        data: datas,
        contentType: false, 
        processData: false,
        beforeSend: function(){
          $('#AjaxPageLoader').addClass('loader-active');
          $('.ZoomMeet-btn').attr('disabled',true);
          $('#ScheduleMeeting-btn').html('<i class="material-icons">query_builder</i> &nbsp; Processing...');
        },
        success: function(data)
        { 
          $('.ZoomMeet-btn').attr('disabled',false); 
          $('#ScheduleMeeting-btn').html('<i class="material-icons">calendar_today</i> &nbsp; Schedule Meeting');
          if(data.error==0)
          {
            $('#ScheduleZoomModal').modal('hide'); 

            $('#SendZoomInvitationModal').modal({backdrop: 'static', keyboard: false}); 
            $('#SendZoomInvitationModal').on('shown.bs.modal', function(){
             $('#ZoonInviteSubject').val(data.subject);
             $('#ZoomInvitationtxt').val(data.message);
             designTinymc();
           });
            SendInvitationLink();   
            
            var currentUrl = window.location.pathname; 
            lastHash = currentUrl.substr(currentUrl.lastIndexOf('/') + 1); 
            if(lastHash == 'CICalendar')
            {
              $('#ZoomMeetingCalendar').fullCalendar('refetchEvents');
            }

          } else {
            $.notify(data.message,{
             type: data.type, 
             delay:500
           });
          }
          $('#AjaxPageLoader').removeClass('loader-active');
        }
      });
    }
    e.preventDefault();
    return false;
  });

  function SendInvitationLink()
  {
   $('#SendZoomMeetinglink').on('submit',function(e)
   {
    $('#AjaxPageLoader').addClass('loader-active');
    var datas = new FormData($(this)[0]);      

    if($('#ZoomMeetingPerson').val() == '' || $('#ZoonInviteSubject').val() == '' || $('#ZoomInvitationtxt').val() == '')
    {
      var msg = 'Please fill invite persons & meeting link';
      $.notify(msg,{
        type:'danger', 
        delay:500
      });
      $('#AjaxPageLoader').removeClass('loader-active');
    } else {
      $.ajax({
        url: BASE_URL+'CICalendar/SendZoomInvitation/',
        type: 'POST',
        dataType: 'JSON',
        data: datas, 
        contentType: false,
        processData: false,
        beforeSend: function(){
          $('.ZoomMeet-btn').attr('disabled',true);
          $('#sendMeetingInvitation-btn').html('<i class="material-icons">query_builder</i> &nbsp; Sending...');
        },
        success: function(data)
        { 
          $('.ZoomMeet-btn').attr('disabled',false);
          $('#sendMeetingInvitation-btn').html('<i class="material-icons">send</i> &nbsp; Send');
          if(data.error==0)
          {
            $('#ScheduleZoomModal').modal('hide');  
            $('#SendZoomInvitationModal').modal('hide'); 
            $('#SendZoomInvitationModal').on('hide.bs.modal', function(){
             $('#ZoomMeetingPerson').val('').trigger('change');
             $('#ZoomInvitationtxt').val('');   
             designTinymc();        
           });   
          }
          $.notify(data.message,{
            type: data.type, 
            delay:500
          });
          $('#AjaxPageLoader').removeClass('loader-active');
        }
      });
    }
    e.stopImmediatePropagation();
    e.preventDefault();
    return false;
  });
 }

 function designTinymc()
 {
  tinymce.init({
   selector: '#ZoomInvitationtxt', 
   cache_suffix: '?v=4.1.6',
   plugins : 'autolink link', 
   height : '250',
   menubar: false,
   relative_urls: false,
   link_assume_external_targets: true,
 });
} 
</script> 
<?php } ?>

<div class="ibs-full-modal-container" id="documentlistmodal">
  <div class="ibs-full-modal">
    <header class="ibs-modal-header">
      <h4 class="ibs-modal-title">KYC Data Master Document</h4>
      <span class="ibs-btn-close">&times;</span>
    </header>
    <div class="ibs-modal-body has-header has-footer">
      <div id="ss_menu">
        <div class="doc" id="d1">
          <a><img src="<?php echo base_url();?>assets/img/documenticons/1.png" class="img-responsive"></a>
          <p>Certificate Of <br> Incorporation</p>
        </div>       
        <div class="doc" id="d2">
         <a> <img src="<?php echo base_url();?>assets/img/documenticons/2.png" class="img-responsive"></a>
         <p>Memorandum <br> /article <br> of association</p>
       </div>
       <div class="doc" id="d3"> 
         <a><img src="<?php echo base_url();?>assets/img/documenticons/3.png" class="img-responsive"></a>
         <p>PAN Card</p>
       </div>
       <div class="doc" id="d4">
         <a> <img src="<?php echo base_url();?>assets/img/documenticons/4.png" class="img-responsive"></a>
         <p>TAN</p>
       </div>
       <div class="doc" id="d5">
        <a> <img src="<?php echo base_url();?>assets/img/documenticons/5.png" class="img-responsive"></a>
        <p>GST</p>
      </div>
      <div class="doc" id="d6">
        <a>  <img src="<?php echo base_url();?>assets/img/documenticons/6.png" class="img-responsive"></a>
        <p>LUT Registration</p>
      </div>
      <div class="doc" id="d7">
        <a> <img src="<?php echo base_url();?>assets/img/documenticons/7.png" class="img-responsive"></a>
        <p>Professional Tax <br> Registration Certificate</p>
      </div>
      <div class="doc" id="d8">
       <a><img src="<?php echo base_url();?>assets/img/documenticons/8.png" class="img-responsive"></a>
       <p>Shop and Establishment <br> Registration Certificate</p>
     </div>
     <div class="doc" id="d9"> 
       <a> <img src="<?php echo base_url();?>assets/img/documenticons/9.png" class="img-responsive"></a>
       <p>Provident Fund <br> Registration <br> Certificate</p>
     </div>
     <div class="doc" id="d10">
       <a> <img src="<?php echo base_url();?>assets/img/documenticons/10.png" class="img-responsive"></a>
       <p>ESI</p>
     </div>
     <div class="doc" id="d11">
       <a> <img src="<?php echo base_url();?>assets/img/documenticons/11.png" class="img-responsive"></a>
       <p>IEC Code <br> Registration</p>
     </div>
     <div class="doc" id="d12">
      <a> <img src="<?php echo base_url();?>assets/img/documenticons/12.png" class="img-responsive"></a>
      <p>STPI <br> Registration</p>
    </div>


    <div class="menu" style="display:none;">
      <div class="share" id="ss_toggle" data-rot="180">    
        <div class="bar"></div>
      </div>
    </div>
  </div>

  <div class="contentdescription" style="display: none">
    <div class="contentlist"  style="display: none">
      <div class="row">
        <div class="col-md-3">
          <div class="docimgdiv">
           <a><img src="" class="img-responsive docimg" ></a>
         </div>
       </div>
       <div class="col-md-9">
        <h4 class="whitetxt doctitle">Certification of Incorporation</h4>
        <p class="doccreated">2018-11-14 10:42:13</p>
        <p>Documents : <span class="noofdoc">2</span> </p>
        <a href="" class="LinkForDocument" style="background: transparent;">
          <button class="btn btn-behance btm-sm ViewFetchDocID" id=""> 
            View Details
          </button>
        </a>
        <button class="btn btn-default btm-sm canceldocumentdes">
          Cancel
        </button>
      </div>
    </div>
  </div>
</div>
</div>
<div class="ibs-modal-footer text-right">
    <!--   <button class="btn btn-default" id="closeBtn">Cancel</button>
      <button class="btn btn-success">Confirm</button> -->
    </div>
  </div>
</div>

<script type="text/javascript">

  $('.ibs-full-modal-container').fullModal({
    closeWhenClickBackdrop: true,
    duration: 500,
    beforeOpen: function (callback) {
      callback();
    },
    afterOpen: function () {
      console.log('afterOpen was invoked');
    },
    beforeClose: function (callback) {
      setTimeout(function(){
        callback();
      },2000);

    },
    afterClose: function () {
      console.log('afterClose was invoke');
    }
  });


$("body").on("click" , "#documentmodal" , function(){
  $(".toggled").trigger("click"); 
    $('#documentlistmodal').fullModal('open');
  });


  $("#ss_menu .doc").click(function(){
    var dnum  =  $(this).attr("id");   
    $(".contentdescription").show();
    var documentjson  = [
    {"id" : "d1" , "imgsrc" : "<?php echo  base_url();?>assets/img/documenticons/1.png" , "title" : "Certificate Of Incorporation" , "DateOfCreation" : "2018-11-14 10:42:13" , "NoOfDocuments" : "3" ,"colorcode" : "#9368E9"},
    {"id" : "d2" , "imgsrc" : "<?php echo  base_url();?>assets/img/documenticons/2.png" , "title" : "Memorandum/article of association" , "DateOfCreation" : "2018-11-14 10:42:13" , "NoOfDocuments" : "2","colorcode" : "#2CA8FF"},
    {"id" : "d3" , "imgsrc" :  "<?php echo  base_url();?>assets/img/documenticons/3.png" , "title" : "PAN Card" , "DateOfCreation" : "2018-11-14 10:42:13" , "NoOfDocuments" : "1","colorcode" : "#18ce0f"},
    {"id" : "d4" , "imgsrc" : "<?php echo  base_url();?>assets/img/documenticons/4.png" , "title" : "TAN" , "DateOfCreation" : "2018-11-14 10:42:13" , "NoOfDocuments" : "5","colorcode" : "#ff9800"},
    {"id" : "d5" , "imgsrc" :"<?php echo  base_url();?>assets/img/documenticons/5.png"  , "title" : "GST" , "DateOfCreation" : "2018-11-14 10:42:13" , "NoOfDocuments" : "1","colorcode" : "#f44336"},
    {"id" : "d6" , "imgsrc" : "<?php echo  base_url();?>assets/img/documenticons/6.png"  , "title" : "LUT Registration" , "DateOfCreation" : "2018-11-14 10:42:13" , "NoOfDocuments" : "8","colorcode" : "#e91e63"},
    {"id" : "d7" , "imgsrc" : "<?php echo  base_url();?>assets/img/documenticons/7.png"  , "title" : "Professional Tax Registration Certificate" , "DateOfCreation" : "2018-11-14 10:42:13" , "NoOfDocuments" : "1","colorcode" : "#e91e63"},
    {"id" : "d8" , "imgsrc" :  "<?php echo  base_url();?>assets/img/documenticons/8.png"  , "title" : "Shop and Establishment Registration Certificate" , "DateOfCreation" : "2018-11-14 10:42:13" , "NoOfDocuments" : "6","colorcode" : "#f44336"},
    {"id" : "d9" , "imgsrc" : "<?php echo  base_url();?>assets/img/documenticons/9.png" , "title" : "Provident Fund Registration Certificate" , "DateOfCreation" : "2018-11-14 10:42:13" , "NoOfDocuments" : "9","colorcode" : "#ff9800"},
    {"id" : "d10" , "imgsrc" :"<?php echo  base_url();?>assets/img/documenticons/10.png" , "title" : "ESI" , "DateOfCreation" : "2018-11-14 10:42:13" , "NoOfDocuments" : "2","colorcode" : "#18ce0f"},
    {"id" : "d11" , "imgsrc" : "<?php echo  base_url();?>assets/img/documenticons/11.png"  , "title" : "IEC Code Registration" , "DateOfCreation" : "2018-11-14 10:42:13" , "NoOfDocuments" : "7","colorcode" : "#2CA8FF"},
    {"id" : "d12" , "imgsrc" : "<?php echo  base_url();?>assets/img/documenticons/12.png" , "title" : "STPI Registration" , "DateOfCreation" : "2018-11-14 10:42:13" , "NoOfDocuments" : "6","colorcode" : "#9368e9"}
    ];

    $.each(documentjson , function(m,n){
      if(n.id == dnum){
        $(".docimgdiv").css("background", n.colorcode);
        var srcv = n.imgsrc; 
        $(".docimg").attr("src" , srcv);
        $(".doctitle").text(n.title);
        $(".doccreated").text(n.DateOfCreation);
        $(".noofdoc").text(n.NoOfDocuments);
      }
    });

    $.ajax({
      url: "<?php echo base_url('Email_Info/CountAjaxDocument')?>",
      type: "POST",
      dataType: "json",
      data: {"DocNum": dnum},
      success: function(data) 
      {
        $(".ViewFetchDocID").attr('id',dnum);
        $(".LinkForDocument").attr('href','<?php echo base_url('Document/index/'); ?>'+dnum);
        if(data.length!=0)
        {
          console.log(data);
          $('.doccreated').html(data.CreatedDate);
          $(".noofdoc").html(data.count_docid);
        }
        else
        {
          $('.doccreated').html('None');
          $(".noofdoc").html('0');
        }
      }
    });

    $(".contentdescription").show();
    $(".contentlist").addClass("animatediv");
    $(".contentlist").show();
    $("#ss_menu").hide();  
  });




  $(".canceldocumentdes").click(function(){
    // $("#ss_menu").addClass("animatediv");
    $("#ss_menu").show();     
    $(".contentlist").hide();
    $(".contentdescription").hide();
  });

</script> 

<?php if(hasPermission('ChatRoom')>0) { ?>
  <link rel='stylesheet' href='<?php echo base_url('assets/chat/docket/chat.css');?>'>
  <link rel='stylesheet' href='<?php echo base_url('assets/chat/docket/jquery.fileuploader.css');?>'>
  <link rel='stylesheet' href='<?php echo base_url('assets/chat/docket/jquery.fileuploader-theme-dragdrop.css');?>'>

  <link rel="stylesheet" href="<?php echo base_url('assets/chat/viewer/magnific-popup.css');?>"/>
  <script type="text/javascript" src="<?php echo base_url('assets/chat/viewer/jquery.magnific-popup.js');?>"></script> 
  <script type="text/javascript" src="<?php echo base_url('assets/chat/readmore.js');?>"></script> 

  <div class="docketchat-emoji wdt-emoji-popup">
    <a href="#" class="wdt-emoji-popup-mobile-closer"> &times; </a>
    <div class="wdt-emoji-menu-content">
      <div id="wdt-emoji-menu-header">
        <a class="wdt-emoji-tab active" data-group-name="Recent"></a>
        <a class="wdt-emoji-tab" data-group-name="People"></a>
        <a class="wdt-emoji-tab" data-group-name="Nature"></a>
        <a class="wdt-emoji-tab" data-group-name="Foods"></a>
        <a class="wdt-emoji-tab" data-group-name="Activity"></a>
        <a class="wdt-emoji-tab" data-group-name="Places"></a>
        <a class="wdt-emoji-tab" data-group-name="Objects"></a>
        <a class="wdt-emoji-tab" data-group-name="Symbols"></a>
        <a class="wdt-emoji-tab" data-group-name="Flags"></a> 
      </div>
      <div class="wdt-emoji-scroll-wrapper">
        <div id="wdt-emoji-menu-items">
          <input id="wdt-emoji-search" type="text" placeholder="Search">
          <h3 id="wdt-emoji-search-result-title">Search Results</h3>
          <div class="wdt-emoji-sections"></div>
          <div id="wdt-emoji-no-result">No emoji found</div>
        </div>
      </div>
      <div id="wdt-emoji-footer">
        <div id="wdt-emoji-preview">
          <span id="wdt-emoji-preview-img"></span>
          <div id="wdt-emoji-preview-text">
            <span id="wdt-emoji-preview-name"></span><br>
            <span id="wdt-emoji-preview-aliases"></span>
          </div>
        </div>
        <div id="wdt-emoji-preview-bundle">
          <span>Emoji Bundle</span> 
        </div>
      </div>
    </div>
  </div>

  <?php 
  echo modules::run('ChatRoom/DocketChat'); 
}
?>
</div>
</div>

</body>
</html> 

<?php if(hasPermission('ChatRoom')>0) { ?>
  <script>
    var BASE_URL = "<?php echo base_url()?>"; 

    function ChatImageviewer()
    {
      $('.chat-msg-popup').magnificPopup({ 
        type: 'image',
        closeOnContentClick: false,
        closeBtnInside: false,
        mainClass: 'mfp-with-zoom mfp-img-mobile',
        image: {
          verticalFit: true,
          titleSrc: function(item) {
            return item.el.attr('title');
          }
        },
        gallery: {
          enabled: true
        },
        zoom: {
          enabled: true,
        duration: 300, // don't foget to change the duration also in CSS
        opener: function(element) {
          return element.find('img');
        }
      }
    });
    }
  </script>
  <script src="<?php echo base_url('assets/chat/docket/jquery.fileuploader.min.js')?>"></script>
  <script src="<?php echo base_url('assets/chat/push_notification.js')?>"></script>
  <script src="<?php echo base_url('assets/chat/docket/docket-chat.js')?>"></script>
<?php } ?>
