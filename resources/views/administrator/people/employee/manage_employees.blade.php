@extends('administrator.master')
@section('title', 'Team')

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Employees
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
            <div class="box-header with-border">
                <h3 class="box-title">Manage team</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <a href="{{ url('/people/employees/create') }}" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Add </a>
                <a href="{{ url('/importExportView') }}" class="tip btn btn-success btn-flat pull-right" title="Print" data-original-title="Label Printer"> <i class="fa fa-arrow-down"></i><span class="hidden-sm hidden-xs"> Import</span> </a>
                    <div class="btn-group pull-right">
                                    <button type="button" class="tip btn btn-info btn-flat pull-right dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        Reports <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ url('/people/employees/print/') }}"><i class="icon fa fa-print"></i> Print</a></li>
                                        <li><a href="{{ url('/people/employees/pdf/') }}"><i class="icon fa fa-file"></i> PDF</a></li>
                                        <li><a href="{{ url('/people/employees/excel/') }}"><i class="icon fa fa-list"></i> Excel</a></li>
                                    </ul>
                                </div>
               
               
                <!-- Notification Box -->
            </div>
             <hr>
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
     <form action="{{ url('people/employees') }}" method="get" name="employee_add_form" enctype="multipart/form-data">
    <p id="date_filter">
         {{ csrf_field() }}
    <span id="date-label-from" class="date-label">From: </span><input class="date_range_filter date" name="start_date" type="text" id="datepicker3" />
    <span id="date-label-to" class="date-label">To:<input class="date_range_filter date" type="text" name="end_date" id="datepicker4" />
    <!-- <input type="hidden" name="table" value="employees"> 
     <input type="hidden" name="request" value="people/employees">  -->
    <button type="submit" class="btn btn-primary btn-filter"><i class="icon fa fa-filter"></i> Filter</button>
    </p>

</form>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                          
                            <th width="">ID</th>
                             <th width="">Picture</th>
                            <th width="">Name</th>
                            <th width="">Department</th>
                            <th width="">Designation</th>
                            <th width="">Contact No</th>
                            <th width="" class="text-center">Added</th>
                            <th width="" class="text-center">Status</th>
                            <th width="" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{ $sl = 1 }}
                        @foreach($employees as $employee)
                        <tr>
                                                                <?php
$department = \App\Department::find($employee['department_id']);

?>
                            
                            <td>{{ $employee['employee_id'] }}</td>
                            <?php

                            $img = "1553452165.png"; ?>
                             <td><img src="{{ url('public/profile_picture/' . $employee['profile_picture']) }}" class="img-responsive  img-thumbnail" width="75px"></td>
                            <td>{{ $employee['name'] }} &nbsp; {{ $employee['father_name'] }}</td>
                            <td>{{ $department->department }}</td>
                            <td>{{ $employee['designation'] }}</td>
                            <td>{{ $employee['contact_no_one'] }}</td>
                            <td class="text-center">{{ date("d F Y", strtotime($employee['created_at'])) }}</td>
                            <td class="text-center">
                                @if ($employee['activation_status'] == 1)
                                <a href="{{ url('/people/employees/deactive/' . $employee['id']) }}" class="btn btn-success btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="Click to deactive"><i class="icon fa fa-arrow-down"> Active</i></a>
                                @else
                                <a href="{{ url('/people/employees/active/' . $employee['id']) }}" class="btn btn-warning btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="Click to active"><i class="icon fa fa-arrow-up"></i> Deactive</a>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-xs btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ url('/people/employees/details/' . $employee['id']) }}"><i class="icon fa fa-file-text"></i> Details</a></li>
                                        <li><a href="{{ url('/people/employees/edit/' . $employee['id']) }}"><i class="icon fa fa-edit"></i> Edit</a></li>
                                        <li><a href="{{ url('/people/employees/delete/' . $employee['id']) }}" onclick="return confirm('Are you sure to delete this ?');"><i class="icon fa fa-trash"></i> Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
   
<script type="text/javascript">
// $(function() {
//   var oTable = $('#example1').DataTable({
//     "oLanguage": {
//       "sSearch": "Filter Data"
//     },
//     "iDisplayLength": -1,
//     "sPaginationType": "full_numbers",

//   });




//   $("#datepicker_from").datepicker({
//     showOn: "button",
//     buttonImage: "images/calendar.gif",
//     buttonImageOnly: false,
//     "onSelect": function(date) {
//       minDateFilter = new Date(date).getTime();
//       oTable.fnDraw();
//     }
//   }).keyup(function() {
//     minDateFilter = new Date(this.value).getTime();
//     oTable.fnDraw();
//   });

//   $("#datepicker_to").datepicker({
//     showOn: "button",
//     buttonImage: "images/calendar.gif",
//     buttonImageOnly: false,
//     "onSelect": function(date) {
//       maxDateFilter = new Date(date).getTime();
//       oTable.fnDraw();
//     }
//   }).keyup(function() {
//     maxDateFilter = new Date(this.value).getTime();
//     oTable.fnDraw();
//   });

// });

// // Date range filter
// minDateFilter = "";
// maxDateFilter = "";

// $.fn.dataTableExt.afnFiltering.push(
//   function(oSettings, aData, iDataIndex) {
//     if (typeof aData._date == 'undefined') {
//       aData._date = new Date(aData[0]).getTime();
//     }

//     if (minDateFilter && !isNaN(minDateFilter)) {
//       if (aData._date < minDateFilter) {
//         return false;
//       }
//     }

//     if (maxDateFilter && !isNaN(maxDateFilter)) {
//       if (aData._date > maxDateFilter) {
//         return false;
//       }
//     }

//     return true;
//   }
// );
// </script>
@endsection