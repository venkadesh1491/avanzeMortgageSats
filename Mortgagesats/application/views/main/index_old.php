<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- Image loader -->
 <div class="loading">Loading&#8230;</div>
<style type="text/css">
  /* Absolute Center Spinner */
.loading {
  position: fixed;
  z-index: 999;
  height: 2em;
  width: 2em;
  overflow: visible;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

/* Transparent Overlay */
.loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.3);
}

/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.loading:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
  -webkit-animation: spinner 1500ms infinite linear;
  -moz-animation: spinner 1500ms infinite linear;
  -ms-animation: spinner 1500ms infinite linear;
  -o-animation: spinner 1500ms infinite linear;
  animation: spinner 1500ms infinite linear;
  border-radius: 0.5em;
  -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
  box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}

.table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
    padding: 0px 10px!important;
    min-width: 100px;
}

table.dataTable thead .sorting:after, table.dataTable thead .sorting_asc:after, table.dataTable thead .sorting_asc_disabled:after, table.dataTable thead .sorting_desc:after, table.dataTable thead .sorting_desc_disabled:after {
     bottom: 0px; 
    right: .5em;
    content: "\2193";
}

table.dataTable thead .sorting:before, table.dataTable thead .sorting_asc:before, table.dataTable thead .sorting_asc_disabled:before, table.dataTable thead .sorting_desc:before, table.dataTable thead .sorting_desc_disabled:before {
     bottom: 0px; 
    right: 0em;
    content: "\2191";
}


nav > .nav.nav-tabs{

  border: none;
    color:#fff;
    background:#272e38;
    border-radius:0;

}
nav > div a.nav-item.nav-link,
nav > div a.nav-item.nav-link.active
{
  border: none;
    padding: 10px 10px;
    color:#fff;
    
    border-radius:0;
}
nav > div a.nav-item.nav-link,
{
  background:#272e38;
}
nav > div a.nav-item.nav-link.active
{
  background: #e74c3c;
}

nav > div a.nav-item.nav-link.active:after
 {
  content: "";
  position: relative;
  bottom: -60px;
  left: -10%;
  border: 15px solid transparent;
  border-top-color: #e74c3c ;
}
.tab-content{
  background: #fdfdfd;
    line-height: 25px;
    border: 1px solid #ddd;
    border-top:5px solid #e74c3c;
    border-bottom:5px solid #e74c3c;
    padding:30px 25px;
}

nav > div a.nav-item.nav-link:hover,
nav > div a.nav-item.nav-link:focus
{
  border: none;
    background: #e74c3c;
    color:#fff;
    border-radius:0;
    transition:background 0.20s linear;
}
.nav-tabs{
  padding: 0px;
}
</style>
 
<!-- Image loader -->

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
   <!-- <div class="container"> -->
             <div class="row" id="loadcontent" style="background: #fff;">
                <div class="col-md-12 ">
                  <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-index-tab" data-toggle="tab" href="#nav-index" role="tab" aria-controls="nav-index" aria-selected="false">New Orders</a>
                      <a class="nav-item nav-link " id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="false">In-complete Orders</a>
                      <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Completed Orders</a>
                     
                    </div>
                  </nav>
                  <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-index" role="tabpanel" aria-labelledby="nav-index-tab">
                     <div class="table-responsive">
                      <table id="NewOrderTable" class="table table-bordered table-striped"  style="width: 100%">
                        <thead>
                          <th>Sl No</th>
                          <th>Order Number</th>
                          <th>OrderUID</th>
                          <th>Loan Number</th>
                        </thead>
                        <tbody>
                          
                            
                        </tbody>
                      </table>
                     </div>
                    </div>
                    <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                     <div class="table-responsive">

                      <table id="OrderTable" class="table table-bordered table-striped" style="width: 100%">
                        <thead>
                          <th>Sl No</th>
                          <th>Order Number</th>
                          <th>OrderUID</th>
                          <th>Loan Number</th>
                          <th>Total Pages</th>
                        </thead>
                        <tbody>
                          
                            
                        </tbody>
                      </table>

                     </div>
                    
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                      <div class="table-responsive">

                      <table id="CompletedOrderTable" class="table table-bordered table-striped" style="width: 100%">
                        <thead>
                          <th>Sl No</th>
                          <th>Order Number</th>
                          <th>OrderUID</th>
                          <th>Loan Number</th>
                          <th>Action</th>
                        </thead>
                        <tbody>
                          
                            
                        </tbody>
                      </table>

                     </div>
                    </div>
                   
                  </div>
                
                </div>
              </div>
        <!-- </div> -->
      </div>
</div>

<div class="row" id="loadcontent" style="background: #fff;">
 

</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('#NewOrderTable').DataTable({
        // Processing indicator
        "processing": true,
        // DataTables server-side processing mode
        "serverSide": true,
        // Initial no order.
        "order": [],
        // Load data from an Ajax source
        "ajax": {
            "url": "<?php echo base_url('main/getOrderList/'); ?>",
            "type": "POST"
        },
        //Set column definition initialisation properties
        "columnDefs": [{ 
            "targets": [0],
            "orderable": false
        }]
    });
});
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#OrderTable').DataTable({
        // Processing indicator
        "processing": true,
        // DataTables server-side processing mode
        "serverSide": true,
        // Initial no order.
        "order": [],
        // Load data from an Ajax source
        "ajax": {
            "url": "<?php echo base_url('main/getLists/'); ?>",
            "type": "POST"
        },
        //Set column definition initialisation properties
        "columnDefs": [{ 
            "targets": [0],
            "orderable": false
        }]
    });
});
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#CompletedOrderTable').DataTable({
        // Processing indicator
        "processing": true,
        // DataTables server-side processing mode
        "serverSide": true,
        // Initial no order.
        "order": [],
        // Load data from an Ajax source
        "ajax": {
            "url": "<?php echo base_url('main/getCompletedLists/'); ?>",
            "type": "POST"
        },
        //Set column definition initialisation properties
        "columnDefs": [{ 
            "targets": [0],
            "orderable": false
        }]
    });
});
</script>



<script type="text/javascript">
   $(".loading").hide();
  function send(OrderUID){
     $(".loading").show();
    $.ajax({
    type: 'POST',
    url: '<?php echo base_url()?>ocr/sendData',
    data: {'OrderUID': OrderUID},
    dataType:'json',
    success:function(resp){
        console.log("OCR Completed");
        console.log(resp)
        if (resp) {
           if (resp.data) { 
            //$(".loading").hide();
            setInterval(function(){
              toastr.success("OCR Completed");
              window.location.href="<?php echo base_url();?>main/list/"+resp.orderNo+"/"+resp.orderUID+"/"+resp.pdf;
            },7000);
           }else{
            $(".loading").hide();
            toastr.error("Failed to run OCR");
           }
        }else{
          $(".loading").hide();
          toastr.error("No data found for this order");
        }
    },
    error:function(error,errorThrown){
      console.log(error)
    }
  });

  }
</script>


<script type="text/javascript">
  
  function reRunOCR(OrderUID){
    if (confirm('Do you want to run OCR?')) {

      $.ajax({
        type: 'POST',
        url: '<?php echo base_url()?>main/updateTOrders',
        data: {'OrderUID': OrderUID},
        dataType:'json',
        success:function(data){
            
            if (data.validation_error==0) {
             send(OrderUID);
            }else{
              toastr.error('Failed to Run OCR');
            }
        },
        error:function(error,errorThrown){
          console.log(error)
        }
      });
          
    } else {
        toastr.error('Failed to Run OCR');
    }
  }
</script>