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
            <span>Add Admin</span>
        </li>
    </ul>

</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->

<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<!-- BEGIN DASHBOARD STATS 1-->



<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-red"></i>
                    <span class="caption-subject font-red sbold uppercase">Add Admin</span>
                </div>
            </div>
            <div class="portlet-body">
                <form action="" id="addadmin" class="horizontal-form">
                    {{ csrf_field() }}
                    <div class="container bootstrap snippets bootdey">
                        <div class="form-body">    
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label class="control-label">First Name</label>
                                        <input type="text" class="form-control" name="fname" id="fname" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label class="control-label">Last Name</label>
                                        <input type="text" class="form-control" name="lname" id="lname" required>
                                    </div>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label class="control-label">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" required>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                    <div class="form-group" style="padding-left: 30%">
                        <button type="submit" class="btn green mx-sm-3 mb-2"><span class="ladda-label">Add User</span></button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- <div class="clearfix"></div> -->

<!-- add slider modal -->

@endsection
@section ('page-scripts')
<script type="text/javascript">
    $(function () {
        $("#addadmin").on('submit', function (event) {
            event.preventDefault();
            var form = $(this);
            var formData = new FormData(form[0]);
            // console.log(content);
            //console.log(formData.fname);
            $.ajax({
                url: "store",
                type: 'GET',
                data: $('#addadmin').serialize(),
                cache: false,
                contentType: false,
                processData: false,
                success: function (res) {
                    if (res.status === 1) {
                        form[0].reset();
                        toastr.success(res.admin.fname+' Added!');
                    }
                    if (res.emailexists === 1) {
                        toastr.error('Email Address already Exists.');
                    }
                },
                error: function (request, status, errorThrown) {
                    toastr.error(request.responseText);
                    //toastr.error('asdasdasd.');
                }
                
            });
        });
    });
</script>
@endsection

