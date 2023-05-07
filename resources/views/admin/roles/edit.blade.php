<?php $required_span = '<span class="text-red">*</span>';?>
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Edit Menu</h4>  
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div id="return_data"></div>
        <form class="form-horizontal" method="POST" name="edit_role" id="edit_role">
          @csrf
          <input name="_method" type="hidden" value="PATCH">
          <div class="box-body">
            <div class="form-group">
              <label for="Title">Menu Name:<?=$required_span; ?></label>
              <input type="text" class="form-control required" id="Title" placeholder="Title" name="Title" value="{{$role_data->name}}">	
              <input type="hidden" name="id" value="{{$role_data->id}}">
            </div>
            <button type="submit" class="btn btn-primary btn-flat">Update</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
        
        $('#edit_role').validate({
            submitHandler(form){
                let form_data = new FormData(form);
                var id = {{$role_data->id}};

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: '{{route('admin.roles.update',$role_data->id)}}',
                    data: form_data,
                    processData: false,
                    contentType: false,
                    success: function( response ) {
                        alert(response.msg);
                        location.reload();
                    },
                })
            return false;
            }
        })
        
    </script>