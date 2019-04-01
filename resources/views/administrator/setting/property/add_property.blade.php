@extends('administrator.master')
@section('title', 'Properties')

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            PROPERTY
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a>Setting</a></li>
            <li><a href="{{ url('/setting/properties') }}">Properties</a></li>
            <li class="active">Add property</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Add property</h3>

                <div class="box-tools pull-right">
                    <button ty                                                                                              pe="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="butto                                                                                                                                             n" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <form action="{{ url('setting/properties/store') }}" method="post" name="property_add_form">
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
                                <p class="text-yellow">Enter property details. All field are required. </p>
                            @endif
                        </div>
                        <!-- /.Notification Box -->

                        <div class="col-md-6">
                            <label for="property_name">Property <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('property') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="property_name" id="property_name" class="form-control" value="{{ old('property_name') }}" placeholder="Enter property name..">
                                @if ($errors->has('property_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('property_name') }}</strong>
                                </span>
                                @endif
                            </div>

                             <label for="property_identification">Property Identification <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('property_identification') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="property_identification" id="property_identification" class="form-control" value="{{ old('property_identification') }}" placeholder="Enter property Identification..">
                                @if ($errors->has('property_identification'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('property_identification') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->
                            <label for="employee_id">Employee <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('publication_status') ? ' has-error' : '' }} has-feedback">
                                <select name="employee_id" id="employee_id" class="form-control">
                                    <option value="" selected disabled>Select one</option>

                                      @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                    @endforeach
                                    
                                </select>
                                @if ($errors->has('employee_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('employee_id') }}</strong>
                                </span>
                                @endif
                            </div>


                             <label for="status">Status <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }} has-feedback">
                                <select name="status" id="status" class="form-control">
                                    <option value="Not Returned">Not Returned</option>
                                    <option value="Returned">Returned</option>

                                    
                                </select>
                                @if ($errors->has('employee_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('employee_id') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->
                     
                            <label for="property_description">Property Description <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('property_description') ? ' has-error' : '' }} has-feedback">
                                <textarea class="textarea" name="property_description" id="property_description" placeholder="Enter property description.." style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('property_description') }}</textarea>
                                @if ($errors->has('property_description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('property_description') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ url('/setting/properties') }}" class="btn btn-danger btn-flat"><i class="icon fa fa-close"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary btn-flat"><i class="icon fa fa-plus"></i> Add property</button>
                </div>
            </form>
        </div>
        <!-- /.box -->


    </section>
    <!-- /.content -->
</div>
<script type="text/javascript">
    document.forms['property_add_form'].elements['property_description'].value = "{{ old('property_description') }}";
</script>
@endsection
