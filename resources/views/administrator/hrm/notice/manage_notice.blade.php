@extends('administrator.master')
@section('title', 'Manage Notice ')

@section('main_content')
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Manage Notice
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li><a>HRM</a></li>
			<li class="active">Manage Notice</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Manage Notice</h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="box-body">
				<a href="{{ url('/hrm/notice/create') }}" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Add Notice</a>
				      <div class="btn-group pull-right">
                                    <button type="button" class="tip btn btn-info btn-flat pull-right dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        Reports <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ url('/hrm/notice/print/') }}"><i class="icon fa fa-print"></i> Print</a></li>
                                        <li><a href="{{ url('/hrm/notice/pdf/') }}"><i class="icon fa fa-file"></i> PDF</a></li>
                                        <li><a href="{{ url('/hrm/notice/excel/') }}"><i class="icon fa fa-list"></i> Excel</a></li>
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
				                   <form action="{{ url('hrm/notice') }}" method="get" name="employee_add_form" enctype="multipart/form-data">
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
							<th>Title</th>
							<th>From Date</th>
							<th>To Date Date</th>
							<th>Details</th>
							<th class="text-center">Create By</th>
							<th class="text-center">Create At</th>
							<th class="text-center">Status</th>
							<th class="text-center">Actions</th>
						</tr>
					</thead>
					<tbody>
						@php ($sl = 1)
						@foreach( $notices as $notice )
						<tr>
							<td>{{ $sl++ }}</td>
							<td>{{ $notice['notice_title'] }}</td>
							<td>{{ date("D d F Y h:ia", strtotime($notice['from_date'])) }}</td>
							<td>{{ date("D d F Y h:ia", strtotime($notice['to_date'])) }}</td>
							<td>{!! str_limit($notice['description'], 65) !!}</td>
							<td>{{ $notice['name'] }}</td>
							<td>{{ date("D d F Y h:ia", strtotime($notice['created_at'])) }}</td>

							<td class="text-center">
								@if( $notice['publication_status'] == 1 )
								<a href="{{ url('/hrm/notice/unpublished/' . $notice['id'] ) }}" class="btn btn-success btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="Unpublished"><i class="icon fa fa-arrow-down"> Published</i></a>
								@else
								<a href="{{ url('/hrm/notice/published/' . $notice['id'] ) }}" class="btn btn-warning btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="Published"><i class="icon fa fa-arrow-up"></i> Unpublished</a>
								@endif
							</td>
							<td>
								<div class="btn-group">
									<button type="button" class="btn btn-primary btn-xs btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										Action <span class="caret"></span>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li><a href="{{ url('/hrm/notice/detail/' . $notice['id']) }}"><i class="icon fa fa-file-text"></i> Details</a></li>
										<li><a href="{{ url('/hrm/notice/delete/' . $notice['id']) }}" onclick="return confirm('Are you sure to delete this ?');"><i class="icon fa fa-trash"></i> Delete</a></li>
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
