@extends('administrator.master')
@section('title', 'Update Employee Awards')

@section('main_content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Award Lists
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a>Setting</a></li>
      <li><a href="{{ url('/hrm/employee-awards') }}">Employee Award Lists</a></li>
      <li class="active">Update Employee Awards</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- SELECT2 EXAMPLE -->
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">Update Employee Awards</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <form action="{{ url('/hrm/employee-awards/update/' . $employee_award['id']) }}" method="post" name="employee_award_update_form">
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
              <p class="text-yellow">Update Employee Awards List. All field are required. </p>
              @endif
            </div>
            <!-- /.Notification Box -->

            <div class="col-md-6">

              <label for="employee_id">Employee Name <span class="text-danger">*</span></label>
              <div class="form-group{{ $errors->has('employee_id') ? ' has-error' : '' }} has-feedback">
                <select name="employee_id" id="employee_id" class="form-control">
                  <option value="" selected disabled>Select one</option>
                  @foreach($employees as $employee)
                  <option value="{{ $employee['id'] }}">{{ $employee['name'] }}&nbsp;{{ $employee['father_name'] }}&nbsp;{{ $employee['grand_father_name'] }}</option>
                @endforeach
                </select>
                @if ($errors->has('employee_id'))
                <span class="help-block">
                  <strong>{{ $errors->first('employee_id') }}</strong>
                </span>
                @endif
              </div>
              <!-- /.form-group -->

              <label for="award_category_id">Award Category <span class="text-danger">*</span></label>
              <div class="form-group{{ $errors->has('award_category_id') ? ' has-error' : '' }} has-feedback">
                <select name="award_category_id" id="award_category_id" class="form-control">
                  <option value="" selected disabled>Select one</option>
                  @foreach($award_categorys as $award_category)
                  <option value="{{ $award_category['id'] }}">{{ $award_category['award_title'] }}</option>
                @endforeach
                </select>
                @if ($errors->has('award_category_id'))
                <span class="help-block">
                  <strong>{{ $errors->first('award_category_id') }}</strong>
                </span>
                @endif
              </div>
              <!-- /.form-group -->

              <label for="gift_item">Gift Item <span class="text-danger"></span></label>
              <div class="form-group{{ $errors->has('gift_item') ? ' has-error' : '' }} has-feedback">
                <input type="text" name="gift_item" id="gift_item" class="form-control" value="{{ $employee_award['gift_item'] }}" placeholder="Enter Gift Item..">
                @if ($errors->has('gift_item'))
                <span class="help-block">
                  <strong>{{ $errors->first('gift_item') }}</strong>
                </span>
                @endif
              </div>
              <!-- /.form-group -->



              <div class="form-group">
                <label>Select Month: <span class="text-danger">*</span></label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="select_month" value="{{ $employee_award['select_month'] }}" class="form-control pull-right" id="datepicker">
                </div>
                <!-- /.input group -->
              </div>

              <label for="publication_status">Publication Status <span class="text-danger">*</span></label>
              <div class="form-group{{ $errors->has('publication_status') ? ' has-error' : '' }} has-feedback">
                <select name="publication_status" id="publication_status" class="form-control">
                  <option value="" selected disabled>Select one</option>
                  <option value="1">Published</option>
                  <option value="0">Unpublished</option>
                </select>
                @if ($errors->has('publication_status'))
                <span class="help-block">
                  <strong>{{ $errors->first('publication_status') }}</strong>
                </span>
                @endif
              </div>
              <!-- /.form-group -->

                <label for="description">Award Description <span class="text-danger">*</span></label>
                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }} has-feedback">
                  <textarea class="textarea" name="description" id="description" placeholder="Enter employee award description.." style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!! $employee_award['description'] !!}</textarea>
                  @if ($errors->has('description'))
                  <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                  </span>
                  @endif
                </div>
                <!-- /.form-group -->




            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a href="{{ url('/hrm/employee-awards') }}" class="btn btn-danger btn-flat"><i class="icon fa fa-close"></i> Cancel</a>
          <button type="submit" class="btn btn-primary btn-flat"><i class="icon fa fa-plus"></i> Add Employee Award</button>
        </div>
      </form>
    </div>
    <!-- /.box -->


  </section>
  <!-- /.content -->
</div>
<script type="text/javascript">
document.forms['employee_award_update_form'].elements['publication_status'].value = "{{ $employee_award['publication_status'] }}";
document.forms['employee_award_update_form'].elements['employee_id'].value = "{{ $employee_award['employee_id'] }}";
document.forms['employee_award_update_form'].elements['award_category_id'].value = "{{ $employee_award['award_category_id'] }}";
</script>

<script type="text/javascript">
//Month picker
      $('#monthpicker').datepicker({
          autoclose: true,
          format: "yyyy-mm",
          viewMode: "months",
          minViewMode: "months"
      });
      $('#monthpicker').datepicker('setDate', 'now');

      //Month picker
      $('#monthpicker2').datepicker({
          autoclose: true,
          format: "yyyy-mm",
          viewMode: "months",
          minViewMode: "months"
      });
</script>
@endsection
