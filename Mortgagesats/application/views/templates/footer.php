</div>

</div>
</div>
</div>
</div>

<script type="text/javascript">
          $(document).ready(function() {
      $(".select2picker").select2({
      theme: "bootstrap",

      });
      
    });
</script>
<script type="text/javascript">

  $('#docType').on('select2:select', function (e) {
 
        $(".main_select").addClass('is-filled');
});
        $('#btnpricingimport').off('click').on('click', function (e) {
        $('#pricingimport').slideToggle('slow');
      });
         
      /* --- Dropify initialization starts */

    $('.dropify').dropify();

                // Used events
                var drEvent = $('.dropify').dropify();

                drEvent.on('dropify.beforeClear', function(event, element){
                  // return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
                });

                drEvent.on('dropify.afterClear', function(event, element){
                  // alert('File deleted');
                });

                drEvent.on('dropify.errors', function(event, element){
                  console.log('Has Errors');
                });

                var drDestroy = $('#input-file-to-destroy').dropify();
                drDestroy = drDestroy.data('dropify')
                $('#toggleDropify').on('click', function(e){
                  e.preventDefault();
                  if (drDestroy.isDropified()) {
                    drDestroy.destroy();
                  } else {
                    drDestroy.init();
                  }
                });


      /* --- Dropify initialization ends */

      function bs_input_file() {
  $(".input-file").before(
    function() {
      if ( ! $(this).prev().hasClass('input-ghost') ) {
        var element = $("<input type='file' name='file' id='file' class='input-ghost' style='visibility:hidden; height:0'>");
        element.attr("name",$(this).attr("name"));
        element.change(function(){
          element.next(element).find('input').val((element.val()).split('\\').pop());
        });
        $(this).find("button.btn-choose").click(function(){
          element.click();
        });
        $(this).find("button.btn-reset").click(function(){
          element.val(null);
          $(this).parents(".input-file").find('input').val('');
        });
        $(this).find('input').css("cursor","pointer");
        $(this).find('input').mousedown(function() {
          $(this).parents('.input-file').prev().click();
          return false;
        });
        return element;
      }
    }
  );
}
$(function() {
  bs_input_file();
});
</script>
</body>
</html>