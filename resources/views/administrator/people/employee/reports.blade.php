@extends('administrator.master')
@section('title', 'Team')

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            EMPLOYEES REPORT
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a>People</a></li>
            <li class="active">Team</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            
            <div class="box-body">
               
             
               
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
                    @endif
                </div>


                <div class="col-md-12">
                       <form action="{{ url('people/employees/report-selector') }}" method="post" name="employee_add_form" enctype="multipart/form-data">
                           {{ csrf_field() }}
                          <div class="col-md-4">

                             <label for="datepicker4">Joining Date From<span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }} has-feedback">
                                <div class="input-group date">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="text" name="start_date" value="" class="form-control pull-right" id="datepicker4" placeholder="yyyy-mm-dd">
                                </div>
                                @if ($errors->has('start_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('start_date') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->
                          </div>

                           <div class="col-md-4">

                             <label for="datepicker3">Joining Date To<span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }} has-feedback">
                                <div class="input-group date">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="text" name="end_date" value="" class="form-control pull-right" id="datepicker3" placeholder="yyyy-mm-dd">
                                </div>
                                @if ($errors->has('end_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('end_date') }}</strong>
                                </span>
                                @endif
                            </div>

                            <!-- /.form-group -->
                          </div>
                             <div class="col-md-4">
                               <label for="gender">Report Format <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }} has-feedback">
                                <select name="format" id="gender" class="form-control">
                                    <option value="p">PDF</option>
                                    <option value="e">Excel</option>
                                </select>
                                @if ($errors->has('gender'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                           <div class="box-footer">
                   
                    <button type="submit" class="btn btn-primary btn-flat"><i class="icon fa fa-check"></i> Submit</button>
                </div>
                         </form>
                </div>
                <!-- /.Notification Box -->
                         </div>
        
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
@endsection