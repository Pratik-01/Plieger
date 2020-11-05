@extends ('layouts.member_layout')

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
<h1 class="page-title">Task's List
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
                        <span class="caption-subject font-black sbold uppercase">Task List</span>
                    </div>
                    <div class="col-md-3 pull-right">
                        <input type="text" name="task_search"  id="search" class="form-control pull-right " placeholder="Search.."> 
                    </div>
                </div>
                <div class="portlet-body">
                    @if(isset($tasks) && !empty($tasks))
                        <div class="table-scrollable">
                            <table class="table table-striped table-bordered table-advance table-hover" id="teamtable">
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
                                <tbody id="taskList">
                                    @foreach($tasks as $task)
                                    <tr data-taskID="<?php echo $task['id'];?>">
                                        <td>{{$no++}}</td>
                                        <td>{{$task['task_name']}}</td>
                                        <td>{{$task['assigned_member']}}</td>
                                        <td>{{$task['team_name']}}</td>
                                        <td>{{$task['assigned_date']}}</td>
                                        <td>
                                            
                                            <a href="javascript:;" class="btn btn-outline btn-circle btn-sm purple delBtn"><i class="fa fa-edit"></i>Send for Review </a>
                                            <a href="javascript:;" class="btn btn-outline btn-circle btn-sm purple editBtn"><i class="fa fa-exclamation"></i> Issue </a>
                                           
                                                                        
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                    <div id="sliderContainer" class="col-md-12 empty_elem_tag">
                        No Tasks added.
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
 {{ $tasks->links() }}
@section ('page-scripts')
<script type="text/javascript">

function appendCommunityServices(tasks) {
            console.log(tasks);
            location.reload();
           
        }



        // callback function for edition the client.
        $(document).on('click', '.editBtn', function(event) {
            var e = $(this);
            var dialog = bootbox.dialog({
                    title: "Edit Team",
                    message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
                }
            );

            dialog.init(function(){
                setTimeout(function(){
                    var taskID = e.closest('tr').attr('data-taskID');
                    var rowIndex = e.closest('tr').index();
                    var url = 'task/' + taskID + '/edit';
                    
                    var task = "";
                    $.ajax({
                        url:url,
                        type:'get',
                        async:false,
                        success:function(res) {
                            task = res.task;
                        }
                    });
                    
                    
                  var html = '<form action="" id="editTaskform" class="horizontal-form" data-rowIndex="'+rowIndex+'">'+
                    '{{ csrf_field() }}'+
                        '<input type="hidden" value="'+task.id+'" name="id">'+
                        '<div class="modal-body">'+
                    '<div class="form-body">'+  
                    '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Remarks</label>'+
                                    '<textarea required class="form-control"  value="" name="issue_remark"  cols="30" rows="10" required>'+((task.issue_remark == null)?"":task.issue_remark)+'</textarea>'+
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

        $(document).on('submit', '#editTaskform', function(event) {
           event.preventDefault();
           var form = $(this);
           var formData = form.serialize();

           $.ajax({
               url: "task/update",
               type: 'POST',
               data: formData,
               success: function(res) {
                   if (res.status === 1) {
                       var task = res.task;
                        form.closest('.modal').modal('hide');
                        appendCommunityServices(task);
                        toastr.success('Updated.');
                   }
               }
           }); 
        });

        $(document).on('click', '.delBtn', function(event) {

            var e = $(this);
            var item = e.closest('tr');
            var taskID = e.closest('tr').attr('data-taskID');

            bootbox.confirm({
                message: "Are you sure you want to Send For Review?",
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
                        var url = 'task/done/'+taskID;

                        $.ajax({
                            url: url,
                            type: 'get',
                            async: false,
                            success: function(res) {
                                if (res.status === 1) {
                                    item.remove();
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

        //Search Task
        $(document).ready(function()
        {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }   
            });

            $('body').on('keyup','#search', function(){
                var searchValue = $(this).val();
            $.ajax({
                url:'{{route("member.task.search")}}',
                method: 'POST',
                data: {
                    searchValue: searchValue
                },
                dataType: 'json',
                success:function(res)
                {
                    var tableRow = '';
                    var n = 1;
                    if (res.status > 0) 
                    {
                        $('#taskList').html('');

                        $.each(res.tableData, function(index, value){
                            tableRow = '<tr><td>'+n+++'</td><td>'+value.task_name+'</td><td>'+value.assigned_member+'</td><td>'+value.assigned_date+'</td><td><a href="javascript:;" class="btn btn-outline btn-circle btn-sm purple editBtn" ><i class="fa fa-edit"></i> Edit </a><a href="javascript:;" class="btn btn-outline btn-circle btn-sm purple delBtn"><i class="fa fa-edit"></i> Review </a><a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm black delBtn" > <i class="fa fa-trash-o"></i> Issue </a></td></tr>';

                            $('#taskList').append(tableRow);
                        })
                    } else 
                    {
                        $('#taskList').html('');
                        tableRow = '<tr><td align="center" colspan="5"> No Similar Values Found</td></tr>';  

                        $('#taskList').append(tableRow);
                    }
                }
            })
            });
        });
    

    </script>
@endsection

