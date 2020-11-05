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
            <span>Uploaded Task</span>
        </li>
    </ul>
    
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">Uploaded Task List
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
                        <span class="caption-subject font-black sbold uppercase">Uploaded List</span>
                    </div>
                </div>
                <div class="portlet-body">
                    @if(isset($uploads) && !empty($uploads))
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
                                            <i class="fa fa-user"></i> Finished Date </th>
                                            <th><i class="fa fa-exclamation"></i> Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($uploads as $upload)
                                    <tr data-uploadID="<?php echo $upload['id'];?>">
                                        <td>{{$no++}}</td>
                                        <td>{{$upload['task_name']}}</td>
                                        <td>{{$upload['assigned_member']}}</td>
                                        <td>{{$upload['team_name']}}</td>
                                        <td>{{$upload['assigned_date']}}</td>
                                        <td>{{$upload['finished_date']}}</td>
                                        <td>
                                        <a href="{{route('pending.view',$upload['id'])}}" class="btn btn-outline btn-circle btn-sm purple "><i class="fa fa-edit"></i>View</a>                         
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                    <div id="sliderContainer" class="col-md-12 empty_elem_tag">
                        No Task Pending.
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
