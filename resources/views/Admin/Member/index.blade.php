@extends ('layouts.admin_layout')

@section ('page-styles')
<!-- <link rel="stylesheet" href="{{ asset('assets/global/plugins/ekko-lightbox/ekko-lightbox.min.css') }}"> -->
@endsection

@section('content')

<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('/admin/dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Members</span>
        </li>
    </ul>
    
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">Members
    <!-- <small>front end banners</small> -->
</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<!-- BEGIN DASHBOARD STATS 1-->

<div class="row margin-bottom-30">
    <div class="col-md-3 pull-right">
        <a href="#basic" data-toggle="modal" class="btn btn-sm green pull-right"><i class="fa fa-plus"></i> Add New Member</a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-red"></i>
                    <span class="caption-subject font-red sbold uppercase">Member List</span>
                </div>
            </div>
            <div class="portlet-body">
            @if(isset($members) && !empty($members))
                <div class="table-scrollable table-scrollable-borderless">
                    <table id="membertable" class="table table-hover table-light">
                        <thead>
                            <tr class="uppercase">
                                <th> SN </th>
                                <th> Full Name </th>
                               
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                          
                      @foreach($members as $key => $member)    
                            <tr data-memberID="<?php echo $member['id'];?>">
                                <td>{{$members->firstItem() + $key}} </td>
                                <td>{{$member['name']}}</td>
                              
                                <td>
                                    <a href="javascript:;" class="btn btn-xs red delBtn">delete</a>
                                    <a href="javascript:;" class="btn btn-xs blue editBtn">edit</a>
                                    <a href="{{route('member.view',$member['id'])}}" class="btn btn-xs green">View</a>
                                </td>
                                
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
                <div style="display: flex;align-items: center;justify-content: center;">
                    {{$members->links()}}
                </div>
                @else
        <div id="sliderContainer" class="col-md-12 empty_elem_tag">
            No Member added.
        </div>
    @endif
            </div>
            
        </div>
    </div>
</div>
<!-- <div class="clearfix"></div> -->

<!-- add slider modal -->
<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add Member</h4>
            </div>
            <form action=""  id="addMember" class="horizontal-form">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-body">

                    <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Image</label>
                                    <input  name="file" type="file" id="imgInp" />
                                    <div>
                                        <img id="cropimage" src=""  style="width: 100%; height: auto;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Full Name</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Password</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label class="control-label">Team</label>
                                        <select class="form-control" name="team_id" required>
                                            <option value ="">Choose a Team</option>
                                            @foreach($teams as $team)
                                            <option value="<?php echo $team['id'];?>">{{$team['team_name']}}</option>
                                            @endforeach
                                       
                                        </select> 
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label class="control-label">Role</label>
                                        <select class="form-control" name="role_id" required>
                                            <option value ="">Choose a Role</option>
                                            <option value="1">Team Supervisor</option>
                                            <option value="2">Team Member</option>
                                            <option value="3">Team Leader</option>
                                         </select> 
                                    </div>
                                </div>
                            </div>
                       
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Mobile No</label>
                                    <input type="text" class="form-control" name="mobile_no" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Address</label>
                                    <input type="text" class="form-control" name="address" required>
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

   
    $(function() {
        function appendCommunityServices(members) {
            console.log(members);
           location.reload();
        }
        function readURL(input) {

            if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#cropimage').attr('src', e.target.result);
                cropper.destroy();
                initCrop();

            }

            reader.readAsDataURL(input.files[0]);
            }
        }

        function readEditUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $("#editimage").attr('src', e.target.result);
                    edit_cropper.destroy();
                    initEditCrop();
                }
                reader.readAsDataURL(input.files[0]);    
            } 
        }

    $("#imgInp").change(function() {
        readURL(this);
    });

    $(document).on('change', '#editimg', function() {
        readEditUrl(this);
    });

        // $.ajaxSetup({
        //         headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
        // });
        var image = "";
        var cropper = "";

        // variable for edit crop image.
        var edit_image = "";
        var edit_cropper = "";

        function initCrop() {
            image = document.getElementById('cropimage');
            cropper = new Cropper(image, {
            aspectRatio: 1 / 1,
            zoomOnWheel: false
                // crop(event) {
                //     console.log(event.detail.x);
                //     console.log(event.detail.y);
                //     console.log(event.detail.width);
                //     console.log(event.detail.height);
                //     console.log(event.detail.rotate);
                //     console.log(event.detail.scaleX);
                //     console.log(event.detail.scaleY);
                // },
            });
        }

        function initEditCrop() {
            edit_image = document.getElementById('editimage');
            edit_cropper = new Cropper(edit_image, {
                aspectRatio: 1 / 1,
                zoomOnWheel: false
            });
        }
       

        initCrop();

       

        $("#addMember").on('submit', function(event) {
            event.preventDefault();
            var form = $(this);
            var formData = new FormData(form[0]);
            if(document.getElementById("imgInp").value != "") {
                // you have a file
                cropper.crop();
                var crop_data = cropper.getData();
                formData.append('image_dimension', JSON.stringify(crop_data));
            }
            $.ajax({
                url: "member/store",
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(res){
                    if (res.status === 1) {
                        var members = res.members;
                        form.closest('.modal').modal('hide');
                        appendCommunityServices(members);
                        form[0].reset();
                        toastr.success('Member added successfully.');
                    }
                    if (res.emailexists === 1) {
                        toastr.error('Email Address already Exists.');
                    }
                },
                error: function (request, status, errorThrown) {
                    alert(request.responseText);
                    //toastr.error('asdasdasd.');
                }
            });
        });

        function getallteams()
        {
            var teamids = [];
            $.ajax({
                url: "{{route('member.getallteams')}}",
                type: 'GET',
                dataType: 'json',
                async:false,
                success: function(res) {
                    if (res.status === 1) {
                        teamids = res.teamids;
                    }
                }
            });

            return teamids;
        }


        // callback function for edition the client.
        $(document).on('click', '.editBtn', function(event) {
            var e = $(this);
            var teamids = getallteams();
            var dialog = bootbox.dialog({
                    title: "Edit Member",
                    message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
                }
            );

            dialog.init(function(){
                setTimeout(function(){
                    var memberID = e.closest('tr').attr('data-memberID');
                    var rowIndex = e.closest('tr').index();
                    var url = 'member/' + memberID + '/edit';
                    
                    var member = "";
                    $.ajax({
                        url:url,
                        type:'get',
                        async:false,
                        success:function(res) {
                            member = res.member;
                        }
                    });

                    var team_id = member.team_id;
                    var options = "";
                    options += '<option value="">Choose a Team</option>';
                    teamids.forEach(function(i, v) {
                        options += '<option value="'+i.id+'" '+((i.id == team_id)?"selected":'')+'>'+i.team_name+'</option>';
                    });
                    
                    var role_id =member.role_id;
                    var role_options = "";
                    role_options += '<option value="">Choose a Role</option>';
                    role_options += '<option value="1" '+((1 == role_id)?"selected":'')+'>Team Supervisor</option>';
                    role_options += '<option value="2" '+((2 == role_id)?"selected":'')+'>Team Member</option>';


                    if(member.image_name==='no_image'){
                        var image_url = "<?php echo asset('/') . '/storage/Members/no_image.png'; ?>"
                    }else{
                        var image_url = "<?php echo asset('/') . '/storage/Members/'; ?>" +
                        member.id + "/" + member.image_name;
                    }
                    var html = '<form action="" id="editMemberform" class="horizontal-form" data-rowIndex="'+rowIndex+'">'+
                    '{{ csrf_field() }}'+
                        '<input type="hidden" value="'+member.id+'" name="id">'+
                        '<div class="modal-body">'+
                    '<div class="form-body">'+
                    '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Image</label>'+
                                    '<input  name="file" type="file" id="editimg" />'+
                                    '<div>'+
                                        '<img id="editimage" src="'+image_url+'"  style="width: 100%; height: auto;">'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+   
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Full Name</label>'+
                                    '<input type="text" class="form-control" value="'+member.name+'" name="name" required>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Email</label>'+
                                    '<input type="email" class="form-control" value="'+member.email+'" name="email" required>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Team</label>'+
                                    '<select class="form-control" name="team_id" value="">'+
                                    options+

                                    '</select>'+
                                   
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Team</label>'+
                                    '<select class="form-control" name="role_id" value="">'+
                                    role_options+

                                    '</select>'+
                                   
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Mobile </label>'+
                                    '<input type="text" class="form-control" value="'+member.mobile_no+'" name="mobile_no" required>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Address</label>'+
                                    '<input type="address" class="form-control" value="'+member.address+'" name="address" required>'+
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
                    tinymce.remove("#model-editor");
                    tinymce.init({
                        selector: '#model-editor'
                    });

                    initEditCrop();
                }, 500);
            });
        });

        $(document).on('submit', '#editMemberform', function(event) {
           event.preventDefault();
           var form = $(this);
           edit_cropper.crop();

           var crop_data = edit_cropper.getData();
           var formData = new FormData(form[0]);
           formData.append('image_dimension', JSON.stringify(crop_data));

           $.ajax({
               url: "member/update",
               type: 'POST',
               data: formData,
               cache: false,
                contentType: false,
                processData: false,
               success: function(res) {
                   if (res.status === 1) {
                       var member = res.member;

                        form.closest('.modal').modal('hide');
                        appendCommunityServices(member);
                        toastr.success('Updated.');
                   }
               },
                error: function (request, status, errorThrown) {
                    alert(request.responseText);
                    //toastr.error('asdasdasd.');
                }
           }); 
        });

        $(document).on('click', '.delBtn', function(event) {

            var e = $(this);
            var item = e.closest('tr');
            var memberID = e.closest('tr').attr('data-memberID');

            bootbox.confirm({
                message: "Are you sure you want to delete this Member?",
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
                        var url = 'member/delete/'+memberID;

                        $.ajax({
                            url: url,
                            type: 'get',
                            async: false,
                            success: function(res) {
                                if (res.status === 1) {
                                    item.remove();
                                    toastr.success('The Member has been deleted.');
                                } else {
                                    toastr.error('Something went wrong. Please try again.');
                                }
                            }
                        });
                    }
                }
            });
        });

        $(document).on('click', '.detailbtn', function (event) {
            var e = $(this);
            var teamids = getallteams();
            var dialog = bootbox.dialog({
                title: "Detail",
                message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
            });

            dialog.init(function () {
                setTimeout(function () {
                    var memberID = e.closest('tr').attr('data-memberID');
                    var url = 'member/' + memberID + '/edit';

                    var member = "";
                    $.ajax({
                        url: url,
                        type: 'get',
                        async: false,
                        success: function (res) {
                            member = res.member;
                        }
                    });
                    
                    index = teamids.findIndex(x => x.id ===parseInt(member.team_id));
                    if(member.role_id===1){
                        rolename="Team Supervisor"
                    }else{
                        rolename="Team Member"
                    }
                    teamname=teamids[index]['team_name'];
                    if(member.image_name==='no_image'){
                        var image_url = "<?php echo asset('/') . '/storage/Members/no_image.png'; ?>"
                    }else{
                        var image_url = "<?php echo asset('/') . '/storage/Members/'; ?>" +
                        member.id + "/" + member.image_name;
                    }
                    

                    var html =
                        '<form action="" id="" class="horizontal-form"' +
                        '{{ csrf_field() }}' +
                        '<div class="modal-body">' +
                        '<div class="form-body">' +
                        '<div class="row">' +
                        '<div class="col-md-12">' +
                        '<div class="form-group">' +
                                           
                        '<div>' +
                        '<img  src="' + image_url +
                        '"  style="width: 100%; height: auto;">' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="col-md-12">' +
                        '<div class="form-group">' +
                        '<label class="control-label">Full Name</label>' +
                        '<input type="text" class="form-control" value="'+ member
                        .name + '" name="name" required readonly>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +

                        '<div class="row">' +
                        '<div class="col-md-12">' +
                        '<div class="form-group">' +
                        '<label class="control-label">Email</label>' +
                        '<input type="text" class="form-control" value="'+ member
                        .email + '" name="name" required readonly>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +

                        '<div class="row">' +
                        '<div class="col-md-12">' +
                        '<div class="form-group">' +
                        '<label class="control-label">Team</label>' +
                        '<input type="text" class="form-control" value="' + teamname + '"  required readonly>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="col-md-12">' +
                        '<div class="form-group">' +
                        '<label class="control-label">Role</label>' +
                        '<input type="text" class="form-control" value="' + rolename + '"  required readonly>' +

                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="col-md-12">' +
                        '<div class="form-group">' +
                        '<label class="control-label">Phone No.</label>' +
                        '<input type="text" class="form-control" value="' + member
                        .mobile_no + '" name="mobile_no" required readonly>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="col-md-12">' +
                        '<div class="form-group">' +
                        '<label class="control-label">Address</label>' +
                        '<input type="address" class="form-control" value="' + member
                        .address + '" name="address" required readonly>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '<div class="modal-footer">' +
                        '<button type="button" class="btn dark btn-outline" data-dismiss="modal">Cancel</button>' +
                        '</div>' +
                        '</form>';
                    dialog.find('.bootbox-body').html(html);
                    tinymce.remove("#model-editor");
                    tinymce.init({
                        selector: '#model-editor'
                    });

                }, 500);
            });
        });

    });

    </script>
@endsection
