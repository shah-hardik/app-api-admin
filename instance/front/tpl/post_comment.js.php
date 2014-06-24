<script type="text/javascript">
    var delUrl = '';
    function DeletePostComment(url){
        delUrl = url;
        $("#myModal").modal("show");
    }
      $(document).ready(function() {
        $('#checkAll').click(function(event) {  //on click
            if (this.checked) { // check select status
                $('.delete').each(function() { //loop through each checkbox
                    this.checked = true;  //select all checkboxes with class "checkbox1"              
                });
            } else {
                $('.delete').each(function() { //loop through each checkbox
                    this.checked = false; //deselect all checkboxes with class "checkbox1"                      
                });
            }
        });

        $('.checkAllSubmit').click(function(event) {

            $("#deleteModal").modal("show");




        });
    });
</script>
<?php include "commonpagging.php"; ?>