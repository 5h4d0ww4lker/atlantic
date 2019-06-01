<?php
use Carbon\Carbon;
?>
@extends('administrator.master')
@section('title', 'Attendance Lists')

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Attendance
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a>HRM</a></li>
            <li class="active">Attendance lists</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Attendance lists</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
            <a href="{{ url('/attendanceImportView') }}" class="tip btn btn-success btn-flat pull-right" title="Print" data-original-title="Label Printer"> <i class="fa fa-arrow-down"></i><span class="hidden-sm hidden-xs"> Import</span> </a>
              <div class="btn-group pull-right">
                                    <button type="button" class="tip btn btn-info btn-flat pull-right dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        Reports <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ url('/hrm/attendance/print/') }}"><i class="icon fa fa-print"></i> Print</a></li>
                                        <li><a href="{{ url('/hrm/attendance/pdf/') }}"><i class="icon fa fa-file"></i> PDF</a></li>
                                        <li><a href="{{ url('/hrm/attendance/excel/') }}"><i class="icon fa fa-list"></i> Excel</a></li>
                                    </ul>
                                </div>
              
                <!-- Notification Box -->
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
                                   <form action="{{ url('hrm/attendance/daily') }}" method="get" name="employee_add_form" enctype="multipart/form-data">
    <p id="date_filter">
         {{ csrf_field() }}
    <span id="date-label-from" class="date-label">From: </span><input class="date_range_filter date" name="start_date" type="text" id="datepicker3" />
    <span id="date-label-to" class="date-label">To:<input class="date_range_filter date" type="text" name="end_date" id="datepicker4" />
    <!-- <input type="hidden" name="table" value="employees"> 
     <input type="hidden" name="request" value="people/employees">  -->
    <button type="submit" class="btn btn-primary btn-filter"><i class="icon fa fa-filter"></i> Filter</button>
    </p>

</form>
                <!-- /.Notification Box -->
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>SL#</th>
                            <th>Employee Name</th>
                            <th>Date</th>
                            <th>First Check In</th>
                            <th>First Check Out</th>
                            <th>Second Check In</th>
                            <th>Second Check Out</th>
                            <!-- <th>Created at</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th> -->
                        </tr>
                    </thead>
                    <tbody>
                    @php ($sl = 1)
                    @foreach($attendances as $attendance)


                                                                                                <?php
$tmp = \App\User::find($attendance->created_by);

$ot = "On Time";
$la = "Late Arrival";
$ed = "Early Departure";
?>
                      <tr>
                        <td>{{  $sl++ }}</td>
                        <td>{{ $tmp->name}}</td>
                        <td>{{ date('d/m/Y', strtotime($attendance->created_at)) }}</td>
                       
                        <td class="text-center">
                        @if($attendance->leave_category_id != null)
                        <a href="" class="btn btn-info btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="Pending"><i class="icon fa fa-hourglass-2"></i> On Leave</a>
                        @elseif($attendance->first_check_in_status == $ot)
                          <a href="" class="btn btn-success btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="On Time"><i class="icon fa fa-clock-o">&nbsp;&nbsp;{{$attendance->first_check_in}}- On Time</i></a>
                        @else
                          <a href="" class="btn btn-danger btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="Late"><i class="icon fa fa-clock-o"></i>&nbsp;&nbsp;{{$attendance->first_check_in}} - Late Arrival</a>
                        @endif
                      </td>

                       <td class="text-center">
                        @if($attendance->leave_category_id != null)
                        <a href="" class="btn btn-info btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="Pending"><i class="icon fa fa-hourglass-2"></i> On Leave</a>
                        @elseif($attendance->first_check_out_status == 'On Time')
                          <a href="" class="btn btn-success btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="On Time"><i class="icon fa fa-clock-o">&nbsp;&nbsp;{{$attendance->first_check_out}}- On Time</i></a>
                        @else
                          <a href="" class="btn btn-danger btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="Late"><i class="icon fa fa-clock-o"></i>&nbsp;&nbsp;{{$attendance->first_check_out }}- Early Departure</a>
                        @endif
                      </td>

                        <td class="text-center">
                        @if($attendance->leave_category_id != null)
                        <a href="" class="btn btn-info btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="Pending"><i class="icon fa fa-hourglass-2"></i> On Leave</a>
                        @elseif($attendance->second_check_in_status == $ot)
                          <a href="" class="btn btn-success btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="On Time"><i class="icon fa fa-clock-o">&nbsp;&nbsp;{{$attendance->second_check_in}}- On Time</i></a>
                        @else
                          <a href="" class="btn btn-danger btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="Late"><i class="icon fa fa-clock-o"></i>&nbsp;&nbsp;{{$attendance->second_check_in}} - Late Arrival</a>
                        @endif
                      </td>

                       <td class="text-center">
                        @if($attendance->leave_category_id != null)
                        <a href="" class="btn btn-info btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="Pending"><i class="icon fa fa-hourglass-2"></i> On Leave</a>
                        @elseif($attendance->second_check_out_status == $ot)
                          <a href="" class="btn btn-success btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="On Time"><i class="icon fa fa-clock-o">&nbsp;&nbsp;{{$attendance->second_check_out}}- On Time</i></a>
                        @else
                          <a href="" class="btn btn-danger btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="Late"><i class="icon fa fa-clock-o"></i>&nbsp;&nbsp;{{$attendance->second_check_out}}- Early Departure</a>
                        @endif
                      </td>

                       
                @endforeach



            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->
</section>
<!-- /.content -->
</div>
@endsection
