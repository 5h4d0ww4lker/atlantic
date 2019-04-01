@extends('administrator.master')
@section('title', 'Trainings')

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            TRAINING
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a>Setting</a></li>
            <li><a href="{{ url('/setting/trainings') }}">Trainings</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Edit training</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <form action="{{ url('/setting/trainings/update/'. $training['id']) }}" method="post" name="training_edit_form">
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
                            @endif
                        </div>
                        <!-- /.Notification Box -->

                        <div class="col-md-6">
                            <label for="title">Title<span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="title" id="title" class="form-control" value="{{ $training['title'] }}" placeholder="Enter title..">
                                @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>

                             <label for="venue">venue<span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('venue') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="venue" id="venue" class="form-control" value="{{ $training['venue'] }}" placeholder="Enter venue..">
                                @if ($errors->has('venue'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('venue') }}</strong>
                                </span>
                                @endif
                            </div>
                             <label for="from_date">From Date<span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('from_date') ? ' has-error' : '' }} has-feedback">
                                <div class="input-group date">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="datetime-local" name="from_date" class="form-control pull-right" value="{{ $training['from_date'] }}" id="datepicker4" placeholder="yyyy-mm-dd">
                                </div>
                                @if ($errors->has('from_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('from_date') }}</strong>
                                </span>
                                @endif
                            </div>

                              <label for="datepicker4">To Date<span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('to_date') ? ' has-error' : '' }} has-feedback">
                                <div class="input-group date">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="datetime-local" name="to_date" class="form-control pull-right" value="{{ $training['to_date'] }}" id="datepicker3" placeholder="yyyy-mm-dd">
                                </div>
                                @if ($errors->has('to_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('to_date') }}</strong>
                                </span>
                                @endif
                            </div>

                           
                      
                       
                            <label for="description">Description <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }} has-feedback">
                                <textarea class="textarea" name="description" id="description" placeholder="Enter training description.." style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $training['description'] }}</textarea>
                                @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
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
                    <a href="{{ url('/setting/trainings') }}" class="btn btn-danger btn-flat"><i class="icon fa fa-close"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary btn-flat"><i class="icon fa fa-edit"></i> Update training</button>
                </div>
            </form>
        </div>
        <!-- /.box -->


    </section>
    <!-- /.content -->
</div>
<script type="text/javascript">
    document.forms['training_edit_form'].elements['description'].value = "{{ $training['description'] }}";
</script>
@endsection
