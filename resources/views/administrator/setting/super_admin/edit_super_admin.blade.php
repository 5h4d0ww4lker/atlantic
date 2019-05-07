@extends('administrator.master')
@section('title', 'Edit Super Admin')

@section('main_content')
<style type="text/css">
.pro {
    position: relative;
    float: left;
    width:  170px;
    height: 150px;
    background-position: 50% 50%;
    background-repeat:   no-repeat;
    background-size:     cover;
}

</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            SUPER ADMIN
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ url('/super_admin/super_admins') }}">Team</a></li>
            <li class="active">Edit Super Admin details</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Super Admin details</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <form action="{{ url('setting/super_admins/update/'.$super_admin['id']) }}" method="post" name="super_admin_edit_form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="row">
                        <!-- Notification Box -->
                        <div class="col-md-12">
                            @if (!empty(Session::get('message')))
                            <div class="alert alert-success alert-dismissible" id="notification_box">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <i class="icon fa fa-check"></i> {{ Session::get('message') }}
                            </div>
                            @elseif (!empty(Session::get('exception')))
                            <div class="alert alert-warning alert-dismissible" id="notification_box">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <i class="icon fa fa-warning"></i> {{ Session::get('exception') }}
                            </div>
                            @else
                            <p class="text-yellow">Enter Super Admin details. All (*)field are required. (Default password for added user is 12345678)</p>
                            @endif
                        </div>
                        <!-- /.Notification Box -->

                        <div class="col-md-6">
                         

                            <label for="name">Name <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="name" id="name" class="form-control" value="{{ $super_admin['name'] }}" placeholder="Enter name..">
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->

                            <label for="father_name">Father's Name</label>
                            <div class="form-group{{ $errors->has('father_name') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="father_name" id="father_name" class="form-control" value="{{ $super_admin['father_name'] }}" placeholder="Enter father's name..">
                                @if ($errors->has('father_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('father_name') }}</strong>
                                </span>
                                @endif
                            </div>


                            <label for="grand_father_name">Grand Father's Name</label>
                            <div class="form-group{{ $errors->has('father_name') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="grand_father_name" id="grand_father_name" class="form-control" value="{{ $super_admin['grand_father_name'] }}" placeholder="Enter grand father's name..">
                                @if ($errors->has('grand_father_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('gradn_father_name') }}</strong>
                                </span>
                                @endif
                            </div>
                          
                             <label for="gender">Gender <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }} has-feedback">
                                <select name="gender" id="gender" class="form-control">
                                    <option value="" selected disabled>Select one</option>
                                    <option value="m">Male</option>
                                    <option value="f">Female</option>
                                </select>
                                @if ($errors->has('gender'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->

                           

                            <label for="email">Email <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="email" id="email" class="form-control" value="{{ $super_admin['email'] }}" placeholder="Enter email address..">
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->

                            <label for="contact_no_one">Contact No<span class="text-danger">*</span>(Format: +251-911-123456)</label>
                            <div class="form-group{{ $errors->has('contact_no_one') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="contact_no_one" pattern="(\+[0-9]{3}-[0-9]{3}-[0-9]{6})" id="contact_no_one" class="form-control" value="{{ $super_admin['contact_no_one'] }}" placeholder="Enter contact no..">
                                @if ($errors->has('contact_no_one'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('contact_no_one') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->

                          
                          




                        </div>
                        <!-- /.col -->

                        <div class="col-md-6">
                           
                            <!-- /.form-group -->

                          
                         
                           
                       

                           
                           
                            <!-- /.form-group -->
                           

                           
                            <!-- /.form-group -->
                             

                             <label for="profile_picture">Profile Picture <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('profile_picture') ? ' has-error' : '' }} has-feedback">
                                <input type="file" name="profile_picture" id="profile_picture" class="form-control">
                                <input type="hidden" name="profile_picture" value="">
                                @if ($errors->has('profile_picture'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('profile_picture') }}</strong>
                                </span>
                                @endif

                             @if(!empty($super_admin['profile_picture']))
                            <img src="{{ url('/public/profile_picture/' . $super_admin['profile_picture']) }}" alt="$super_admin['profile_picture']" class="img-responsive img-thumbnail" width="200px" height="100px">
                            @else
                            <img src="{{ url('/public/profile_picture/blank_profile_picture.png') }}" alt="blank_profile_picture" class="img-responsive img-thumbnail" width="250px">
                            @endif
                            </div>
                        </div>
                 
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{ url('/super_admin/super_admins') }}" class="btn btn-danger btn-flat"><i class="icon fa fa-close"></i> Cancel</a>
                        <button type="submit" class="btn btn-primary btn-flat"><i class="icon fa fa-plus"></i> Update</button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
    <script type="text/javascript">

    $('#department_id').on('change', function(e){
        console.log(e);
        var department_id = e.target.value;
 
        $.get('{{ url('information') }}/create/ajax-state?department_id=' + department_id, function(data) {
            console.log(data);
            $('#designation_id').empty();
            $.each(data, function(index,subCatObj){
              
                $('#designation_id').append('<option value="'+subCatObj.id+'" selected>'+subCatObj.designation+'</option>');
                console.log("Found");
                console.log(subCatObj.designation);
            });
        });
    });
</script>

    <script type="text/javascript">
        document.forms['super_admin_edit_form'].elements['gender'].value = "{{ $super_admin['gender'] }}";
      
        document.forms['super_admin_edit_form'].elements['marital_status'].value = "{{ $super_admin['marital_status'] }}";
             document.forms['super_admin_edit_form'].elements['role'].value = "{{ $super_admin['role'] }}";
        document.forms['super_admin_edit_form'].elements['joining_position'].value = "{{ $super_admin['joining_position'] }}";
    </script>
    @endsection
