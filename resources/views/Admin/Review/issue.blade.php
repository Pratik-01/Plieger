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
            <span>Issues</span>
        </li>
    </ul>
    
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">Issue's List
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
                        <span class="caption-subject font-black sbold uppercase">Issue's List</span>
                    </div>
                </div>
                <div class="portlet-body">
                    @if(isset($issues) && !empty($issues))
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
                                            <th>
                                            <i class="fa fa-user"></i> Issue Remark </th>
                                            <th><i class="fa fa-exclamation"></i> Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($issues as $issue)
                                    <tr data-issueID="<?php echo $issue['id'];?>">
                                        <td>{{$no++}}</td>
                                        <td>{{$issue['task_name']}}</td>
                                        <td>{{$issue['assigned_member']}}</td>
                                        <td>{{$issue['team_name']}}</td>
                                        <td>{{$issue['assigned_date']}}</td>
                                        <td>{{$issue['issue_remark']}}</td>
                                        <td>
                                        <a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm black delBtn" > <i class="fa fa-check"></i>Re-Assign</a>                      
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                    <div id="sliderContainer" class="col-md-12 empty_elem_tag">
                        No Issues.
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

function appendCommunityServices(issues) {
            console.log(issues);
            location.reload();
           
        }

        
        $(document).on('click', '.delBtn', function(event) {

            var e = $(this);
            var item = e.closest('tr');
            var issueID = e.closest('tr').attr('data-issueID');

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
                        var url = 'issue/reassign/'+ issueID;

                        $.ajax({
                            url: url,
                            type: 'get',
                            async: false,
                            success: function(res) {
                                if (res.status === 1) {
                                    location.reload();
                                    toastr.success('The Task has been Re-Assigned.');
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

