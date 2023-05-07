@extends('layouts.admin')
@section('page_header')
<ul class="navbar-nav flex-row">
    <li>
        <div class="page-header">
            <nav class="breadcrumb-one" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Update Profile</span></li>
                </ol>
            </nav>
        </div>
    </li>
</ul>
@endsection
@section('content')
@php $required_span ='<span style="color:red">*</span>'; @endphp
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing ">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Update Profile</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area p-4">
                        <div class="widget-one">
                        <ul class="nav nav-tabs  mb-3 mt-3" id="simpletab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab_1-tab" data-toggle="tab" href="#tab_1" role="tab" aria-controls="tab_1" aria-selected="true">{{trans('label.Personal information')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab_3-tab" data-toggle="tab" href="#tab_3" role="tab" aria-controls="tab_3" aria-selected="false">{{trans('label.Change Password')}}</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="simpletabContent">
                            <div class="tab-pane fade show active" id="tab_1" role="tabpanel" aria-labelledby="tab_1-tab">
                            <form method="POST" class="form-horizontal add_admin_personal" enctype="multipart/form-data" id="add_admin_personal">
                                    <!-- <input name="_method" type="hidden" value="PUT"> -->
                                    @csrf
                                    <!-- method_field('PUT') -->
                                    <input name="_method_field" type="hidden" value="PATCH">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="username">{{trans('label.Username')}}:<?=$required_span;?></label>
                                                <input type="text" class="form-control required"  name="username" id="username" value="{{$row->username}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="name">{{trans('label.Name')}}:<?=$required_span;?></label>
                                                <input type="text" class="form-control required"  name="name" id="name" value="{{$row->name}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="mobile">{{trans('label.Mobile')}}:</label>
                                                <input type="text" class="form-control digits" _placeholder="Enter Mobile" name="mobile" id="mobile" value="{{$row->mobile}}" >
                                            </div>
                                            <div class="form-group">
                                                <label for="email">{{trans('label.Email')}}:<?=$required_span;?></label>
                                                <input type="text" class="form-control email required" _placeholder="Enter Email" name="email" id="email" value="{{$row->email}}">
                                                
                                            </div>
                                            <div class="form-group">
                                                <label for="role">Role:<?=$required_span;?></label>
                                                    <?php
                                                    if($row->role == 1){
                                                        echo '<input type="text" value="Super Admin" class="form-control" readonly>';
                                                        echo '<input type="hidden" name="role" value="1" id="role">';
                                                    }else{
                                                    ?>
                                                    <select class="form-control required" name="role" id="role">
                                                        <option value="">-- select role --</option>
                                                        <?php
                                                        foreach($roles as $row_role){
                                                            echo'<option value="'.$row_role->id.'" '.($row->role==$row_role->id?'selected':'').'>'.$row_role->name.'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <?php } ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="user_image">{{trans('label.Profile Photo')}}:</label>
                                                <?php
                                                    if($row->user_image != ''){
                                                        echo '<img src="'.asset('user_image/'.$row->user_image.'').'" class="img-fluid" height="100px" width="100px" alt="'.$row->user_image'">';
                                                    }
                                                ?>
                                                <input id="file-upload" type="file" name="user_image" class="form-control"/>
                                                <input type="hidden" value="{{$row->user_image}}" name="hidden_image">
                                            </div>
                                        </div>
                                        <!-- col-lg-6 -->
                                        <div class="col-lg-6">
                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                    <button type="submit" class="btn btn-success btn-flat submit">{{trans('label.Update')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>   
                            </div>
                            <div class="tab-pane fade" id="tab_3" role="tabpanel" aria-labelledby="tab_3-tab">
                               <form method="POST" class="form-horizontal change_pass" id="change_pass" name="change_pass" enctype="multipart/form-data">
                                    @csrf
                                    <input name="_method_field" type="hidden" value="PATCH">
                                    <!-- method_field('PUT') -->
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="password">{{trans('label.Password')}}:<?=$required_span;?></label>
                                                <input type="password" class="form-control required" placeholder="Enter Password" name="password" id="password" value="{{old('password')}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="cpassword">{{trans('label.Confirm Password')}} :<?=$required_span;?></label>
                                                <input type="password" class="form-control required" placeholder="Confirm Password" name="cpassword" id="cpassword" value="{{old('cpassword')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success btn-flat">{{trans('label.Update')}}</button>
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
</div>

@endsection
@section('script')
<script>
    $(".add_admin_personal").validate({
        submitHandler(form){
            $(".submit").attr("disabled", true);
            var form_cust = $('.add_admin_personal')[0]; 
            let form1 = new FormData(form_cust);
            //var id ={{$row->id}};
            $.ajax({
                type: "POST",
                url: '{{route('admin.DoEditAdmin',$row->id)}}',
                data: form1,
                contentType: false,
                processData: false,
                success: function( response ) {
                    if(response.error == 0){
                        toastr.success(response.msg);
                        setTimeout(function(){
                            
                            location.reload();
                        },2000);
                    }else{
                        $(".submit").attr("disabled", false);
                        toastr.error(response.msg);
                    }
                },
                error: function(data){
                    $(".submit").attr("disabled", false);
                    var errors = data.responseJSON;
                    $.each( errors.errors, function( key, value ) {
                        var ele = "#"+key;
                        $(ele).addClass('error');
                        $('<label class="error">'+ value +'</label>').insertAfter(ele);
                    });
                }
            })
            return false;
        }
    });

    $(".change_pass").validate({
        submitHandler(form){
            $(".submit").attr("disabled", true);
            var form_cust = $('.change_pass')[0]; 
            let form1 = new FormData(form_cust);
            //var id ={{$row->id}};
            $.ajax({
                type: "POST",
                url: '{{route('admin.AdminChangePassword',$row->id)}}',
                data: form1,
                contentType: false,
                processData: false,
                success: function( response ) {
                    if(response.error == 0){
                        toastr.success(response.msg);
                        setTimeout(function(){
                            location.href = '{{ route('logout') }}';
                           //location.reload(); 
                           //location.href = '{{route('admin.profile',[$row->id,'tab_3'])}}';
                        },2000);
                    }else{
                        $(".submit").attr("disabled", false);
                        toastr.error(response.msg);
                        location.reload();
                    }
                },
                error: function(data){
                    $(".submit").attr("disabled", false);
                    var errors = data.responseJSON;
                    $.each( errors.errors, function( key, value ) {
                        var ele = "#"+key;
                        $(ele).addClass('error');
                        $('<label class="error">'+ value +'</label>').insertAfter(ele);
                    });
                }
            })
            return false;
        }
    });

    /*$('.change_pass').on('submit', function() {
        $('#change_pass').validate({
          submitHandler: function(form) {alert("123");
            // do other things for a valid form
            form.submit();
          }
        });
    });*/
    //$('#add_admin_personal').on('submit', function() {
    /*$('#add_admin_personal').validate({
        submitHandler(form){
            let form_data = new FormData(form);
            var id = {{$row->id}};
            alert("123");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '{{route('admin.DoEditAdmin',$row->id) }}',
                data: form_data,
                processData: false,
                contentType: false,
                success: function( response ) {
                    alert(response.msg);
                    location.reload();
                },
            })
            error: function(data){
                $(".submit").attr("disabled", false);
                var errors = data.responseJSON;
                $.each( errors.errors, function( key, value ) {
                    var ele = "#"+key;
                    $(ele).addClass('error');
                    $('<label class="error">'+ value +'</label>').insertAfter(ele);
                });
            }
        return false;
        }
    });*/
    //});
/*$('.change_pass').validate({
    rules:{
        password : {
            required:true,
        },
        cpassword : {
            required:true,
            equalTo : "#password"
        },
    },
    messages:{
        cpassword:{
            required:'Confirm Password is required',
            equalTo:'Confirm Password & Password does not match',
        }
    }
});*/
/*$('.add_admin_personal').validate({
    rules:{
        name:'required',
        password : {
            required:true,
        },
        cpassword : {
            required:true,
            equalTo : "#password"
        },
        email:{
            required:true,
            email:true,
            remote:{
                url:'{{url("admin/CheckDuplicateUser")}}',
                type:'post',
                data:{
                    email: function(){return $('#email').val();},
                    id: function(){return '{{$row->id}}'}
                    }
            }
        },
        username:{
            required:true,
            remote:{
                url:'{{url("admin/CheckDuplicateUsername")}}',
                type:'post',
                data:{
                    username: function(){return $('#username').val();},
                    id: function(){return '{{$row->id}}'}
                    }
            }
        },
        mobile:{
            number:true
        }

    },
    messages:{
        name:'Name can not be empty',
        middle_name:'Middle Name can not be empty',
        surname:'Surname can not be empty',
        nif_cif:'NIF/CIF can not be empty',
        email:{
            required:'Email is required',
            email:'Email is not in correct formate',
            remote:'Email already exist',
        },
        username:{
            required:'Username is required',
            remote:'Username already exist',
        },
        mobile:{
            number:'Mobile number is not correct'
        },
        cpassword:{
            required:'Confirm Password is required',
            equalTo:'Confirm Password & Password does not match',
        }
    }
});*/
</script>
<script>
    var val = '{{$tab}}';
    if(val != ''){
        //alert(val);   
        jQuery(function () {
        jQuery('a[href="#'+ val +'"]').tab('show');
        });
    }
</script>
@stop