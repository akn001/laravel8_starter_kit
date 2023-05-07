@extends('layouts.admin')
@section('page_header')
<ul class="navbar-nav flex-row">
    <li>
        <div class="page-header">
            <nav class="breadcrumb-one" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Administration</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Roles</span></li>
                </ol>
            </nav>
        </div>
    </li>
</ul>
@endsection
@section('content')
<?php
  $required_span='<span style="color:red;">*</span>';
?>
<div class="layout-px-spacing">
  <div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing ">
      <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>Roles</h4>
                    @if(moduleacess('admin/roles','add'))
                      <a href="#" class="btn btn-primary btn-flat" onclick="GetModel('{{Route('admin.roles.create')}}')">New Role</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <div class="widget-one">
              <table id="example" class="table dt-table-hover dataTable">
                <thead>
                  <tr>
                    <th >No</th>
                    <th >Role</th>
                    <th >Date Published</th>
                    <th >Command</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                      $i=1;
                      foreach($roles as $row){
                        $Name=$row->name;
                        echo'<tr>
                          <td>'.$i.'</td>
                          <td>'.$Name.'</td>
                          <td >'.date('d-M-y',strtotime($row->created_at)).'</td>
                          <td>';
                            if(moduleacess('admin/roles','edit')){?>
                             <a class="btn mb-2 mr-2 rounded-circle btn-outline-primary"  href="#" onclick="GetModel('{{Route('admin.roles.edit',$row->id)}}')" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                            <?php }
                            echo'&nbsp;<a class="btn mb-2 mr-2 rounded-circle btn-outline-dark" href="'.route("admin.RolePermissions",[$row->id,'0']).'" data-toggle="tooltip" data-placement="top" title="Give Access"><i class="far fa-eye"></i></a>';
                          echo' </td>
                        </tr>';
                        $i++;
                      }
                    ?>
                </tbody>
              </table>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
  <div class="modal fade" id="addMenu" data-backdrop="static" role="dialog">
  
  </div>
  <div class="modal fade" id="addMenuEdit" data-backdrop="static" role="dialog">
  
  </div>

  <script>
    function GetModel(url){
      $.ajax({
        url:url,
        method:'GET',
        success:function(res){
          $("#addMenu").html(res);
          $("#addMenu").modal('show');
        }
      });
    }
    function GetModelEdit(url){
      $.ajax({
        url:url,
        method:'GET',
        success:function(res){
        
          $("#addMenuEdit").html(res);
          $("#addMenuEdit").modal('show');
        }
      });
    }
  </script>
@endsection