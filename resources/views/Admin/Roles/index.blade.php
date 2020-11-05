@extends ('layouts.admin_layout')

@section ('page-styles')
<!-- <link rel="stylesheet" href="{{ asset('assets/global/plugins/ekko-lightbox/ekko-lightbox.min.css') }}"> -->
@endsection

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('/admin/dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Roles</span>
        </li>
    </ul>
    
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">Role's List
    <!-- <small>front end banners</small> -->
</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<!-- BEGIN DASHBOARD STATS 1-->

<div class="row margin-bottom-30">
    <div class="col-md-3 pull-right">
        <a href="#basic" data-toggle="modal" class="btn btn-sm green"><i class="fa fa-plus"></i> Add New Role</a>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-black"></i>
                        <span class="caption-subject font-black sbold uppercase">Role List</span>
                    </div>
                </div>
                <div class="portlet-body">
                    @if(isset($roles) && !empty($roles))
                        <div class="table-scrollable">
                            <table class="table table-striped table-bordered table-advance table-hover" id="roletable">
                                <thead>
                                    <tr><th>S.no</th>
                                        <th>
                                            <i class="fa fa-user"></i> Title </th>
                                            <th><i class="fa fa-exclamation"></i> Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($roles as $role)
                                    <tr data-roleID="<?php echo $role['id'];?>">
                                        <td>{{$no++}}</td>
                                        <td>{{$role['title']}}</td>
                                        <td>
                                            <a href="javascript:;" class="btn btn-outline btn-circle btn-sm purple editBtn"><i class="fa fa-edit"></i> Edit </a>
                                            <a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm black delBtn" > <i class="fa fa-trash-o"></i> Delete</a>
                                           
                                                                        
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                    <div id="sliderContainer" class="col-md-12 empty_elem_tag">
                        No Roles added.
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- add slider modal -->
<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add Collection</h4>
            </div>
            <form action=""  id="addRole" class="horizontal-form">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Title</label>
                                    <input type="text" class="form-control" name="Title" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn green ladda-button" data-style="expand-left"><span class="ladda-label">Submit</span></button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- end of add slider modal -->
@endsection

@section ('page-scripts')
<script type="text/javascript">

function appendCommunityServices(roles) {
            console.log(roles);
            var sn = $("#roletable tbody tr").length + 1;
            var tr = '<tr>'+
                    '<td>'+sn+'</td>'+
                    '<td>'+roles.title+'</td>'+
                    
                    '<td>'+
                    '<a href="javascript:;" class="btn btn-outline btn-circle btn-sm purple editBtn"><i class="fa fa-edit"></i> Edit </a>'+
                    '<a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm black delBtn" > <i class="fa fa-trash-o"></i> Delete</a>'+
                    '</td>'+
                '</tr>';
            $("#roletable tbody").append(tr);
        }

        $("#addRole").on('submit', function(event) {
            event.preventDefault(); 
            var form = $(this);
            var formData = form.serialize();
            $.ajax({
                url: "role/store",
                type: 'POST',
                data: formData,
                success: function(res) {
                    if (res.status === 1) {
                        var roles = res.roles;
                        form.closest('.modal').modal('hide');
                        appendCommunityServices(roles);
                        form[0].reset();
                        toastr.success('Role added successfully.');
                    }
                }
            });
        });


        // callback function for edition the client.
        $(document).on('click', '.editBtn', function(event) {
            var e = $(this);
            var dialog = bootbox.dialog({
                    title: "Edit Role",
                    message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
                }
            );

            dialog.init(function(){
                setTimeout(function(){
                    var roleID = e.closest('tr').attr('data-roleID');
                    var rowIndex = e.closest('tr').index();
                    var url = 'role/' + roleID + '/edit';
                    
                    var role = "";
                    $.ajax({
                        url:url,
                        type:'get',
                        async:false,
                        success:function(res) {
                            role = res.role;
                        }
                    });
                    
                    


                    var html = '<form action="" id="editRoleform" class="horizontal-form" data-rowIndex="'+rowIndex+'">'+
                    '{{ csrf_field() }}'+
                        '<input type="hidden" value="'+role.id+'" name="id">'+
                        '<div class="modal-body">'+
                    '<div class="form-body">'+  
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Name</label>'+
                                    '<input type="text" class="form-control" value="'+role.title+'" name="title" required>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
                '<div class="modal-footer">'+
                    '<button type="button" class="btn dark btn-outline" data-dismiss="modal">Cancel</button>'+
                    '<input class="btn green" type="submit" value="Update">'+
                '</div>'+
                        '</form>';
                    dialog.find('.bootbox-body').html(html);
                }, 500);
            });
        });

        $(document).on('submit', '#editRoleform', function(event) {
           event.preventDefault();
           var form = $(this);
           var formData = form.serialize();

           $.ajax({
               url: "role/update",
               type: 'POST',
               data: formData,
               success: function(res) {
                   if (res.status === 1) {
                       var role = res.role;
                       $tableData = $('#roletable > tbody').find('tr').eq(form.attr('data-rowIndex')).find('td');
                        $tableData.eq(1).html(role.title);
                        form.closest('.modal').modal('hide');
                        appendCommunityServices(role);
                        toastr.success('Updated.');
                   }
               }
           }); 
        });

        $(document).on('click', '.delBtn', function(event) {

            var e = $(this);
            var item = e.closest('tr');
            var roleID = e.closest('tr').attr('data-roleID');

            bootbox.confirm({
                message: "Are you sure you want to delete this Role?",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn green'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn red'
                    }
                },
                callback: function (result) {
                    if (result) {
                        var url = 'role/delete/'+roleID;

                        $.ajax({
                            url: url,
                            type: 'get',
                            async: false,
                            success: function(res) {
                                if (res.status === 1) {
                                    item.remove();
                                    toastr.success('The Role has been deleted.');
                                } else {
                                    toastr.error('Something went wrong. Please try again.');
                                }
                            }
                        });
                    }
                }
            });
        });

    

    </script>
@endsection

