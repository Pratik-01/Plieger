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
<h1 class="page-title">Team's List
    <!-- <small>front end banners</small> -->
</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<!-- BEGIN DASHBOARD STATS 1-->

<div class="row margin-bottom-30">
    <div class="col-md-3 pull-right">
        <a href="#basic" data-toggle="modal" class="btn btn-sm green"><i class="fa fa-plus"></i> Add New Team</a>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-user font-black"></i>
                        <span class="caption-subject font-black sbold uppercase">Team List</span>
                    </div>
                </div>
                <div class="portlet-body">
                    @if(isset($teams) && !empty($teams))
                        <div class="table-scrollable">
                            <table class="table table-striped table-bordered table-advance table-hover" id="teamtable">
                                <thead>
                                    <tr><th>S.no</th>
                                        <th>
                                            <i class="fa fa-user"></i> Team Name </th>
                                            <th><i class="fa fa-exclamation"></i> Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($teams as $team)
                                    <tr data-teamID="<?php echo $team['id'];?>">
                                        <td>{{$no++}}</td>
                                        <td>{{$team['team_name']}}</td>
                                        <td>
                                            <a href="javascript:;" class="btn btn-outline btn-circle btn-sm purple editBtn"><i class="fa fa-edit"></i> Edit </a>
                                            <a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm green viewBtn" > <i class="fas fa-eye"></i> View</a>
                                            <a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm black delBtn" > <i class="fa fa-trash-o"></i> Delete</a>
                                           
                                                                        
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                    <div id="sliderContainer" class="col-md-12 empty_elem_tag">
                        No Teams added.
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
                <h4 class="modal-title">Add Team</h4>
            </div>
            <form action=""  id="addTeam" class="horizontal-form">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Team Name</label>
                                    <input type="text" class="form-control" name="team_name" required>
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

function appendCommunityServices(teams) {
            console.log(teams);
            location.reload();
           
        }

        $("#addTeam").on('submit', function(event) {
            event.preventDefault(); 
            var form = $(this);
            var formData = form.serialize();
            $.ajax({
                url: "team/store",
                type: 'POST',
                data: formData,
                success: function(res) {
                    if (res.status === 1) {
                        var teams = res.teams;
                        form.closest('.modal').modal('hide');
                        appendCommunityServices(teams);
                        form[0].reset();
                        toastr.success('Team added successfully.');
                    }
                }
            });
        });


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
                    var teamID = e.closest('tr').attr('data-teamID');
                    var rowIndex = e.closest('tr').index();
                    var url = 'team/' + teamID + '/edit';
                    
                    var team = "";
                    $.ajax({
                        url:url,
                        type:'get',
                        async:false,
                        success:function(res) {
                            team = res.team;
                        }
                    });
                    
                    


                    var html = '<form action="" id="editTeamform" class="horizontal-form" data-rowIndex="'+rowIndex+'">'+
                    '{{ csrf_field() }}'+
                        '<input type="hidden" value="'+team.id+'" name="id">'+
                        '<div class="modal-body">'+
                    '<div class="form-body">'+  
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Team name</label>'+
                                    '<input type="text" class="form-control" value="'+team.team_name+'" name="team_name" required>'+
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

        $(document).on('submit', '#editTeamform', function(event) {
           event.preventDefault();
           var form = $(this);
           var formData = form.serialize();

           $.ajax({
               url: "team/update",
               type: 'POST',
               data: formData,
               success: function(res) {
                   if (res.status === 1) {
                       var team = res.team;
                       $tableData = $('#teamtable> tbody').find('tr').eq(form.attr('data-rowIndex')).find('td');
                        $tableData.eq(1).html(team.team_name);
                        form.closest('.modal').modal('hide');
                        appendCommunityServices(team);
                        toastr.success('Updated.');
                   }
               }
           }); 
        });

        $(document).on('click', '.delBtn', function(event) {

            var e = $(this);
            var item = e.closest('tr');
            var teamID = e.closest('tr').attr('data-teamID');

            bootbox.confirm({
                message: "Are you sure you want to delete this Team?",
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
                        var url = 'team/delete/'+teamID;

                        $.ajax({
                            url: url,
                            type: 'get',
                            async: false,
                            success: function(res) {
                                if (res.status === 1) {
                                    item.remove();
                                    toastr.success('The Team has been deleted.');
                                } else {
                                    toastr.error('Something went wrong. Please try again.');
                                }
                            }
                        });
                    }
                }
            });
        });

        $(document).on('click', '.viewBtn', function (event) {
        var e = $(this);
        var dialog = bootbox.dialog({
            title: "Team Members",
            message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
        });

        dialog.init(function () {
            setTimeout(function () {
                var teamID = e.closest('tr').attr('data-teamID');
                var rowIndex = e.closest('tr').index();
                var url = '/team/view/' + teamID;
                console.log(url)

                var member = "";
                $.ajax({
                    url: url,
                    type: 'get',
                    async: false,
                    success: function (res) {
                        member = res.member;
                    }
                });
                data = "";
                i = 0;
                member.forEach(element => {
                    i++;
                    data = data +'<tr><td>'+i+'</td><td>'+element.name+'</td></tr>';
                    // console.log(element)
                });




                var html = '<form action="" id="" class="horizontal-form" >' +
                    '{{ csrf_field() }}' +
                    '<div class="modal-body">' +
                    '<div class="form-body">' +
                    '<div class="row">' +
                    '<table class="table table-striped table-bordered table-advance table-hover">' +
                    '<thead>' +
                    '<tr><th>S.no</th>' +
                    '<th>Member Name</th>' +
                    '</tr>' +
                    '</thead>'+
                '<tbody>'+data+
                    '</tbody>'+
                '</table>'+
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="modal-footer">' +
                '<button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>' +
                '</div>' +
                '</form>';
                dialog.find('.bootbox-body').html(html);
            }, 500);
        });
    });

    

    </script>
@endsection

