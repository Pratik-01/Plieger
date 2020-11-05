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
            <span>Change Password</span>
        </li>
    </ul>
    
</div>
<h1 class="page-title">Change Password
    <!-- <small>front end banners</small> -->
</h1>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="portlet light" >
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-key"></i>
                        <span class="caption-subject font-black sbold uppercase">New Password</span>
                    </div>
                </div>
                <div class="portlet-body" style="padding-left: 10%">
                    <form method="GET" action="{{ route('member.changepass') }}">
                        @foreach ($errors->all() as $error)
                            <p class="text-danger">{{ $error }}</p>
                         @endforeach 
  
                        <div class="form-group row" id='old_pwd'>
                            <label for="password" class="col-md-3 col-form-label text-md-right">Current Password</label>
  
                            <div class="col-md-4">
                                <input id="password" type="password" class="form-control" name="current_password">
                            </div>
                            <div class="col-md-1">
                                <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                            </div>
                        </div>
  
                        <div class="form-group row" id='new_pwd'>
                            <label for="password" class="col-md-3 col-form-label text-md-right">New Password</label>
  
                            <div class="col-md-4">
                                <input id="new_password" type="password" class="form-control" name="new_password">
                            </div>
                            <div class="col-md-1">
                                <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                            </div>
                        </div>
  
                        <div class="form-group row" id='new_confirm'>
                            <label for="password" class="col-md-3 col-form-label text-md-right">New Confirm Password</label>
    
                            <div class="col-md-4">
                                <input id="new_confirm_password" type="password"  class="form-control" name="new_confirm_password">
                            </div>
                            <div class="col-md-1">
                                <a href=""><i class="fa fa-eye-slash" aria-hidden="false"></i></a>
                            </div>
                        </div>
   
                        <div class="form-group row mb-0" style="padding-left: 20%">
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">
                                    Update Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section ('page-scripts')
@if(session()->has('message'))
    <script type="text/javascript">
        toastr.success("{{ Session::get('message') }}");
    </script>
@endif
<script>
    $(document).ready(function() {
        $("#new_confirm a").on('click', function(event) {
            event.preventDefault();
            if($('#new_confirm input').attr("type") == "text"){
                $('#new_confirm input').attr('type', 'password');
                $('#new_confirm i').addClass( "fa-eye-slash" );
                $('#new_confirm i').removeClass( "fa-eye" );
            }else if($('#new_confirm input').attr("type") == "password"){
                $('#new_confirm input').attr('type', 'text');
                $('#new_confirm i').removeClass( "fa-eye-slash" );
                $('#new_confirm i').addClass( "fa-eye" );
            }
        });
        $("#new_pwd a").on('click', function(event) {
            event.preventDefault();
            if($('#new_pwd input').attr("type") == "text"){
                $('#new_pwd input').attr('type', 'password');
                $('#new_pwd i').addClass( "fa-eye-slash" );
                $('#new_pwd i').removeClass( "fa-eye" );
            }else if($('#new_pwd input').attr("type") == "password"){
                $('#new_pwd input').attr('type', 'text');
                $('#new_pwd i').removeClass( "fa-eye-slash" );
                $('#new_pwd i').addClass( "fa-eye" );
            }
        });
        $("#old_pwd a").on('click', function(event) {
            event.preventDefault();
            if($('#old_pwd input').attr("type") == "text"){
                $('#old_pwd input').attr('type', 'password');
                $('#old_pwd i').addClass( "fa-eye-slash" );
                $('#new_confirm i').removeClass( "fa-eye" );
            }else if($('#old_pwd input').attr("type") == "password"){
                $('#old_pwd input').attr('type', 'text');
                $('#old_pwd i').removeClass( "fa-eye-slash" );
                $('#old_pwd i').addClass( "fa-eye" );
            }
        });
    });
</script>

@endsection