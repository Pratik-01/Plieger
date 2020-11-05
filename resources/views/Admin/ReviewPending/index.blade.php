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
            <span>Teams</span>
        </li>
    </ul>
    
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">Review Pending List
    <!-- <small>front end banners</small> -->
</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<!-- BEGIN DASHBOARD STATS 1-->

<div class="row margin-bottom-30">
    <div class="col-md-3 pull-right">
        
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-black"></i>
                        <span class="caption-subject font-black sbold uppercase">Pending List</span>
                    </div>
                </div>
                <div class="portlet-body">
                    @if(isset($pendings) && !empty($pendings))
                        <div class="table-scrollable">
                            <table class="table table-striped table-bordered table-advance table-hover" id="reviewpendingtable">
                                <thead>
                                    <tr><th>S.no</th>
                                        <th>
                                            <i class="fa fa-user"></i> Task Name </th>
                                            <th>
                                            <i class="fa fa-user"></i> Assigned Member </th>
                                            <th><i class="fa fa-user"></i> Team Name </th>
                                            <th>
                                            <i class="fa fa-user"></i> Assigned Date </th>
                                            <th><i class="fa fa-exclamation"></i> Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($pendings as $pending)
                                    <tr data-pendingID="<?php echo $pending['id'];?>">
                                        <td>{{$no++}}</td>
                                        <td>{{$pending['task_name']}}</td>
                                        <td>{{$pending['assigned_member']}}</td>
                                        <td>{{$pending['team_name']}}</td>
                                        <td>{{$pending['assigned_date']}}</td>
                                        <td>
                                        <a href="javascript:;" class="btn btn-outline btn-circle btn-sm purple editBtn"><i class="fa fa-edit"></i> Assign Review </a>
                                        <a href="{{route('pending.view',$pending['id'])}}" class="btn btn-outline btn-circle btn-sm purple "><i class="fa fa-edit"></i>View</a>
                                        <a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm black delBtn" > <i class="fa fa-check"></i>Finished </a>   
                                           
                                                                        
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                    <div id="sliderContainer" class="col-md-12 empty_elem_tag">
                        No Reviews Pending.
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section ('page-scripts')
<script type="text/javascript">

function appendCommunityServices(pendings) {
            console.log(pendings);
            location.reload();
           
        }

        function getallmembers()
        {
            var member_names = [];
            $.ajax({
                url: "{{route('task.getallmembers')}}",
                type: 'GET',
                dataType: 'json',
                async:false,
                success: function(res) {
                    if (res.status === 1) {
                        member_names = res.member_names;
                    }
                }
            });

            return member_names;
        }


        // callback function for edition the client.
        $(document).on('click', '.editBtn', function(event) {
            var e = $(this);
            var member_names = getallmembers();
            var dialog = bootbox.dialog({
                    title: "Edit Team",
                    message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
                }
            );

            dialog.init(function(){
                setTimeout(function(){
                    var pendingID = e.closest('tr').attr('data-pendingID');
                    var rowIndex = e.closest('tr').index();
                    var url = 'pending/' + pendingID + '/edit';
                    
                    var pending = "";
                    $.ajax({
                        url:url,
                        type:'get',
                        async:false,
                        success:function(res) {
                            pending = res.pending;
                        }
                    });
                    
                    var member_id = pending.member_id;
                    var options = "";
                    options += '<option value="">Choose a Team</option>';
                    member_names.forEach(function(i, v) {
                        options += '<option value="'+i.id+'" '+((i.id == member_id)?"selected":'')+'>'+i.name+'</option>';
                    });
                    


                    var html = '<form action="" id="editPendingform" class="horizontal-form" data-rowIndex="'+rowIndex+'">'+
                    '{{ csrf_field() }}'+
                        '<input type="hidden" value="'+pending.id+'" name="id">'+
                        '<div class="modal-body">'+
                    '<div class="form-body">'+  
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Team name</label>'+
                                    '<input type="text" class="form-control" value="'+pending.task_name+'" name="task_name" readonly required>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Assigned Review TO</label>'+
                                    '<select class="form-control" name="member_id" value="">'+
                                    options+

                                    '</select>'+
                                   
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Review Assigned Date</label>'+
                                    '<input type="date" class="form-control" value="'+pending.assigned_date+'" name="assigned_date" readonly required>'+
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

        $(document).on('submit', '#editPendingform', function(event) {
           event.preventDefault();
           var form = $(this);
           var formData = form.serialize();

           $.ajax({
               url: "pending/update",
               type: 'POST',
               data: formData,
               success: function(res) {
                   if (res.status === 1) {
                       var pending = res.pending;
                        form.closest('.modal').modal('hide');
                        appendCommunityServices(pending);
                        toastr.success('Updated.');
                   }
               }
           }); 
        });

        $(document).on('click', '.delBtn', function(event) {

            var e = $(this);
            var item = e.closest('tr');
            var pendingID = e.closest('tr').attr('data-pendingID');

            bootbox.confirm({
                message: "Are you sure you?",
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
                        var url = 'pending/finish/'+ pendingID;

                        $.ajax({
                            url: url,
                            type: 'get',
                            async: false,
                            success: function(res) {
                                if (res.status === 1) {
                                    location.reload();
                                    toastr.success('The Task has been Finished.');
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

