@extends('administrator.master')
@section('title', 'Add team member')

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            DEPENDENT
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ url('/people/employees') }}">Team</a></li>
            <li class="active">Add Dependent</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Add Dependent</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <form action="{{ url('people/dependents/store') }}" method="post" name="employee_add_form" enctype="multipart/form-data">
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
                            <p class="text-yellow"></p>
                            @endif
                        </div>
                        <!-- /.Notification Box -->
                      <?php
$employees = \App\User::all();
?>
                        <div class="col-md-6">
                              <label for="user_id">Employee <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }} has-feedback">
                                <select name="user_id" id="user_id" class="form-control">
                                    <option value="" selected disabled>Select one</option>
                                    @foreach($employees as $employee)
                                    <option value="{{$employee->id}}">{{$employee->name}}</option>
                                    @endforeach
                                   
                                </select>
                                @if ($errors->has('gender'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->

                           

                             <label for="name">Dependent Name <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('dependent_name') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="dependent_name" id="dependent_name" class="form-control" value="{{ old('dependent_name') }}" placeholder="Enter name..">
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>

                             <label for="phone_number">Phone Number <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number') }}" placeholder="Enter phone..">
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->

                      
                            <!-- /.form-group -->

                           
                            <!-- /.form-group -->

                          

                         
                            <!-- /.form-group -->
                        </div>

                        <div class="col-md-6">
       <label for="relationship">Relationship <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('relationship') ? ' has-error' : '' }} has-feedback">
                                <select name="relationship" id="relationship" class="form-control">
                                    <option value="" selected disabled>Select one</option>
                                    <option value="Mother">Mother</option>
                                    <option value="Father">Father</option>
                                    <option value="Spouse">Spouse</option>
                                    <option value="Children">Children</option>
                                </select>
                                @if ($errors->has('relationship'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('relationship') }}</strong>
                                </span>
                                @endif
                            </div>

                            <!-- /.form-group -->
                             <label for="profile_picture">Picture <span class="text-danger">*</span></label>
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
    document.forms['employee_add_form'].elements['gender'].value = "{{ old('gender') }}";
        document.forms['employee_add_form'].elements['id_name'].value = "{{ old('id_name') }}";
    document.forms['employee_add_form'].elements['designation_id'].value = "{{ old('designation_id') }}";
    document.forms['employee_add_form'].elements['role'].value = "{{ old('role') }}";
    document.forms['employee_add_form'].elements['joining_position'].value = "{{ old('joining_position') }}";
    document.forms['employee_add_form'].elements['marital_status'].value = "{{ old('marital_status') }}";
</script>
@endsection
