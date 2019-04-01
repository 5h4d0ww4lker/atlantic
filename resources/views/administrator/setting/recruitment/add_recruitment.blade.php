@extends('administrator.master')
@section('title', 'Recruitments')

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            RECRUITMENT
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a>Setting</a></li>
            <li><a href="{{ url('/setting/recruitments') }}">Recruitments</a></li>
            <li class="active">Add Recruitment</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Add Recruitment</h3>

              
            </div>
            <!-- /.box-header -->
            <form action="{{ url('setting/recruitments/store') }}" method="post" name="recruitment_add_form" enctype="multipart/form-data">
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
                                <p class="text-yellow">Enter recruitment details. All field are required. </p>
                            @endif
                        </div>
                        <!-- /.Notification Box -->

                        <div class="col-md-6">
                            <label for="first_name">First Name <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('recruitment') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') }}" placeholder="Enter first name..">
                                @if ($errors->has('recruitment_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('recruitment_name') }}</strong>
                                </span>
                                @endif
                            </div>


                            <label for="last_name">Last Name <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name') }}" placeholder="Enter last name..">
                                @if ($errors->has('recruitment_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('recruitment_name') }}</strong>
                                </span>
                                @endif
                            </div>



                             <label for="experience">Experience <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('experience') ? ' has-error' : '' }} has-feedback">
                                <textarea class="textarea" name="experience" id="experience" placeholder="Enter Experience.." style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('experience') }}</textarea>
                                @if ($errors->has('experience'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('experience') }}</strong>
                                </span>
                                @endif
                            </div>


                            <!-- /.form-group -->
                        </div>
                        <div class="col-md-6">
                        
                           
                            <label for="point">Point <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('point') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="point" id="point" class="form-control" value="{{ old('point') }}" placeholder="Enter point..">
                                @if ($errors->has('point'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('point') }}</strong>
                                </span>
                                @endif
                            </div>

                            
                           


                             <label for="status">Status <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }} has-feedback">
                                <select name="status" id="status" class="form-control">
                                    <option value="Short Listed">Short Listed</option>
                                    <option value="Finalist">Finalist</option>
                                      <option value="Hired">Hired</option>

                                    
                                </select>
                                @if ($errors->has('status'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                                @endif
                            </div>

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

                             <label for="qualification">Qualification <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('qualification') ? ' has-error' : '' }} has-feedback">
                                <textarea class="textarea" name="qualification" id="qualification" placeholder="Enter qualification.." style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('qualification') }}</textarea>
                                @if ($errors->has('qualification'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('qualification') }}</strong>
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
                    <a href="{{ url('/setting/recruitments') }}" class="btn btn-danger btn-flat"><i class="icon fa fa-close"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary btn-flat"><i class="icon fa fa-plus"></i> Add recruitment</button>
                </div>
            </form>
        </div>
        <!-- /.box -->


    </section>
    <!-- /.content -->
</div>
<script type="text/javascript">
    document.forms['recruitment_add_form'].elements['recruitment_description'].value = "{{ old('recruitment_description') }}";
</script>
@endsection
