
<style type="text/css">
  .pd-btm-0{
   padding-bottom: 0px;
 }

 .margin-minus8{
   margin: -8px;
 }

 .mt--15{
   margin-top: -15px;
 }

 .bulk-notes
 {
   list-style-type: none
 }
 .bulk-notes li:before
 {
   content: "*  ";
   color: red;
   font-size: 15px;
 }

 .nowrap{
   white-space: nowrap
 }

 .table-format > thead > tr > th{
   font-size: 12px;
 }

 #product_accordion .card-header a,
 #product_accordion .card-header a:hover
 {
    color:#696969!important;
 }

  .thumbnail .close {
    position: absolute;
    top: 2px;
    right: 2px;
    z-index: 100;
    background-color:#fff ;
    color:red;
}
</style>

<div class="card mt-40" id="Orderentrycard">
	<div class="card-header card-header-danger card-header-icon">
		<div class="card-icon">Add Order
		</div>
	</div>
	<div class="card-body">
	<form action="" method="post" enctype="multipart/form-data" id="form_content">
       <div class="row"> 

          <div class="col-md-12 ml-auto mr-auto">

            <!--<div class="row">
              <label class="col-md-3 col-form-label" for="OrderNumber">Order Number</label><span class="mandatory"></span>
              <div class="col-md-4">
                <div class="form-group has-default">
                  <input type="text" class="form-control" id="OrderNumber" name="OrderNumber"/>
                </div>
              </div>
            </div>-->
          
            <div class="row">
              <label class="col-md-1 col-form-label" for="LoanNumber">Loan Number</label><span class="mandatory"></span>
              <div class="col-md-2">
                <div class="form-group has-default">
                  <input type="text" class="form-control" id="LoanNumber" name="LoanNumber"/>
                </div>
              </div>
            
              <label class="col-md-1 col-form-label" for="PropertyAddress1">Address</label>
              <div class="col-md-2">
                <div class="form-group has-default">
                  <input type="text" class="form-control" id="PropertyAddress1" name="PropertyAddress1"/>
                </div>
              </div>
           
              <label class="col-md-1 col-form-label" for="PropertyZipCode">ZipCode</label>
              <div class="col-md-2">
                <div class="form-group has-default">
                  <input type="text" class="form-control" id="PropertyZipCode" name="PropertyZipCode"/>
                </div>
              </div>
            </div></div>
            </div>
            <div class="row">
            <div class="col-md-12 ml-auto mr-auto">
            <div class="row">
              <label class="col-md-1 col-form-label" for="PropertyCityName">City</label>
              <div class="col-md-2">
                <div class="form-group has-default">
                  <input type="text" class="form-control" id="PropertyCityName" name="PropertyCityName"/>
                </div>
              </div>
           
              <label class="col-md-1 col-form-label" for="PropertyStateCode">State Code</label>
              <div class="col-md-2">
                <div class="form-group has-default">
                  <input type="text" class="form-control" id="PropertyStateCode" name="PropertyStateCode"/>
                </div>
              </div>
            
              <label class="col-md-1 col-form-label" for="PropertyCountyName">Country</label>
              <div class="col-md-2">
                <div class="form-group has-default">
                  <input type="text" class="form-control" id="PropertyCountyName" name="PropertyCountyName"/>
                </div>
              </div>
            </div> 
            </div> 
            <div class="row">
              <div class="col-md-12 ml-auto mr-auto">
                <div class="row">
                  <label class="col-md-3 col-form-label" for="DocumentURL">PDF Upload</label><span class="mandatory"></span>
                    <div class="col-md-8">
                      <input type="file" class="form-control" id="DocumentURL"  name="DocumentURL"  placeholder='Select PDF File' required="true" />     
                    </div>
                </div>
              </div>

             <div class="row">
                <div class="col-md-12 ml-auto mr-auto">
                 
             <div class="col-xs-12 col-sm-12 col-md-12">
       <input type="button" value="Save" id="save" class="btn btn-info btn-block">
           
           
            </div>
            </div>
            </div>



</form>

</div>
</div>

<script type="text/javascript">

/*$("#PropertyZipCode").alpaca({
    "data": $("#PropertyZipCode").val(),
    "options": {
        "type": "zipcode",
        "format": "five",
        "label": "Zip Code"
    },
    "view": "bootstrap-display"
});*/
//$(document).on('click', '#save', function(){
  $(document).off('click','#save').on('click','#save', function(e) {
  var formData = new FormData();
    //formData.append('OrderNumber', $("#OrderNumber").val());
    formData.append('LoanNumber', $("#LoanNumber").val());
    formData.append('PropertyAddress1', $("#PropertyAddress1").val());
    formData.append('PropertyZipCode', $("#PropertyZipCode").val());
    formData.append('PropertyCityName', $("#PropertyCityName").val());
    formData.append('PropertyStateCode',  $("#PropertyStateCode").val());
    formData.append('PropertyCountyName', $('#PropertyCountyName').val());

       if( $('#DocumentURL')[0].files[0] !== undefined ){
            formData.append('DocumentURL', $('#DocumentURL')[0].files[0], $('#DocumentURL')[0].files[0].name);
       }
      // $('#save').prop('disabled', true);
     $.ajax({
        type        : "POST",
        dataType    : "json",
        url         : '<?php echo base_url();?>main/SaveOrder',
        cache       : false,
        contentType : false,
        processData : false,
        data        : formData,
        beforeSend:function(){
          $('#contact').attr('disabled', 'disabled');
        },
        success: function (response) {
        if(response.Status == 0)
        {
         // $('#save').prop('disabled', false);
           $.notify(
          {
            icon:"icon-bell-check",
            message:response.message
          },
          {
            type:"success",
            delay:1000 
          }); 
          setTimeout(function(){ 
            window.location.reload();

          }, 3000);
        }   
        else
        {
         // $('#save').prop('disabled', false);
          $.notify(
          {
            icon:"icon-bell-check",
            message:response.message
          },
          {
            type:"danger",
            delay:1000 
          });

           $.each(response, function(k, v) {
            console.log(k);
            $('#'+k).addClass("is-invalid").closest('.form-group').removeClass('has-success').addClass('has-danger');
   
          });
        }
      }
    })
    .done(function(json) {
      console.log(json);
    });
})
 
</script>






