@extends('administrator.master')
@section('title', 'Add team member')

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            TEAM
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ url('/people/employees') }}">Team</a></li>
            <li class="active">Add team member</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Add team member</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <form action="{{ url('people/employees/store') }}" method="post" name="employee_add_form" enctype="multipart/form-data">
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
                            <p class="text-yellow">Enter team member details. All (*)field are required. (Default password for added user is 12345678)</p>
                            @endif
                        </div>
                        <!-- /.Notification Box -->

                        <div class="col-md-6">
                         

                            <label for="name">First Name <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="Enter name..">
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->

                            <label for="father_name">Father's Name</label>
                            <div class="form-group{{ $errors->has('father_name') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="father_name" id="father_name" class="form-control" value="{{ old('father_name') }}" placeholder="Enter father's name..">
                                @if ($errors->has('father_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('father_name') }}</strong>
                                </span>
                                @endif
                            </div>

                             <label for="grand_father_name">Grand Father's Name</label>
                            <div class="form-group{{ $errors->has('father_name') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="grand_father_name" id="grand_father_name" class="form-control" value="{{ old('grand_father_name') }}" placeholder="Enter grand father's name..">
                                @if ($errors->has('grand_father_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('grand_father_name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->

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
                          
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Enter email address..">
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->

                            <label for="contact_no_one">Contact No <span class="text-info">(Format: +251-911-123456)</span><span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('contact_no_one') ? ' has-error' : '' }} has-feedback">
                                <input type="tel" name="contact_no_one" pattern="(\+[0-9]{3}-[0-9]{3}-[0-9]{6})" id="contact_no_one" class="form-control" value="{{ old('contact_no_one') }}" placeholder="Enter contact no..">
                                @if ($errors->has('contact_no_one'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('contact_no_one') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->

                                <label for="emergency_contact">Emergency Contact <span class="text-info">(Format: +251-911-123456)</span><span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('emergency_contact') ? ' has-error' : '' }} has-feedback">
                                <input type="tel" name="emergency_contact" pattern="(\+[0-9]{3}-[0-9]{3}-[0-9]{6})" id="emergency_contact" class="form-control" value="{{ old('emergency_contact') }}" placeholder="Enter emergency contact no..">
                                @if ($errors->has('emergency_contact'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('emergency_contact') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label for="tin">TIN No</label>
                            <div class="form-group{{ $errors->has('tin') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="tin" id="tin" class="form-control" value="{{ old('tin') }}" placeholder="Enter tin no..">
                                @if ($errors->has('tin'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tin') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->

                           
                            <label for="datepicker4">Joining Date<span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('joining_date') ? ' has-error' : '' }} has-feedback">
                                <div class="input-group date">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="text" name="joining_date" class="form-control pull-right" id="datepicker4" placeholder="yyyy-mm-dd">
                                </div>
                                @if ($errors->has('joining_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('joining_date') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->

                            <!-- /.form-group -->
                             <label for="cv">CV<span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('cv') ? ' has-error' : '' }} has-feedback">
                                <input type="file" name="cv" id="cv" class="form-control">
                                <input type="hidden" name="cv" value="">
                                @if ($errors->has('cv'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cv') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                        <div class="col-md-6">

                         
                            <!-- /.form-group -->

                          <!--   <label for="web">Web</label>
                            <div class="form-group{{ $errors->has('web') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="web" id="web" class="form-control" value="{{ old('web') }}" placeholder="Enter web..">
                                @if ($errors->has('web'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('web') }}</strong>
                                </span>
                                @endif
                            </div> -->
                            <!-- /.form-group -->

                           
                            <!-- /.form-group -->

                           <!--  <label for="present_address">Present Address<span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('present_address') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="present_address" id="present_address" class="form-control" value="{{ old('present_address') }}" placeholder="Enter present address..">
                                @if ($errors->has('present_address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('present_address') }}</strong>
                                </span>
                                @endif
                            </div> -->
                            <!-- /.form-group -->

                           <!--  <label for="permanent_address">Permanent Address</label>
                            <div class="form-group{{ $errors->has('permanent_address') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="permanent_address" id="permanent_address" class="form-control" value="{{ old('permanent_address') }}" placeholder="Enter permanent address..">
                                @if ($errors->has('permanent_address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('permanent_address') }}</strong>
                                </span>
                                @endif
                            </div> -->
                            <!-- /.form-group -->

                            <!-- <label for="home_district">Home District</label>
                            <div class="form-group{{ $errors->has('home_district') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="home_district" id="home_district" class="form-control" value="{{ old('home_district') }}" placeholder="Enter home district..">
                                @if ($errors->has('home_district'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('home_district') }}</strong>
                                </span>
                                @endif
                            </div> -->
                            <!-- form-group -->

                           <!--  <label for="id_name">ID Name</label>
                            <div class="form-group{{ $errors->has('id_name') ? ' has-error' : '' }} has-feedback">
                                <select name="id_name" id="id_name" class="form-control">
                                    <option value="" selected disabled>Select one</option>
                                    <option value="1">NID</option>
                                    <option value="2">Passport</option>
                                    <option value="3">Driving License</option>
                                </select>
                                @if ($errors->has('id_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('id_name') }}</strong>
                                </span>
                                @endif
                            </div> -->
                            <!-- /.form-group -->

                          <!--   <label for="id_number">ID Number</label>
                            <div class="form-group{{ $errors->has('id_number') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="id_number" id="id_number" class="form-control" value="{{ old('id_number') }}" placeholder="Enter id number..">
                                @if ($errors->has('id_number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('id_number') }}</strong>
                                </span>
                                @endif
                            </div> -->
                            <!-- /.form-group -->

                              <label for="branch_id">Branch <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('branch_id') ? ' has-error' : '' }} has-feedback">
                                <select name="branch_id" id="branch_id" class="form-control">
                                    <option value="" selected disabled>Select one</option>
                                    @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->branch }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('branch_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('branch_id') }}</strong>
                                </span>
                                @endif
                            </div>

                             <label for="department_id">Department <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('department_id') ? ' has-error' : '' }} has-feedback">
                                <select name="department_id" id="department_id" class="form-control">
                                    <option value="" selected disabled>Select one</option>
                                    @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->department }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('department_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('department_id') }}</strong>
                                </span>
                                @endif
                            </div>


                             <label for="designation_id">Designation <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('designation_id') ? ' has-error' : '' }} has-feedback">
                                <select name="designation_id" id="designation_id" class="form-control">
                                    <option></option>
                                   
                                </select>
                                @if ($errors->has('designation_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('designation_id') }}</strong>
                                </span>
                                @endif
                            </div>

<!-- <div class="form-group">
    <label>City
        <select id="designation_id" class="form-control input-sm" name="designation_id">
            <option value=""></option>
       </select>
    </label>
</div> -->
                           
                            <!-- /.form-group -->

                            <label for="joining_position">Joining Position <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('joining_position') ? ' has-error' : '' }} has-feedback">
                                <select name="joining_position" id="joining_position" class="form-control">
                                    <option value="" selected disabled>Select one</option>
                                    @foreach($designations as $designation)
                                    <option value="{{ $designation['id'] }}">{{ $designation['designation'] }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('joining_position'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('joining_position') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->

                            <label for="marital_status">Marital Status </label>
                            <div class="form-group{{ $errors->has('marital_status') ? ' has-error' : '' }} has-feedback">
                                <select name="marital_status" id="marital_status" class="form-control">
                                    <option value="" selected disabled>Select one</option>
                                    <option value="1">Married</option>
                                    <option value="2">Single</option>
                                    <option value="3">Divorced</option>
                                    <option value="4">Separated</option>
                                    <option value="5">Widowed</option>
                                </select>
                                @if ($errors->has('marital_status'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('marital_status') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->
                            <label for="datepicker">Date of Birth</label>
                            <div class="form-group{{ $errors->has('date_of_birth') ? ' has-error' : '' }} has-feedback">
                                <div class="input-group date">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="text" name="date_of_birth" class="form-control pull-right" value="{{ old('date_of_birth') }}" id="datepicker">
                                </div>
                                @if ($errors->has('date_of_birth'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('date_of_birth') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->

                            <label for="role">Role<span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }} has-feedback">
                                <select name="role" id="role" class="form-control">
                                    <option value="" selected disabled>Select one</option>
                                    @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('role'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('role') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->

                              <label for="employement_status">Employement Status </label>
                            <div class="form-group{{ $errors->has('marital_status') ? ' has-error' : '' }} has-feedback">
                                <select name="employement_status" id="employement_status" class="form-control">
                                    <option value="" selected disabled>Select one</option>
                                    <option value="Active">Active</option>
                                    <option value="Suspended">Suspended</option>
                                    <option value="Left">Left</option>
                                    <option value="Retired">Retired</option>
                                    <option value="Retired">Fired</option>
                                </select>
                                @if ($errors->has('employement_status'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('employement_status') }}</strong>
                                </span>
                                @endif
                            </div>
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
                            </div>

                           

                        </div>
                        <!-- /.col -->
                        <div class="col-md-12">

                             <label for="present_address">Present Address</label>
                            <div class="form-group{{ $errors->has('present_address') ? ' has-error' : '' }} has-feedback">
                                <textarea name="present_address" id="present_address" class="form-control textarea" placeholder="Enter present_address..">{{ old('present_address') }}</textarea>
                                @if ($errors->has('present_address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('present_address') }}</strong>
                                </span>
                                @endif
                            </div>

                             <label for="permanent_address">Permanent Address</label>
                            <div class="form-group{{ $errors->has('permanent_address') ? ' has-error' : '' }} has-feedback">
                                <textarea name="permanent_address" id="permanent_address" class="form-control textarea" placeholder="Enter permanent_address..">{{ old('permanent_address') }}</textarea>
                                @if ($errors->has('academic_qualification'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('permanent_address') }}</strong>
                                </span>
                                @endif
                            </div>


                            <label for="academic_qualification">Academic Qualification</label>
                            <div class="form-group{{ $errors->has('academic_qualification') ? ' has-error' : '' }} has-feedback">
                                <textarea name="academic_qualification" id="academic_qualification" class="form-control textarea" placeholder="Enter academic qualification..">{{ old('academic_qualification') }}</textarea>
                                @if ($errors->has('academic_qualification'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('academic_qualification') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->

                            <label for="professional_qualification">Professional Qualification</label>
                            <div class="form-group{{ $errors->has('professional_qualification') ? ' has-error' : '' }} has-feedback">
                                <textarea name="professional_qualification" id="professional_qualification" class="form-control textarea" placeholder="Enter professional qualification..">{{ old('professional_qualification') }}</textarea>
                                @if ($errors->has('professional_qualification'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('professional_qualification') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->

                            <label for="experience">Experience</label>
                            <div class="form-group{{ $errors->has('experience') ? ' has-error' : '' }} has-feedback">
                                <textarea name="experience" id="experience" class="form-control textarea" placeholder="Enter experience..">{{ old('experience') }}</textarea>
                                @if ($errors->has('experience'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('experience') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->

                         <!--    <label for="reference">Reference</label>
                            <div class="form-group{{ $errors->has('reference') ? ' has-error' : '' }} has-feedback">
                                <textarea name="reference" id="reference" class="form-control textarea" placeholder="Enter reference..">{{ old('reference') }}</textarea>
                                @if ($errors->has('reference'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('reference') }}</strong>
                                </span>
                                @endif
                            </div> -->
                            <!-- /.form-group -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ url('/people/employees') }}" class="btn btn-danger btn-flat"><i class="icon fa fa-close"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary btn-flat"><i class="icon fa fa-plus"></i> Add</button>
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
              
                $('#designation_id').append('<option value="'+subCatObj.id+'">'+subCatObj.designation+'</option>');
                console.log("Found");
                console.log(subCatObj.designation);
            });
        });
    });
</script>


<script type="text/javascript">
    document.forms['employee_add_form'].elements['gender'].value = "{{ old('gender') }}";

   
    document.forms['employee_add_form'].elements['role'].value = "{{ old('role') }}";
    document.forms['employee_add_form'].elements['joining_position'].value = "{{ old('joining_position') }}";
    document.forms['employee_add_form'].elements['marital_status'].value = "{{ old('marital_status') }}";
</script>
@endsection
