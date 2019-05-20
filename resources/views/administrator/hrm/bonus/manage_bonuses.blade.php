@extends('administrator.master')
@section('title', 'Manage Bonuses')

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            BONUS
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a>HRM</a></li>
            <li class="active">Manage Bonuses</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Manage Bonuses</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <a href="{{ url('/hrm/bonuses/create') }}" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Add bonus</a>
                  <div class="btn-group pull-right">
                                    <button type="button" class="tip btn btn-info btn-flat pull-right dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        Reports <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ url('/hrm/bonuses/print/') }}"><i class="icon fa fa-print"></i> Print</a></li>
                                        <li><a href="{{ url('/hrm/bonuses/pdf/') }}"><i class="icon fa fa-file"></i> PDF</a></li>
                                        <li><a href="{{ url('/hrm/bonuses/excel/') }}"><i class="icon fa fa-list"></i> Excel</a></li>
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

                     <form action="{{ url('hrm/bonuses') }}" method="get" name="employee_add_form" enctype="multipart/form-data">
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
                            <th>Designation</th>
                            <th>Bonus Name</th>
                            <th>Bonus Month</th>
                            <th>Bonus Amount</th>
                            <th>Date Added</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php ($sl = 1)
                        @foreach($bonuses as $bonus)
                        <tr>
                            <td>{{ $sl++ }}</td>
                            <td>{{ $bonus['name'] }}&nbsp;{{ $bonus['father_name'] }}&nbsp;{{ $bonus['grand_father_name'] }}</td>
                            <td>{{ $bonus['designation'] }}</td>
                            <td>{{ $bonus['bonus_name'] }}</td>
                            <td>{{ date("d F Y", strtotime($bonus['bonus_month'])) }} - {{ date("d F Y", strtotime($bonus['bonus_month_to'])) }}</td>
                            <td>{{ $bonus['bonus_amount'] }}</td>
                            <td>{{ date("d F Y", strtotime($bonus['created_at'])) }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-xs btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="{{ url('/hrm/bonuses/details/' . $bonus['id']) }}"><i class="icon fa fa-file-text"></i> Details</a>
                                        </li>
                                      
                                        <li>
                                            <a href="{{ url('/hrm/bonuses/edit/' . $bonus['id']) }}"><i class="icon fa fa-edit"></i> Edit</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/hrm/bonuses/delete/' . $bonus['id']) }}" onclick="return confirm('Are you sure to delete this ?');"><i class="icon fa fa-trash"></i> Delete</a>
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