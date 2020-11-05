@extends ('layouts.teamleader_layout')

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
            <span>User Detail</span>
        </li>
    </ul>

</div>

<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-info"></i>
                        <span class="caption-subject font-black sbold uppercase">User Detail</span>
                    </div>
                </div>
                <div class="portlet-body">
                    @if(isset($admin) && !empty($admin))
                    @if($admin->image_name==='no_image')
                         <?php $image_url = asset('/') . '/storage/Members/no_image.png' ?>
                    @else
                        <?php $image_url =  asset('/') . '/storage/Members/'.$admin->id."/".$admin->image_name ?>
                    @endif
                    <div class="container bootstrap snippets bootdey">
                        <div class="panel-body inf-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <img alt="" style="width:600px;" title="" class="img-circle img-thumbnail isTooltip"
                                src="{{$image_url}}"
                                        data-original-title="Usuario">
                                    <ul title="Ratings" class="list-inline ratings text-center">
                                        <li><a href="#"><span class="glyphicon glyphicon-star"></span></a></li>
                                        <li><a href="#"><span class="glyphicon glyphicon-star"></span></a></li>
                                        <li><a href="#"><span class="glyphicon glyphicon-star"></span></a></li>
                                        <li><a href="#"><span class="glyphicon glyphicon-star"></span></a></li>
                                        <li><a href="#"><span class="glyphicon glyphicon-star"></span></a></li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <strong>Information</strong><br>
                                    <div class="table-responsive">
                                        <table class="table table-user-information">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <strong>
                                                            <span
                                                                class="glyphicon glyphicon-asterisk text-primary"></span>
                                                            Identificacion
                                                        </strong>
                                                    </td>
                                                    <td class="text-primary">
                                                        {{$admin->id}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>
                                                            <span class="glyphicon glyphicon-user  text-primary"></span>
                                                            Name
                                                        </strong>
                                                    </td>
                                                    <td class="text-primary">
                                                        {{$admin->name}}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <strong>
                                                            <span
                                                                class="glyphicon glyphicon-bookmark text-primary"></span>
                                                            Status
                                                        </strong>
                                                    </td>
                                                    <td class="text-primary">
                                                        {{$admin->status}}
                                                    </td>
                                                </tr>


                                                <tr>
                                                    <td>
                                                        <strong>
                                                            <span
                                                                class="glyphicon glyphicon-eye-open text-primary"></span>
                                                            Role
                                                        </strong>
                                                    </td>
                                                    <td class="text-primary">
                                                        {{$admin->role_id}}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <strong>
                                                            <span
                                                                class="glyphicon glyphicon-phone text-primary"></span>
                                                            Phone
                                                        </strong>
                                                    </td>
                                                    <td class="text-primary">
                                                        {{$admin->mobile_no}}
                                                    </td>
                                                </tr>


                                                <tr>
                                                    <td>
                                                        <strong>
                                                            <span
                                                                class="glyphicon glyphicon-envelope text-primary"></span>
                                                            Email
                                                        </strong>
                                                    </td>
                                                    <td class="text-primary">
                                                        {{$admin->email}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>
                                                            <span
                                                                class="glyphicon glyphicon-calendar text-primary"></span>
                                                            created
                                                        </strong>
                                                    </td>
                                                    <td class="text-primary">
                                                        {{$admin->created_at}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>
                                                            <span
                                                                class="glyphicon glyphicon-calendar text-primary"></span>
                                                            Modified
                                                        </strong>
                                                    </td>
                                                    <td class="text-primary">
                                                        {{$admin->updated_at}}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="display: flex;align-items: center;justify-content: center;">
                        <a href="#basic" data-toggle="modal" class="btn btn-sm green pull-right">Edit</a>
                    </div>

                    @else
                    <div id="sliderContainer" class="col-md-12 empty_elem_tag">
                        Error
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
                <h4 class="modal-title">Update Profile</h4>
            </div>
            <form action="" id="edituser" class="horizontal-form">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">First Name</label>
                                    <input type="text" class="form-control" name="name"  id="name" value="{{$admin->name}}"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Mobile</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile" value="{{$admin->mobile_no}}"
                                        required>
                                </div>
                            </div>
                        </div>
                        

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{$admin->email}}"
                                        required>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn green ladda-button" data-style="expand-left"><span
                            class="ladda-label">Submit</span></button>
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
    $(function () {
        function appendCommunityServices(admin) {
            console.log(admin);
            location.reload();
        }
        $("#edituser").on('submit', function (event) {
            event.preventDefault();
            var form = $(this);
            var formData = new FormData(form[0]);
            // console.log(content);
            //console.log(formData.fname);
            $.ajax({
                url: "update",
                type: 'GET',
                data: $('#edituser').serialize(),
                cache: false,
                contentType: false,
                processData: false,
                success: function (res) {
                    if (res.status === 1) {
                        var admin = res.admin;
                        form.closest('.modal').modal('hide');
                        appendCommunityServices(admin);
                        form[0].reset();
                        toastr.success('Profile Updated!');
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