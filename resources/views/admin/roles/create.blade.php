<?php $required_span = '<span class="text-red">*</span>';?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Add Menu</h4>  
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div id="return_data"></div>
                <!-- form start -->
                <form class="form-horizontal" method="POST" id="add_role" name="add_role">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                        <label for="Title">Menu Name:<?=$required_span; ?></label>
                        <input type="text" class="form-control required" id="Title" placeholder="Title" name="Title">    
                    </div>
                    <button type="submit" class="btn btn-default btn-success" name="submit"> Submit</button>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    
    $('#add_role').validate({
        submitHandler(form){
            let form_data = new FormData(form);
        
            $.ajax({
                type: "POST",
                url:'{{Route('admin.roles.store')}}',
                data: form_data,
                processData: false,
                contentType: false,
                success: function( response ) {
                    alert(response.msg);
                    setTimeout(function(){
                        location.href = "{{route('admin.roles.index')}}";
                    },1000);             
                   },
            })
        return false;
        }
    })
</script>