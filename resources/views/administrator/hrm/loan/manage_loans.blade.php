@extends('administrator.master')
@section('title', 'Manage Loans')

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            LOAN
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a>HRM</a></li>
            <li class="active">Manage Loans</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Manage Loans</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <a href="{{ url('/hrm/loans/create') }}" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Add loan</a>
                
 <div class="btn-group pull-right">
                                    <button type="button" class="tip btn btn-info btn-flat pull-right dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        Reports <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ url('/hrm/loans/print/') }}"><i class="icon fa fa-print"></i> Print</a></li>
                                        <li><a href="{{ url('/hrm/loans/pdf/') }}"><i class="icon fa fa-file"></i> PDF</a></li>
                                        <li><a href="{{ url('/hrm/loans/excel/') }}"><i class="icon fa fa-list"></i> Excel</a></li>
                                    </ul>
                                </div>
                <hr>
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

                 <!-- /.Notification Box -->
                  <form action="{{ url('hrm/loans') }}" method="get" name="employee_add_form" enctype="multipart/form-data">
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
                            <th>SL#</th>
                            <th>Employee Name</th>
                            <th>Designation</th>
                            <th>Loan Name</th>
                            <th>Loan Amount</th>
                            <th>Number of Inst.</th>
                            <th>Remaining Inst.</th>
                            <th>Date Added</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php ($sl = 1)
                        @foreach($loans as $loan)
                        <tr>
                            <td>{{ $sl++ }}</td>
                            <td>{{ $loan['name'] }} &nbsp;{{ $loan['father_name'] }}&nbsp;{{ $loan['grand_father_name'] }}</td>
                            <td>{{ $loan['designation'] }}</td>
                            <td>{{ $loan['loan_name'] }}</td>
                            <td>{{ $loan['loan_amount'] }}</td>
                            <td>{{ $loan['number_of_installments'] }}</td>
                            <td>{{ $loan['remaining_installments'] }}</td>
                            <td>{{ date("d F Y", strtotime($loan['created_at'])) }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-xs btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="{{ url('/hrm/loans/details/' . $loan['id']) }}"><i class="icon fa fa-file-text"></i> Details</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/hrm/loans/edit/' . $loan['id']) }}"><i class="icon fa fa-edit"></i> Edit</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/hrm/loans/delete/' . $loan['id']) }}" onclick="return confirm('Are you sure to delete this ?');"><i class="icon fa fa-trash"></i> Delete</a>
                                        </li>
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
    </section>
    <!-- /.content -->
</div>
@endsection