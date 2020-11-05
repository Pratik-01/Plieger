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
        <a href="{{url('/admin/member')}}">Member</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Member Detail</span>
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
                    @if(isset($member) && !empty($member))
                    @if($member->image_name==='no_image')
                         <?php $image_url = asset('/') . '/storage/Members/no_image.png' ?>
                    @else
                        <?php $image_url =  asset('/') . '/storage/Members/'.$member->id."/".$member->image_name ?>
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
                                                        {{$member->id}}
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
                                                        {{$member->name}}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <strong>
                                                            <span
                                                                class="glyphicon glyphicon-text-width text-primary"></span>
                                                            Team
                                                        </strong>
                                                    </td>
                                                    <td class="text-primary">
                                                        {{$team_name}}
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
                                                        @if($member['role_id'] == 1)
                                                        {{'Team Supervisor'}}
                                                        @elseif($member['role_id'] == 2)
                                                        {{'Team Member'}}
                                                        @else
                                                        {{'Team Leader'}}
                                                        @endif
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
                                                        {{$member->mobile_no}}
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
                                                        {{$member->email}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>
                                                            <span
                                                                class="glyphicon glyphicon-home text-primary"></span>
                                                            Address
                                                        </strong>
                                                    </td>
                                                    <td class="text-primary">
                                                        {{$member->address}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>
                                                            <span
                                                                class="glyphicon glyphicon-ok text-primary"></span>
                                                            Total Assigned Task
                                                        </strong>
                                                    </td>
                                                    <td class="text-primary">
                                                        {{$task_assigned}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>
                                                            <span
                                                                class="glyphicon glyphicon-ok text-primary"></span>
                                                            Total Reviewed Task
                                                        </strong>
                                                    </td>
                                                    <td class="text-primary">
                                                        {{$total_review}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>
                                                            <span
                                                                class="glyphicon glyphicon-unchecked text-primary"></span>
                                                            Total Task Remaining
                                                        </strong>
                                                    </td>
                                                    <td class="text-primary">
                                                        {{$total_review}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>
                                                            <span
                                                                class="glyphicon glyphicon-book text-primary"></span>
                                                            Total Reviewes Remaining
                                                        </strong>
                                                    </td>
                                                    <td class="text-primary">
                                                        {{$total_review}}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
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